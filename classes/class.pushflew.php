<?php

class Pushflew {

  /**
   * Get Pushflew data
   */
  public static function getPushflewData() {

    $websiteId = get_option("pushflew_websiteId");
    $authId = get_option("pushflew_authid");
    if (!$authId || !$websiteId) {
      $check = Pushflew::checkWebsite();
      if (!$check['status']) {
        Pushflew::registerWebsite();
        $data = Pushflew::getData();
      }
      else {
        $data = array('alreadyRegistredStatus' => true, 'websiteId' => $check['websiteId']);
      }
    } else {
      $data = Pushflew::getData();
    }
    Pushflew::register_as_ecommerce();
    return $data;
  }

  /**
   * Register new website to https://app.pushflew.com
   */
  private static function checkWebsite() {
    $email = get_bloginfo('admin_email');
    $website = get_bloginfo('url');
    $website = parse_url($website);
    $url = "https://app.pushflew.com/checkSimilarWebsite/" . $email . "/" . $website['host'];
    $response =wp_remote_get($url, array(
      'sslverify' => false,
      'timeout'     => 100
      ));
    if (is_wp_error($response)) {
      echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
    } else {
      $result = json_decode($response['body'], true);
      $status = $result['status'];
      if($status == true){
        return array("status" => true, "websiteId" => $result['websiteId']);
      }else{
        return array("status" => false);
      }
    }
  }

  /**
   * Register new website to https://app.pushflew.com
   */
  public static function registerWebsite() {
    $email = get_bloginfo('admin_email');
    $company = get_bloginfo('name');
    $website = get_bloginfo('url');

    $parsedUrl = parse_url($website);
    $host = explode('.', $parsedUrl['host']);
    $subdomain = $host[0];
    if ($subdomain == "www") {
        $subdomain = $host[1];
    }
    $body = array(
      'ownedByUser' => $email,
      'source' => 'wordpress',
      'company' => $company,
      'protocol' => "http",
      'website' => $website,
      'subdomain' => $subdomain,
      'timezone' => get_option('timezone_string')
    );

    $postUrl = "https://app.pushflew.com/registerWebsite";
    $response = wp_remote_post( $postUrl, array(
      'method' => 'POST',
      'sslverify' => false,
      'timeout' => 100,
      'headers' => array("Content-type" => "application/json"),
      'body' => json_encode($body)
      )
    );
    if ( is_wp_error( $response ) ) {
       $error_message = esc_html($response->get_error_message());
       echo "Something went wrong: ".$error_message;
    } else {
      $result = json_decode($response['body'], true);
      $tempData = Pushflew::saveWebsiteData($result['websiteId'], $result['auth']);
      Pushflew::registerLogo($result['websiteId'], $result['auth']);
    }
  }

  /**
   * Push website logo  to https://app.pushflew.com
   * @args - $auth id and $website id
   */
  private static function registerLogo($siteId, $auth) {
    if ($siteId != null && $auth != null) {
      $logo = get_header_image();
      $url = "https://app.pushflew.com/saveSiteLogo";
      $body = array(
        'websiteId' => $siteId,
        'logoURL' => $logo,
      );
      $response = wp_remote_post( $url, array(
        'method' => 'POST',
        'sslverify' => false,
        'timeout' => 100,
        'headers' => array("Content-type" => "application/json", "Authorization:" => $auth),
        'body' => json_encode($body)
        )
      );

      if ( is_wp_error( $response ) ) {
         $error_message = $response->get_error_message();
         echo "Something went wrong: ".$error_message;
      }
    }
  }

  /**
   * Save new website data  to DB - wp_pushflew
   * @args - $result from register website()
   */
  public static function saveWebsiteData($websiteId, $authToken) {

    $company = get_bloginfo('name');
    $protocol = $_SERVER['REQUEST_SCHEME'];

    update_option('pushflew_company', $company);
    update_option('pushflew_protocol', $protocol);
    update_option('pushflew_websiteid', $websiteId);
    update_option('pushflew_authid', $authToken);
    
    return array('alreadyRegistredStatus' => false ,'websiteId' => $websiteId, 'auth' => $authToken);
  }

  /**
   * Get Pushflew Data
   */
  public static function getData() {
    $websiteId = get_option("pushflew_websiteid");
    $authToken = get_option("pushflew_authid");
    return array('alreadyRegistredStatus' => false ,'websiteId' => get_option('pushflew_websiteid'), 'auth' => get_option('pushflew_authid'));
  }

  public static function register_as_ecommerce()
  {
    $websiteId = get_option("pushflew_websiteid");
    $authToken = get_option("pushflew_authid");
    $url = "https://app.pushflew.com/api/v1/enableEcommerce/".$websiteId;
    $body = array(
      'websiteId' => $websiteId,
      'enable' => true,
      'platform' => 'wordpress'
    );
    $response = wp_remote_post( $url, array(
      'method' => 'POST',
      'sslverify' => false,
      'timeout' => 100,
      'headers' => array("Content-type" => "application/json", "Authorization:" => $authToken),
      'body' => json_encode($body)
      )
    );
  }
}