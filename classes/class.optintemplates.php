<?php
/* =====================
  pushflew OptIn Templates Class
  ======================= */

class PF_optintemplates {

    /* =====================
      pushflew OptIn Templates
      ======================= */

    public function Optintemplates() {
        if (isset($_REQUEST['page']) && 'optinlist' == $_REQUEST['page'] && isset($_REQUEST['optin']) && !empty($_REQUEST['optin'])) {
            $this->getlistbilder_Content();
        } else if (isset($_REQUEST['page']) && 'optinlist' == $_REQUEST['page'] && isset($_REQUEST['mode']) && 'add' == $_REQUEST['mode']) {
            $this->getlistbilder_Content();
        } else {
            $this->getOptinTemplates_Content();
        }
    }

    
    /* =====================
      pushflew OptIn Templates List
      ======================= */

    public function getOptinTemplates_Content() {

        /* ==== Header ==== */ ?>
        <div class="pf-optintemplates-main"> 
            <div id="processingIndicator" class="loading_center" style="display: none;">
                <div style="margin-top: 18%;">
                    <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/loading.gif" alt="Loading..." style="max-height: 60px; max-width: 60px;">
                    <p style="font-size: 20px; color: #000;">Please Wait...</p>
                </div>
            </div>    
            <?php echo pf_upgradenow_message(); ?>
            <div class='wrap pf-head pf-clearfix'>
                <span class="pf-title">Quick Push Setup</span>
            </div>
            <div class="updated notice">
                <p><a href="https://pushflew.groovehq.com/knowledge_base/topics/list-builder-push-notifications" target="_blank" /><b>Learn more about Push Notification List Builder  </b></a></p>
            </div>
            <?php /* ==== Content ==== */ ?>
            <div class="content_wrapper">
                <div class="tab_content active">
                    <div class="pf-optintemplates"> 
                        <div class="pf-cust-head-opt">
                            <h2>Push Optin</h2>
                            <a href="<?php echo menu_page_url('optinlist', 0) . '&mode=add'; ?>" class="pf-btn-prime pf-action-btn">Create Optin</a>
                        </div>		
                        <table style="width:100%" cellspacing=0 class="pf-template-list">
                            <thead>   
                                <tr>
                                    <th>OptIn Name</th>
                                    <th>Status</th> 
                                    <th class="pf-rule-none">Edit Display Rules</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>  
                        </table>

                        <div class="pf-new-sub-req">		
                            <a href="<?php echo menu_page_url('broadcast', 0); ?>" class="pf-btn-prime">Send Push Broadcast</a>	
                        </div>	
                    </div>
                </div>

            </div>

            <?php /* ==== Footer ==== */ ?>
            <div class="pf-help-block pf-top-brdr">
                <p>Need help with the setup? <a href="https://pushflew.com/contact-us/" target="_blank"> Just let us know.</a></p>
            </div>
        </div>

        <?php /* ====== Show Display Rule Model ====== */ ?>
        <div id="pf-show-display-rule-model" class="pf-cust-modal">
            <div class="pf-cust-modal-outer-wrapper"></div>

            <div class="pf-modal-dialog pf-cust-modal-inner-wrapper">
                <div class="pf-modal-content">
                    <div class="pf-modal-header">
                        <button type="button" class="pf-modal-close">×</button>
                        <h4 class="pf-modal-title">All Display Rules</h4>
                    </div>
                    <div class="pf-modal-body">
                        <table class="pf-table pf-table-bordered table-hover" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Rule Name</th>
                                    <th>Edit Rule</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="">test</td>
                                    <td><button class="pf-btn-prime pf-btn-green-haze">Edit Rule</button></td>
                                    <td><button class="pf-btn-prime">Delete Rule</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pf-modal-footer">
                        <button type="button" class="pf-btn-prime">Back</button>
                        <a href="javascript:;" class="pf-btn-prime pf-btn-green-haze">Add New</a>
                    </div>
                </div>
            </div>

        </div>

        <?php /* ====== Edit Display Rule Model ====== */ ?>
        <div id="pf-edit-display-rule-model" class="pf-cust-modal">
            <div class="pf-cust-modal-outer-wrapper"></div>

            <div class="pf-modal-dialog pf-cust-modal-inner-wrapper">
                <div class="pf-modal-content">
                    <div class="pf-modal-header">
                        <button type="button" class="pf-modal-close">×</button>
                        <h4 class="pf-modal-title">Edit Display Rules Settings</h4>
                    </div>
                    <div class="pf-modal-body">
                        <div class="form-group">
                            <label class="control-label">Rule Name</label>
                            <input type="text" class="form-control" id="pf_url_path_containing_input">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Url Contains</label>
                            <input type="text" class="form-control" id="pf_url_path_containing_input">
                        </div>

                    </div>
                    <div class="pf-modal-footer">
                        <button type="button" class="pf-btn-prime">Back</button>
                        <a href="javascript:;" class="pf-btn-prime pf-btn-green-haze">Save Rule</a>
                    </div>
                </div>
            </div>

        </div>



        <script>
            jQuery(document).ready(function ($) {

            });
            function optin_templates() {
                jQuery("#processingIndicator").show();
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'optin_templates',
                    },
                    dataType: 'json',
                    success: function (data) {
                        jQuery("#processingIndicator").hide();
                        if (data.success) {
                            jQuery('.pf-optintemplates table tbody').html(data.data);
                        } else {
                            jQuery('.pf-optintemplates table tbody').html(data.data);
                        }
                    },
                    error: function (data) {
                        jQuery("#processingIndicator").hide();
                    }
                });

            }
            optin_templates();
        </script>

        <?php
    }

    /* =====================
      pushflew OptIn Templates List Bilder
      ======================= */

    public function getlistbilder_Content() {
        ?>
        <?php echo pf_upgradenow_message(); ?>
        <div class="pf_subscription_req_main">
            <div id="processingIndicator" class="loading_center" style="display: none;">
                <div style="margin-top: 18%;">
                    <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/loading.gif" alt="Loading..." style="max-height: 60px; max-width: 60px;">
                    <p style="font-size: 20px; color: #000;">Please Wait...</p>
                </div>
            </div>      
            <div class='wrap pf-head pf-clearfix'>
                <span class="pf-title">Quick Push Setup</span>
            </div>
            <?php
            global $wpdb;
            $authdata = Pushflew::getData();
            $optin = $_REQUEST['optin'];
            $data = array();
            $mode = 'add';
            $logo_url = '';
            if (isset($optin) && !empty($optin)) {
                if (isset($authdata['auth']) && !empty($authdata['auth'])) {
                    $postUrl = "https://api.pushflew.com/v1/push/pushOptIn/" . $optin;
                    $response = wp_remote_get($postUrl, array(
                        'sslverify' => false,
                        'timeout' => 100,
                        'headers' => array("Authorization:" => $authdata['auth']),
                            )
                    );

                    if (is_wp_error($response)) {
                        echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
                        die();
                    } else {
                        $mode = 'edit';
                        $data = array();
                        $result = json_decode($response['body'], true);
                        if ($result) {
                            $data = $result['optIn'];
                        } else {
                            echo '<div class="updated notice">
                            <p><a href="#" /><b>Optnl id not Found</b></a></p>
                     </div>';
                            die();
                        }
                    }
                }
            } else {
                $default_data = array(
                    'requestLayout' => 'default',
                    'httpsSubscriptionReqEvent' => 'custom_req',
                    'reappearTime' => '3',
                    'displayEvent' => 'delay',
                    'delay' => '10',
                    'scroll' => '50',
                    'promptMessage' => array(
                        'heading' => 'Push Flew',
                        'details' => 'Click on Allow button to receive push notifications. You can turn it off anytime.',
                        'isHttpsPromptBox' => false,
                    ),
                    'desktopOptSetting' => array(
                        'title' => 'Push Flew would like to send you notifications.',
                        'subTitle' => 'You can turn it off anytime using browser settings.',
                        'allowButtonText' => 'Allow',
                        'allowButtonBackgroundColor' => '#000000',
                        'disallowButtonText' => 'Not Now',
                        'disallowButtonBackgroundColor' => '#f9f9f9',
                        'optInBackgroundColor' => '#f9f9f9',
                        'optInAlignment' => 'topLeft',
                    ),
                    'mobileOptSetting' => array(
                        'title' => 'Push Flew would like to send you notifications.',
                        'subTitle' => 'You can turn it off anytime using browser settings.',
                        'allowButtonText' => 'Allow',
                        'allowButtonBackgroundColor' => '#000000',
                        'disallowButtonText' => 'Not Now',
                        'disallowButtonBackgroundColor' => '#f9f9f9',
                        'optInBackgroundColor' => '#f9f9f9',
                        'optInAlignment' => 'topLeft',
                    ),
                );


                $get_url = "https://app.pushflew.com/accountSetting/" . $authdata['websiteId'];
                $account_settings = wp_remote_get($get_url, array(
                    'sslverify' => false,
                    'timeout' => 100,
                    'headers' => array('Authorization' => $authdata['auth'])
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
                    $logo_url = $pushflew_account->logo;
                }
            }

            if ($mode == 'edit')
                $logo_url = $data['desktopOptSetting']['logo'];
            /* ==== Header ==== */
            /* ==== Content ==== */
            ?>
            <form name="optin_form" id="optin_form" action="">
                <div id="pf_subscription_req">
                    <div class="form-group">
                        <label class="control-label">Optin Name</label>
                        <input type="text" class="form-control" name="optTitle" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" placeholder="Enter a name for Optin">
                        <div class="pf-errormassage"></div>
                    </div>

                    <div class="req_layout_wrapper">
                        <h2>Request Layout</h2>
                        <div class="tab_wrapper first_tab">
                            <?php
                            if (isset($data['requestLayout']) && $data['requestLayout'] == 'blueLagoon')
                                $active_tab = 1;
                            else if (isset($data['requestLayout']) && $data['requestLayout'] == 'electrolite')
                                $active_tab = 2;
                            else
                                $active_tab = 3;
                            ?>
                            <ul class="pf-tab_list tab_list pf-layout-types-tabs">
                                <li data-layout="blueLagoon">
                                    <input type="radio" class="req_layout_radio" <?php echo isset($data['requestLayout']) && $data['requestLayout'] == 'blueLagoon' ? 'checked' : ''; ?>  id="req_layout_blueLagoon_id" value="blueLagoon" name="select_layout">
                                    <label class="req_layout_label" for="req_layout_blueLagoon_id">
                                        <img src="<?php echo plugins_url('assets/images/blue_lagoon.png', dirname(__FILE__)); ?>" />
                                        <p class="req_layout_label_text">Blue Lagoon</p>
                                    </label>
                                </li>
                                <li data-layout="electrolite">
                                    <input type="radio" class="req_layout_radio" <?php echo isset($data['requestLayout']) && $data['requestLayout'] == 'electrolite' ? 'checked' : ''; ?> id="req_layout_electrolite_id" value="electrolite" name="select_layout">
                                    <label class="req_layout_label" for="req_layout_electrolite_id">
                                        <img src="<?php echo plugins_url('assets/images/electrolite.png', dirname(__FILE__)); ?>">
                                        <p class="req_layout_label_text">Electrolite</p>
                                    </label>
                                </li>
                                <li data-layout="default">
                                    <input type="radio" class="req_layout_radio" <?php echo isset($data['requestLayout']) && $data['requestLayout'] == 'default' ? 'checked' : ''; ?> id="req_layout_customize_id" value="default" name="select_layout" >
                                    <label class="req_layout_label" for="req_layout_default_id">
                                        <img src="<?php echo plugins_url('assets/images/classic_optin.png', dirname(__FILE__)); ?>">
                                        <p class="req_layout_label_text">Customizable Classic</p>
                                    </label>
                                </li>
                            </ul>	
                            <input type="hidden" name="pf_requestlayout" id="pf_requestlayout" value="<?php echo isset($data['requestLayout']) ? $data['requestLayout'] : $default_data['requestLayout']; ?> " />
                            <div class="content_wrapper">
                                <?php /* ======== Tab 1 ======== */ ?>
                                <div class="tab_content active">
                                    <div id="pf-tabs">
                                        <div class="tab_wrapper pf-desktop-mobile-tab fourth_tab">

                                            <ul class="tab_list">
                                                <li data-setting="dessktop" class="active"><a href="#">Desktop Settings</a></li>
                                                <li data-setting="mobile"><a href="#">Mobile Settings</a></li>
                                            </ul>

                                            <div class="content_wrapper">
                                                <div class="tab_content">
                                                    <div class="pf-tab-content-wrapper">
                                                        <div class="pf-tab-form">

                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_desk_title" name="pf_noti_bluelagoon_desk_title" placeholder="Enter Title for popup" value="<?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Sub Title</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_desk_sub_title" name="pf_noti_bluelagoon_desk_sub_title" placeholder="Enter Sub Title for popup" value="<?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Allow Button Text</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_desk_btn_allow_txt" name="pf_noti_bluelagoon_desk_btn_allow_txt" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Disallow Button Text</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_desk_btn_disallow_txt" name="pf_noti_bluelagoon_desk_btn_disallow_txt" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="pf-popup-preivew pf-bluelagoon">
                                                            <div class="pf-default-preview-wrapper desktop-preview">
                                                                <div id="pf-push-dialog" class="">
                                                                    <div class="bluelagoon_optin">
                                                                        <div class="pf-push-dialog-image">
                                                                            <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/blue_lagoon_optin_logo.png">
                                                                        </div>
                                                                        <div class="pf-push-dialog-body">
                                                                            <div class="pf-dialog-bluelagoon-title">
                                                                                <?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?>
                                                                            </div>
                                                                            <div class="pf-dialog-bluelagoon-subtitle">
                                                                                <?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?>
                                                                            </div>
                                                                            <div class="pf-push-bluelagoon-dialog-btns">

                                                                                <button type="button" class="pf-bluelagoon-not-now-btn">
                                                                                    <?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?>
                                                                                </button>
                                                                                <button type="button" class="pf-bluelagoon-allow-btn">
                                                                                    <?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="tab_content">
                                                    <div class="pf-tab-content-wrapper">
                                                        <div class="pf-tab-form">

                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_mob_title" name="pf_noti_bluelagoon_mob_title" placeholder="Enter Title for popup" value="<?php echo isset($data['mobileOptSetting']['title']) ? $data['mobileOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Sub Title</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_mob_sub_title" name="pf_noti_bluelagoon_mob_sub_title" placeholder="Enter Sub Title for popup" value="<?php echo isset($data['mobileOptSetting']['subTitle']) ? $data['mobileOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Allow Button Text</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_mob_btn_allow_txt" name="pf_noti_bluelagoon_mob_btn_allow_txt" placeholder="" type="text" value="<?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Disallow Button Text</label>
                                                                <input class="form-control" id="pf_noti_bluelagoon_mob_btn_disallow_txt" name="pf_noti_bluelagoon_mob_btn_disallow_txt" placeholder="" type="text" value="<?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="pf-popup-preivew pf-bluelagoon">
                                                            <div class="pf-default-preview-wrapper mobile-preview">
                                                                <div id="pf-push-dialog" class="">
                                                                    <div class="bluelagoon_optin">
                                                                        <div class="pf-push-dialog-image">
                                                                            <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/blue_lagoon_optin_logo.png">
                                                                        </div>
                                                                        <div class="pf-push-dialog-body">
                                                                            <div class="pf-dialog-bluelagoon-title">
                                                                                <?php echo isset($data['mobileOptSetting']['title']) ? $data['mobileOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>
                                                                            </div>
                                                                            <div class="pf-dialog-bluelagoon-subtitle">
                                                                                <?php echo isset($data['mobileOptSetting']['subTitle']) ? $data['mobileOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?>
                                                                            </div>
                                                                            <div class="pf-push-bluelagoon-dialog-btns">

                                                                                <button type="button" class="pf-bluelagoon-not-now-btn">
                                                                                    <?php echo isset($data['mobileOptSetting']['disallowButtonText']) ? $data['mobileOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?>
                                                                                </button>
                                                                                <button type="button" class="pf-bluelagoon-allow-btn">
                                                                                    <?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php /* ======== Tab 2 ======== */ ?>
                                <div class="tab_content">
                                    <div id="pf-tabs">
                                        <div class="tab_wrapper pf-desktop-mobile-tab third_tab">

                                            <ul class="tab_list">
                                                <li data-setting="dessktop" class="active"><a href="#">Desktop Settings</a></li>
                                                <li data-setting="mobile"><a href="#">Mobile Settings</a></li>
                                            </ul>

                                            <div class="content_wrapper">
                                                <div class="tab_content">
                                                    <div class="pf-tab-content-wrapper">
                                                        <div class="pf-tab-form">

                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input class="form-control" id="pf_noti_electro_desk_title" name="pf_noti_electro_desk_title" placeholder="Enter Title for popup" value="<?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Sub Title</label>
                                                                <input class="form-control" id="pf_noti_electro_desk_sub_title" name="pf_noti_electro_desk_sub_title" placeholder="Enter Sub Title for popup" value="<?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['mobileOptSetting']['title']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Allow Button Text</label>
                                                                <input class="form-control" id="pf_noti_electro_desk_btn_allow_txt" name="pf_noti_electro_desk_btn_allow_txt" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['title']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Disallow Button Text</label>
                                                                <input class="form-control" id="pf_noti_elctro_desk_btn_disallow_txt" name="pf_noti_elctro_desk_btn_disallow_txt" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['title']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="pf-popup-preivew pf-electrolite">
                                                            <div class="pf-default-preview-wrapper desktop-preview">
                                                                <div id="pf-push-dialog" class="">
                                                                    <div class="electrolite_optin">
                                                                        <div class="pf-push-dialog-image">
                                                                            <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/alien.jpg">
                                                                        </div>
                                                                        <div class="pf-push-dialog-body">
                                                                            <div class="pf-dialog-electro-title">
                                                                                <?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>
                                                                            </div>
                                                                            <div class="pf-dialog-electro-subtitle">
                                                                                <?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?>
                                                                            </div>
                                                                            <div class="pf-push-electro-dialog-btns">
                                                                                <button type="button" class="pf-electro-allow-btn">
                                                                                    <?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?>
                                                                                </button>
                                                                                <button type="button" class="pf-electro-not-now-btn">
                                                                                    <?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="tab_content">
                                                    <div class="pf-tab-content-wrapper">
                                                        <div class="pf-tab-form">

                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input class="form-control" id="pf_noti_electro_mob_title" name="pf_noti_electro_mob_title" placeholder="Enter Title for popup" value="<?php echo isset($data['mobileOptSetting']['title']) ? $data['mobileOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Sub Title</label>
                                                                <input class="form-control" id="pf_noti_electro_mob_sub_title" name="pf_noti_electro_mob_sub_title" placeholder="Enter Sub Title for popup" value="<?php echo isset($data['mobileOptSetting']['subTitle']) ? $data['mobileOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?>" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Allow Button Text</label>
                                                                <input class="form-control" id="pf_noti_electro_mob_btn_allow_txt" name="pf_noti_electro_mob_btn_allow_txt" placeholder="" type="text" value="<?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Disallow Button Text</label>
                                                                <input class="form-control" id="pf_noti_electro_mob_btn_disallow_txt" name="pf_noti_electro_mob_btn_disallow_txt" placeholder="" type="text" value="<?php echo isset($data['mobileOptSetting']['disallowButtonText']) ? $data['mobileOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="pf-popup-preivew pf-electrolite">
                                                            <div class="pf-default-preview-wrapper mobile-preview">
                                                                <div id="pf-push-dialog" class="">
                                                                    <div class="electrolite_optin">
                                                                        <div class="pf-push-dialog-image">
                                                                            <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/alien.jpg">
                                                                        </div>
                                                                        <div class="pf-push-dialog-body">
                                                                            <div class="pf-dialog-electro-title">
                                                                                <?php echo isset($data['mobileOptSetting']['title']) ? $data['mobileOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>
                                                                            </div>
                                                                            <div class="pf-dialog-electro-subtitle">
                                                                                <?php echo isset($data['mobileOptSetting']['subTitle']) ? $data['mobileOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?>
                                                                            </div>
                                                                            <div class="pf-push-electro-dialog-btns">
                                                                                <button type="button" class="pf-electro-allow-btn">
                                                                                    <?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?>
                                                                                </button>
                                                                                <button type="button" class="pf-electro-not-now-btn">
                                                                                    <?php echo isset($data['mobileOptSetting']['disallowButtonText']) ? $data['mobileOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php /* ======== Tab 3 ======== */ ?>	
                                <div class="tab_content">
                                    <div id="pf-tabs">
                                        <div class="tab_wrapper pf-desktop-mobile-tab second_tab">

                                            <ul class="tab_list">
                                                <li data-setting="dessktop" class="active"><a href="#">Desktop Settings</a></li>
                                                <li data-setting="mobile"><a href="#">Mobile Settings</a></li>
                                            </ul>

                                            <div class="content_wrapper">
                                                <div class="tab_content">
                                                    <div id="tabs-1-content">
                                                        <div class="pf-tab-content-wrapper">
                                                            <div class="pf-tab-form">
                                                                <div class="form-group">
                                                                    <label class="control-label">Title</label>
                                                                    <input class="form-control" id="pf_noti_desk_title" name="pf_noti_desk_title" placeholder="Enter Title for popup" value="<?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?>" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Sub Title</label>
                                                                    <input class="form-control" id="pf_noti_desk_sub_title" name="pf_noti_desk_sub_title" placeholder="Enter Sub Title for popup" value="<?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?>" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Allow Button Text</label>
                                                                    <input class="form-control" id="pf_noti_desk_btn_allow_txt" name="pf_noti_desk_btn_allow_txt" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <label class="control-label">Allow Button Background</label>
                                                                        <input class="form-control" value="<?php echo isset($data['desktopOptSetting']['allowButtonBackgroundColor']) ? $data['desktopOptSetting']['allowButtonBackgroundColor'] : $default_data['desktopOptSetting']['allowButtonBackgroundColor']; ?>" id="pf_noti_desk_btn_allow_bckgound" name="pf_noti_desk_btn_allow_bckgound" placeholder="" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Disallow Button Text</label>
                                                                    <input class="form-control" id="pf_noti_desk_btn_disallow_txt" name="pf_noti_desk_btn_disallow_txt" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Disallow Button Background</label>
                                                                    <input class="form-control" id="pf_noti_desk_btn_disallow_bckgound" value="<?php echo isset($data['desktopOptSetting']['disallowButtonBackgroundColor']) ? $data['desktopOptSetting']['disallowButtonBackgroundColor'] : $default_data['desktopOptSetting']['disallowButtonBackgroundColor']; ?>" name="pf_noti_desk_btn_disallow_bckgound" placeholder="" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">OptIn Background</label>
                                                                    <input class="form-control" id="pf_noti_desk_btn_optin_background" name="pf_noti_desk_btn_optin_background" placeholder="" type="text" value="<?php echo isset($data['desktopOptSetting']['optInBackgroundColor']) ? $data['desktopOptSetting']['optInBackgroundColor'] : $default_data['desktopOptSetting']['optInBackgroundColor']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">OptIn Alignment</label>
                                                                    <select name="pf_noti_desk_optin_alignment" class="pf-optin-postition">
                                                                        <option <?php echo isset($data['desktopOptSetting']['optInAlignment']) && $data['desktopOptSetting']['optInAlignment'] == 'topLeft' ? 'selected' : ''; ?>  value="topLeft">Top Left</option>
                                                                        <option <?php echo isset($data['desktopOptSetting']['optInAlignment']) && $data['desktopOptSetting']['optInAlignment'] == 'topRight' ? 'selected' : ''; ?> value="topRight">Top Right</option>
                                                                        <option <?php echo isset($data['desktopOptSetting']['optInAlignment']) && $data['desktopOptSetting']['optInAlignment'] == 'bottomLeft' ? 'selected' : ''; ?> value="bottomLeft">Bottom Left</option>
                                                                        <option <?php echo isset($data['desktopOptSetting']['optInAlignment']) && $data['desktopOptSetting']['optInAlignment'] == 'bottomRight' ? 'selected' : ''; ?> value="bottomRight">Bottom Right</option>
                                                                        <option <?php echo isset($data['desktopOptSetting']['optInAlignment']) && $data['desktopOptSetting']['optInAlignment'] == 'topCenter' ? 'selected' : ''; ?> value="topCenter">Top Center</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="pf-popup-preivew pf-customizable">
                                                                <div class="pf-default-preview-wrapper desktop-preview">
                                                                    <div id="pf-push-dialog" style="background: <?php echo isset($data['desktopOptSetting']['optInBackgroundColor']) ? $data['desktopOptSetting']['optInBackgroundColor'] : $default_data['desktopOptSetting']['optInBackgroundColor']; ?> none repeat scroll 0% 0%;border: 1px solid <?php echo isset($data['desktopOptSetting']['optInBackgroundColor']) ? $data['desktopOptSetting']['optInBackgroundColor'] : $default_data['desktopOptSetting']['optInBackgroundColor']; ?>;" class="window <?php echo isset($data['desktopOptSetting']['optInAlignment']) ? $data['desktopOptSetting']['optInAlignment'] : $default_data['desktopOptSetting']['optInAlignment']; ?>">
                                                                        <img src="https://app.pushflew.com<?php echo $logo_url; ?>">
                                                                        <div class="pf-push-dialog-body">
                                                                            <div class="pf-dialog-title"><?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?></div>
                                                                            <div class="pf-dialog-subtitle"><?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?></div>
                                                                        </div>
                                                                        <div class="pf-push-dialog-btns">
                                                                            <button type="button" style="background: <?php echo isset($data['desktopOptSetting']['allowButtonBackgroundColor']) ? $data['desktopOptSetting']['allowButtonBackgroundColor'] : $default_data['desktopOptSetting']['allowButtonBackgroundColor']; ?> none repeat scroll 0% 0%; border: 1px solid <?php echo isset($data['desktopOptSetting']['allowButtonBackgroundColor']) ? $data['desktopOptSetting']['allowButtonBackgroundColor'] : $default_data['desktopOptSetting']['allowButtonBackgroundColor']; ?>;" class="pf-allow-btn"><?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?></button>
                                                                            <button type="button" style="background: <?php echo isset($data['desktopOptSetting']['disallowButtonBackgroundColor']) ? $data['desktopOptSetting']['disallowButtonBackgroundColor'] : $default_data['desktopOptSetting']['disallowButtonBackgroundColor']; ?> none repeat scroll 0% 0%; border: 1px solid <?php echo isset($data['desktopOptSetting']['disallowButtonBackgroundColor']) ? $data['desktopOptSetting']['disallowButtonBackgroundColor'] : $default_data['desktopOptSetting']['disallowButtonBackgroundColor']; ?>;" class="pf-not-now-btn"><?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </div>
                                                </div>

                                                <div class="tab_content">
                                                    <div id="tabs-1-content">
                                                        <div class="pf-tab-content-wrapper">
                                                            <div class="pf-tab-form">
                                                                <div class="form-group">
                                                                    <label class="control-label">Title</label>
                                                                    <input class="form-control" id="pf_noti_mob_title" name="pf_noti_title" placeholder="Enter Title for popup" value="<?php echo isset($data['mobileOptSetting']['title']) ? $data['mobileOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?>" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Sub Title</label>
                                                                    <input class="form-control" id="pf_noti_mob_sub_title" name="pf_noti_sub_title" placeholder="Enter Sub Title for popup" value="<?php echo isset($data['mobileOptSetting']['subTitle']) ? $data['mobileOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?>" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Allow Button Text</label>
                                                                    <input class="form-control" id="pf_noti_mob_btn_allow_txt" name="pf_noti_btn_allow_txt" placeholder="" type="text" value="<?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <label class="control-label">Allow Button Background</label>
                                                                        <input class="form-control" value="<?php echo isset($data['mobileOptSetting']['allowButtonBackgroundColor']) ? $data['mobileOptSetting']['allowButtonBackgroundColor'] : $default_data['mobileOptSetting']['allowButtonBackgroundColor']; ?>" id="pf_noti_mob_btn_allow_bckgound" name="pf_noti_btn_allow_bckgound" placeholder="" type="text">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Disallow Button Text</label>
                                                                    <input class="form-control" id="pf_noti_mob_btn_disallow_txt" name="pf_noti_btn_disallow_txt" placeholder="" type="text" value="<?php echo isset($data['mobileOptSetting']['disallowButtonText']) ? $data['mobileOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Disallow Button Background</label>
                                                                    <input class="form-control" id="pf_noti_mob_btn_disallow_bckgound" name="pf_noti_btn_disallow_bckgound" placeholder="" value="<?php echo isset($data['mobileOptSetting']['disallowButtonBackgroundColor']) ? $data['mobileOptSetting']['disallowButtonBackgroundColor'] : $default_data['mobileOptSetting']['disallowButtonBackgroundColor']; ?>" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">OptIn Background</label>
                                                                    <input class="form-control" id="pf_noti_mob_btn_optin_background" name="pf_noti_btn_optin_background" placeholder="" value="<?php echo isset($data['mobileOptSetting']['optInBackgroundColor']) ? $data['mobileOptSetting']['optInBackgroundColor'] : $default_data['mobileOptSetting']['optInBackgroundColor']; ?>" type="text">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">OptIn Alignment</label>
                                                                    <select name="pf_noti_optin_alignment" class="pf-optin-postition-mobile">
                                                                        <option <?php echo isset($data['mobileOptSetting']['optInAlignment']) && $data['mobileOptSetting']['optInAlignment'] == 'mobileTop' ? 'selected' : ''; ?>  value="mobileTop">Top</option>
                                                                        <option <?php echo isset($data['mobileOptSetting']['optInAlignment']) && $data['mobileOptSetting']['optInAlignment'] == 'mobileCenter' ? 'selected' : ''; ?>  value="mobileCenter">Center</option>
                                                                        <option <?php echo isset($data['mobileOptSetting']['optInAlignment']) && $data['mobileOptSetting']['optInAlignment'] == 'mobileBottom' ? 'selected' : ''; ?>  value="mobileBottom">Bottom</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="pf-popup-preivew pf-customizable">
                                                                <div class="pf-default-preview-wrapper mobile-preview">
                                                                    <div id="pf-push-dialog" style="background: <?php echo isset($data['mobileOptSetting']['optInBackgroundColor']) ? $data['mobileOptSetting']['optInBackgroundColor'] : $default_data['mobileOptSetting']['optInBackgroundColor']; ?> none repeat scroll 0% 0%;border: 1px solid <?php echo isset($data['mobileOptSetting']['optInBackgroundColor']) ? $data['mobileOptSetting']['optInBackgroundColor'] : $default_data['mobileOptSetting']['optInBackgroundColor']; ?>;" class="window <?php echo isset($data['mobileOptSetting']['optInAlignment']) ? $data['mobileOptSetting']['optInAlignment'] : $default_data['mobileOptSetting']['optInAlignment']; ?>">
                                                                        <img src="https://app.pushflew.com<?php echo $logo_url; ?>">
                                                                        <div class="pf-push-dialog-body">
                                                                            <div class="pf-dialog-title"><?php echo isset($data['mobileOptSetting']['title']) ? $data['mobileOptSetting']['title'] : $default_data['mobileOptSetting']['title']; ?></div>
                                                                            <div class="pf-dialog-subtitle"><?php echo isset($data['mobileOptSetting']['subTitle']) ? $data['mobileOptSetting']['subTitle'] : $default_data['mobileOptSetting']['subTitle']; ?></div>
                                                                        </div>
                                                                        <div class="pf-push-dialog-btns">
                                                                            <button type="button" style="background: <?php echo isset($data['mobileOptSetting']['allowButtonBackgroundColor']) ? $data['mobileOptSetting']['allowButtonBackgroundColor'] : $default_data['mobileOptSetting']['allowButtonBackgroundColor']; ?> none repeat scroll 0% 0%; border: 1px solid <?php echo isset($data['mobileOptSetting']['allowButtonBackgroundColor']) ? $data['mobileOptSetting']['allowButtonBackgroundColor'] : $default_data['mobileOptSetting']['allowButtonBackgroundColor']; ?>;" class="pf-allow-btn"><?php echo isset($data['mobileOptSetting']['allowButtonText']) ? $data['mobileOptSetting']['allowButtonText'] : $default_data['mobileOptSetting']['allowButtonText']; ?></button>
                                                                            <button type="button" style="background: <?php echo isset($data['mobileOptSetting']['disallowButtonBackgroundColor']) ? $data['mobileOptSetting']['disallowButtonBackgroundColor'] : $default_data['mobileOptSetting']['disallowButtonBackgroundColor']; ?> none repeat scroll 0% 0%; border: 1px solid <?php echo isset($data['mobileOptSetting']['disallowButtonBackgroundColor']) ? $data['mobileOptSetting']['disallowButtonBackgroundColor'] : $default_data['mobileOptSetting']['disallowButtonBackgroundColor']; ?>;" class="pf-not-now-btn"><?php echo isset($data['mobileOptSetting']['disallowButtonText']) ? $data['mobileOptSetting']['disallowButtonText'] : $default_data['mobileOptSetting']['disallowButtonText']; ?></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="pf-reappear-time">
                            <div class="form-group">
                                <label class="control-label">Reappear time after "Not Now"(in days)</label>
                                <input type="number" value="<?php echo isset($data['reappearTime']) ? $data['reappearTime'] : $default_data['reappearTime']; ?>" name="reappearTime" min="0" class="form-control">
                                <div class="pf-errormassage"></div>
                            </div>
                        </div>

                        <div class="pf-display-form-opt">
                            <div class="form-group">
                                <label class="control-label">Display Form:</label>
                                <div class="pf-radio-list">
                                    <?php $displayEvent = isset($data['displayEvent']) && !empty($data['displayEvent']) ? $data['displayEvent'] : $default_data['displayEvent']; ?>
                                    <label class="pf-radio"> After a delay
                                        <input type="radio" <?php echo $displayEvent == 'delay' ? 'checked' : ''; ?> value="delay" name="displayEvent" class="pf-displayEvent-delay">
                                        <span></span>
                                    </label>
                                    <label class="pf-radio"> After specific scrolling
                                        <input type="radio" <?php echo $displayEvent == 'scroll' ? 'checked' : ''; ?> value="scroll" name="displayEvent" class="pf-displayEvent-scroll">
                                        <span></span>
                                    </label>
                                    <label class="pf-radio"> When user try to exit
                                        <input type="radio" <?php echo $displayEvent == 'exit' ? 'checked' : ''; ?> value="exit" name="displayEvent" class="pf-displayEvent-exit">
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="pf-appear-delay <?php echo $displayEvent == 'delay' ? 'active' : ''; ?>">
                                <div class="form-group">
                                    <label class="control-label">Delay (in seconds)</label>
                                    <input type="number" value="<?php echo isset($data['delay']) ? $data['delay'] : $default_data['delay']; ?>" name="pfdelay" min="0" class="form-control">
                                    <div class="pf-errormassage"></div>
                                </div>
                            </div>

                            <div class="pf-appear-scroll <?php echo $displayEvent == 'scroll' ? 'active' : ''; ?>">
                                <div class="form-group">
                                    <label class="control-label">Scroll (in % page scroll)</label>
                                    <input type="number" value="<?php echo isset($data['scroll']) ? $data['scroll'] : $default_data['scroll']; ?>" name="pfscroll" min="0" class="form-control">
                                    <div class="pf-errormassage"></div>
                                </div>
                            </div>
                        </div>

                        <?php //add_thickbox();   ?>
                        <?php
//                            $broadcast = menu_page_url('broadcast', 0);
//                            $broadcast_url = add_query_arg(array('save' => 'optn'), $broadcast);
                        ?>
                        <div class="pf-prompt-poup">
                            <h2>Prompt Message Settings
                                <a href="javascript:;" class="pf-prompt-example thickbox">Prompt Example</a>
                            </h2>
                            <div class="form-group">
                                <label class="control-label">Main Heading</label>
                                <input type="text" class="form-control" name="promptmessage_heading" id="pf-prompt-title" value="<?php echo isset($data['promptMessage']['heading']) ? $data['promptMessage']['heading'] : $default_data['promptMessage']['heading']; ?>">
                                <div class="pf-errormassage"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Details</label>
                                <textarea class="form-control" name="promptmessage_details" id="pf-prompt-details"><?php echo isset($data['promptMessage']['details']) ? $data['promptMessage']['details'] : $default_data['promptMessage']['details']; ?></textarea>
                                <div class="pf-errormassage"></div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="addedit_optin" />
                        <input type="hidden" name="logo_url" value="<?php echo $logo_url; ?>" />
                        <input type="hidden" name="mode" value="<?php echo $mode ?>" />
                        <input type="hidden" name="optin_id" value="<?php echo isset($optin) ? $optin : ''; ?>" />
                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('pf_addedit_optin'); ?>" />
                        <div class="pf-action-btns">
                            <input type="submit" name="pfsubmit" class="pf-btn-prime pf-btn-green-haze" value="Save Settings" />
                            <a href="javascript:;" data-layout="<?php echo isset($data['requestLayout']) ? $data['requestLayout'] : 'default'; ?>" data-setting="desktop" id="pf-full-window-prive" class="pf-btn-prime">Preview</a>
                            <a href="<?php echo admin_url('admin.php?page=optinlist'); ?>" class="pf-btn-prime pf-btn-default">Cancel</a>
                        </div>

                    </div>
				<input type="hidden" id="is_preview" value="0">
            </form>	
            <?php /* ==== Footer ==== */ ?>
            <div class="pf-help-block pf-top-brdr">
                <p>Need help with the setup? <a href="https://pushflew.com/contact-us/" target="_blank"> Just let us know.</a></p>
            </div>


            <div id="pf-thankyou">
                <a class="pf-thank-You-PreviewClose" href="javascript:;">Close Preview</a>
                <div class="pf-thankyou-outer-wrapper"></div>
                <div class="pf-thankyou-inner-wrapper">
                    <div class="pf-allow-popup-direction-image">
                        <img src="<?php echo plugins_url('assets/images/allow-arraw-light.png', dirname(__FILE__)); ?>">
                    </div>
                    <h1 class="pf-prompt-prevw-title"><?php echo isset($data['promptMessage']['heading']) ? $data['promptMessage']['heading'] : 'Push Flew'; ?></h1>
                    <p class="pf-prompt-prevw-details"><?php echo isset($data['promptMessage']['details']) ? $data['promptMessage']['details'] : 'Click on Allow button to receive push notifications. You can turn it off anytime.'; ?></p>
                </div>
            </div>

            <?php /* ==== PUSH Popup Full Desktop Preivew ==== */ ?>
            <div class="pf-popup-preivew pf-customizable full-window">
                <div class="pf-default-preview-wrapper desktop-preview">
                    <div style="background: <?php echo isset($data['desktopOptSetting']['optInBackgroundColor']) ? $data['desktopOptSetting']['optInBackgroundColor'] : $default_data['desktopOptSetting']['optInBackgroundColor']; ?> none repeat scroll 0% 0%;border: 1px solid <?php echo isset($data['desktopOptSetting']['optInBackgroundColor']) ? $data['desktopOptSetting']['optInBackgroundColor'] : $default_data['desktopOptSetting']['optInBackgroundColor']; ?>;" id="pf-push-dialog" class="window pf-push-dialog-bx <?php echo isset($data['desktopOptSetting']['optInAlignment']) ? $data['desktopOptSetting']['optInAlignment'] : $default_data['desktopOptSetting']['optInAlignment']; ?> pf-dialog-animation">
                        <img src="https://app.pushflew.com<?php echo $logo_url; ?>">
                        <div class="pf-push-dialog-body">
                            <div class="pf-dialog-title"><?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?></div>
                            <div class="pf-dialog-subtitle"><?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?></div>
                        </div>
                        <div class="pf-push-dialog-btns">
                            <button type="button" style="background: <?php echo isset($data['desktopOptSetting']['allowButtonBackgroundColor']) ? $data['desktopOptSetting']['allowButtonBackgroundColor'] : $default_data['desktopOptSetting']['allowButtonBackgroundColor']; ?> none repeat scroll 0% 0%; border: 1px solid <?php echo isset($data['desktopOptSetting']['allowButtonBackgroundColor']) ? $data['desktopOptSetting']['allowButtonBackgroundColor'] : $default_data['desktopOptSetting']['allowButtonBackgroundColor']; ?>;" class="pf-allow-btn"><?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?></button>
                            <button type="button" style="background: <?php echo isset($data['desktopOptSetting']['disallowButtonBackgroundColor']) ? $data['desktopOptSetting']['disallowButtonBackgroundColor'] : $default_data['desktopOptSetting']['disallowButtonBackgroundColor']; ?> none repeat scroll 0% 0%; border: 1px solid <?php echo isset($data['desktopOptSetting']['disallowButtonBackgroundColor']) ? $data['desktopOptSetting']['disallowButtonBackgroundColor'] : $default_data['desktopOptSetting']['disallowButtonBackgroundColor']; ?>;" class="pf-not-now-btn"><?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <?php /* ==== Blue Lagoon PUSH Popup Full Desktop Preivew ==== */ ?>
            <div class="pf-popup-preivew pf-bluelagoon full-window">
                <div class="pf-default-preview-wrapper desktop-preview">
					<div id="pf-push-dialog" class="pf-push-dialog-bx">
                        <div class="bluelagoon_optin">
                            <div class="pf-push-dialog-image">
                                <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/blue_lagoon_optin_logo.png">
                            </div>
                            <div class="pf-push-dialog-body">
                                <div class="pf-dialog-bluelagoon-title">
                                    <?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?>
                                </div>
                                <div class="pf-dialog-bluelagoon-subtitle">
                                    <?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?>
                                </div>
                                <div class="pf-push-bluelagoon-dialog-btns">

                                    <button type="button" class="pf-bluelagoon-not-now-btn">
                                        <?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?>
                                    </button>
                                    <button type="button" class="pf-bluelagoon-allow-btn">
                                        <?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php /* ==== Electro lite PUSH Popup Full Desktop Preivew ==== */ ?>
            <div class="pf-popup-preivew pf-electrolite full-window">
                <div class="pf-default-preview-wrapper desktop-preview">
					<div id="pf-push-dialog" class="pf-push-dialog-bx">
                        <div class="electrolite_optin">
                            <div class="pf-push-dialog-image">
                                <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/alien.jpg">
                            </div>
                            <div class="pf-push-dialog-body">
                                <div class="pf-dialog-electro-title">
                                    <?php echo isset($data['desktopOptSetting']['title']) ? $data['desktopOptSetting']['title'] : $default_data['desktopOptSetting']['title']; ?>
                                </div>
                                <div class="pf-dialog-electro-subtitle">
                                    <?php echo isset($data['desktopOptSetting']['subTitle']) ? $data['desktopOptSetting']['subTitle'] : $default_data['desktopOptSetting']['subTitle']; ?>
                                </div>
                                <div class="pf-push-electro-dialog-btns">
                                    <button type="button" class="pf-electro-allow-btn">
                                        <?php echo isset($data['desktopOptSetting']['disallowButtonText']) ? $data['desktopOptSetting']['disallowButtonText'] : $default_data['desktopOptSetting']['disallowButtonText']; ?>
                                    </button>
                                    <button type="button" class="pf-electro-not-now-btn">
                                        <?php echo isset($data['desktopOptSetting']['allowButtonText']) ? $data['desktopOptSetting']['allowButtonText'] : $default_data['desktopOptSetting']['allowButtonText']; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>     
        <script>
            jQuery(document).ready(function ($) {
                $(".first_tab").champ({
                    active_tab: '<?php echo $active_tab; ?>',
                });
            });
        </script>        
        <?php
    }

}
?>
