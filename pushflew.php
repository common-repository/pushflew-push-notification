<?php

/**
 * @package PushFlew
 */
/*
  Plugin Name: Push Notification
  Plugin URI: https://app.pushflew.com/
  Description: This plugin enable Web push service in Wordpress website. Once installed, it allow user to accept and reject push option. If user accept it, Wordpress site admin can send Push message through PushFlew.
  Version: 3.0.0
  Author: Pushflew
  Author URI: https://pushflew.com/
  License: GPLv2 or later
  Text Domain: PushFlew
 */

/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// Make sure we don't expose any info if called directly
define('PUSHFLEW_VERSION', '1.0.0');
define('PUSHFLEW_MINIMUM_WP_VERSION', '3.7');
define('PUSHFLEW_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PUSHFLEW_DELETE_LIMIT', 100000);
define('PUSHFLEW_MAIN_PLUGIN_FILE', __FILE__);

require_once( PUSHFLEW_PLUGIN_DIR . 'classes/class.pushflew.php' );
require_once( PUSHFLEW_PLUGIN_DIR . 'classes/class.activation.php' );
require_once( PUSHFLEW_PLUGIN_DIR . 'classes/class.deactivation.php' );
require_once( PUSHFLEW_PLUGIN_DIR . 'classes/class.abandonment.php' );

/*
 *  pushflew_menu
 */
function pushflew_enqueue_all_admin_script()
{
  wp_register_style( 'pushflew_admin_css', plugin_dir_url(__FILE__).'assets/admin_style.css');
  wp_enqueue_style( 'pushflew_admin_css' );
  wp_register_script( 'pushflew_admin_script', plugin_dir_url(__FILE__).'assets/admin_script.js',array(), 1.0 , true );
  wp_enqueue_script('pushflew_admin_script');
  wp_localize_script('pushflew_admin_script', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php')
  ));
}
add_action('admin_enqueue_scripts', 'pushflew_enqueue_all_admin_script' );

function pushflew_admin_menu() {
  add_menu_page('PushFlew', 'PushFlew', 'manage_options', 'pushflew', 'pushflew_menu_options');
}
add_action('admin_menu', 'pushflew_admin_menu');

/*
 *  pushflew_menu options
 */

function pushflew_menu_options() {
  if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }
  $pushflewData = Pushflew::getPushflewData();
  $info = "";
  if (isset($_POST['account_settings_submit'])) {
    $img_url = "";
    $setted_logo = sanitize_text_field($_POST['setted_logo']);
    if ($_FILES['logo']['tmp_name'] != "") {
      $filePath = $_FILES['logo']['tmp_name'];
      $fileName = $_FILES['logo']['name'];
      $logo_upload_url = "https://app.pushflew.com/uploadFile";
      $rawdata = file_get_contents($filePath);
      $image_response = wp_remote_post( $logo_upload_url, array(
        'method' => 'POST',
        'sslverify' => false,
        'timeout' => 100,
        'headers' => array("Content-type" => "multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"),
        'body' => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file\"; filename=\"$fileName\"\r\nContent-Type: image/png\r\n\r\n$rawdata\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--"
        )
      );
      if (is_wp_error($image_response)) {
        echo '[PushFlew]Failed to upload file, try again. <br> Error:' . esc_html($image_response->get_error_message());
        $img_url = $setted_logo;
      } else {
        $img_url = $image_response['body'];
      }
    } else {
      $img_url = $setted_logo;
    }
    $timezone = get_option('timezone_string');
    $settings_update_url = "https://app.pushflew.com/updateAccountSettings";
    $setting_body = array(
        "websiteId" => $pushflewData['websiteId'],
        "company" => sanitize_text_field($_POST['company']),
        "timezone" => $timezone,
        "logo" => $img_url
      );
    $settings_response = wp_remote_post( $settings_update_url, array(
      'method' => 'POST',
      'sslverify' => false,
      'timeout' => 100,
      'headers' => array("Content-type" => "application/json", "Authorization:" => $pushflewData['auth']),
      'body' => json_encode($setting_body)
      )
    );
    if (is_wp_error($img_url)) {
      echo '[PushFlew]Failed to update settings, try again. <br> Error:' . esc_html($img_url->get_error_message());
    } else {
      $info = "Your all settings are saved successfully.";
    }
  }

  if (isset($_POST['account_login_submit'])) {
    $body = array(
      "email" => sanitize_email($_POST['login_email']),
      "password" => sanitize_text_field($_POST['login_password']),
      "websiteId" => ""
      );
    $loginUrl = "https://app.pushflew.com/thirdPartyLogin";
    $response = wp_remote_post( $loginUrl, array(
      'method' => 'POST',
      'sslverify' => false,
      'timeout' => 100,
      'headers' => array("Content-type" => "application/json"),
      'body' => json_encode($body)
      )
    );
    $result = json_decode($response['body'], true);
    $pushflewData = Pushflew::saveWebsiteData(sanitize_text_field($_POST['login_websiteId']), $result['auth']);
  }

  if (!$pushflewData['alreadyRegistredStatus']) {
    $get_url = "https://app.pushflew.com/accountSetting/".$pushflewData['websiteId'];
    $account_settings =wp_remote_get($get_url, array(
      'sslverify'   => false,
      'timeout'     => 100,
      'headers'     => array('Authorization' => $pushflewData['auth'])
      ));
    if (is_wp_error($account_settings)) {
      echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($account_settings->get_error_message());
    } else {
      $pushflew_account = json_decode($account_settings['body']);
      $email = $pushflew_account->email;
      $websiteId = $pushflew_account->websiteId;
      $website = $pushflew_account->website;
      $subdomain = $pushflew_account->subDomain;
      $company = $pushflew_account->company;
      $emailConfirmed = $pushflew_account->emailConfirmed;
      $logo = "https://app.pushflew.com".$pushflew_account->logo;
      ?>
      <div class="pushflew_outer_wrapper">
        <p id="pushflew_info_alert"></p>
        <p class="pushflew_info_text"><?php echo esc_html($info) ;?></p>
        <form action="#" method="post" name="pushflew_settings" enctype="multipart/form-data">
          <table>
            <tr>
              <th>Email</th>
              <td>-</td>
              <td class="pushflew-email-confirm-wrapper">
                <?php
                  echo "<p id='pushflew_email_p'>".esc_html($email)."</p>";
                  if ($emailConfirmed == "false") {
                    ?><input type="text" id="pushflew_email_input" name="email" value="<?php echo esc_html($email); ?>">
                      <a href="javascript:;" class="button button-primary button-medium" id="pushflew_email_edit">Edit</a>
                      <a href="javascript:;" class="button button-primary button-medium" id="pushflew_email_confirm">Confirm email</a>
                    <?php
                  } else {
                    ?>
                      <a href="https://app.pushflew.com/#/dashboard?currentuser=<?php echo $email;?>&Authorization=<?php echo $pushflewData['auth'];?>&websiteId=<?php echo $websiteId;?>" target="_blank" class="button button-primary button-large goto-pushflew-admin" id="goto-pushflew-dashboard">Go to Pushflew Dashboard</a>
                    <?php
                  }
                ?>
              </td>
            </tr>
            <tr>
              <th>Website Id</th>
              <td>-</td>
              <td><?php echo esc_html($websiteId); ?></td>
            </tr>
            <tr>
              <th>Website</th>
              <td>-</td>
              <td><?php echo esc_html($website);?></td>
            </tr>
            <tr>
              <th>Subdomain</th>
              <td>-</td>
              <td><?php echo esc_html($subdomain); ?></td>
            </tr>
            <tr>
              <th>Company Name</th>
              <td>-</td>
              <td><input type="text" name="company" value="<?php echo esc_html($company); ?>"></td>
            </tr>
            <tr>
              <th>Logo</th>
              <td>-</td>
              <td>
                <input type="file" name="logo" value="">
                <input type="hidden" name="setted_logo" value="<?php echo esc_html($pushflew_account->logo); ?>">
                <img title="Logo Preview" alt="Logo Preview" src="<?php echo esc_url($logo); ?>">
              </td>
            </tr>
            <tr>
              <th><input type="submit" name="account_settings_submit" value="Save Settings" class="button button-primary button-large"></th>
            </tr>
          </table>
        </form>
      </div>
      <?php
    }
  } else {
    ?>
      <div class="pushflew_outer_wrapper">
        <p id="pushflew_info_alert"></p>
        <p>It seems you already registered your website, if you like to continue with exisiting registeration, please authenticate and we will connect it to your existing account and data associated with that.</p>
        <form action="#" method="post" name="pushflew_settings" enctype="multipart/form-data">
          <table>
            <tr>
              <th>Email</th>
              <td>-</td>
              <td><input type="text" name="login_email"></td>
            </tr>
            <tr>
              <th>Password</th>
              <td>-</td>
              <td>
                <input type="password" name="login_password">
                <input type="hidden" name="login_websiteId" value="<?php echo esc_html($pushflewData['websiteId']);?>">
              </td>
            </tr>
            <tr>
              <th><input type="submit" name="account_login_submit" value="Login" class="button button-primary button-large"></th>
            </tr>
          </table>
        </form>
      </div>
    <?php
  }
}

/*
 *  pushflew js add once installed with enqueue scripts
 */

function pushflew_sent_to_js() {
  global $wpdb;
  wp_enqueue_script('jquery');
  wp_register_script( 'pushflew_http_script', plugin_dir_url(__FILE__).'_inc/pushflew.js',array(), 1.0 , true );
  wp_enqueue_script('pushflew_http_script');

  $websiteId = get_option('pushflew_websiteid');
  $protocol = get_option('pushflew_protocol');

  $data_array = array(
    'websiteId' => $websiteId,
    'protocol' => $protocol
  );
  wp_localize_script('pushflew_http_script', 'pushflew_Object', $data_array);
}
add_action('wp_enqueue_scripts', 'pushflew_sent_to_js');

// Admin Ajax when confirm email button pressed

function pushflew_email_confirm() {
  if (isset($_POST['confirm_email'])) {
    $pushflew_data = Pushflew::getData();
    $confirm_email_url = "https://app.pushflew.com/confirmEmail/".sanitize_text_field($_POST['confirm_email'])."/".$pushflew_data['websiteId'];
    $response =wp_remote_get($confirm_email_url, array(
      'sslverify' => false,
      'timeout'     => 100,
      'headers' => array("Authorization" => $pushflew_data['auth']),
      ));
    echo json_encode($response['body']);
  }
  wp_die();
  exit;
}
add_action( 'wp_ajax_pushflew_email_confirm', 'pushflew_email_confirm' );
add_action( 'wp_ajax_nopriv_pushflew_email_confirm', 'pushflew_email_confirm' );