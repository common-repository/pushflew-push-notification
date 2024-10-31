<?php

if (!defined('ABSPATH')) {
    exit;
}

/* ----------------------------------------------------------------------------
 * pushflew send broadcast action
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_send_broadcast', 'pf_send_broadcast');

function pf_send_broadcast() {
    global $wpdb;
    $return = array('success' => false, 'message' => '');
    $nonce = $_REQUEST['nonce'];
    if (!wp_verify_nonce($nonce, 'pf_send_broadcast')) {
        wp_send_json($return);
    }
    $error = array();

    $authdata = Pushflew::getData();
    if (isset($authdata['auth']) && !empty($authdata['auth'])) {

        $pf_title = $_REQUEST['pf_title'];
        $pf_message = $_REQUEST['pf_message'];
        $pf_landingURL = $_REQUEST['pf_landingURL'];
        $pf_image_url = $_REQUEST['pf_image_url'];
        $pf_notification_type = isset($_REQUEST['pf_notification_type']) ? $_REQUEST['pf_notification_type'] : 'immediately';
        $pf_delivery_date = isset($_REQUEST['pf_delivery_date']) ? $_REQUEST['pf_delivery_date'] : '';
        $pf_delivery_houre = isset($_REQUEST['pf_delivery_houre']) ? $_REQUEST['pf_delivery_houre'] : '';
        if($pf_delivery_houre <= 9){
			$pf_delivery_houre = '0'.$pf_delivery_houre;
		}
		$pf_delivery_minite = isset($_REQUEST['pf_delivery_minite']) ? $_REQUEST['pf_delivery_minite'] : '';
        if($pf_delivery_minite <= 9){
			$pf_delivery_minite = '0'.$pf_delivery_minite;
		}
		$pf_delivery_ampm = isset($_REQUEST['pf_delivery_ampm']) ? $_REQUEST['pf_delivery_ampm'] : '';
   
		$body = array(
			'ctaButtons' => array(),
			'iconFile' => "/cs/".$authdata['websiteId']."-logo.png",
			'imageFile' => "",
			'imageURL' => $pf_image_url,
			'landingURL' => $pf_landingURL,
			'message' => $pf_message,
			'scheduleTime' => 0,
			'segmentId' => 0,
			'source' => "web",
			'timeToLive' => 2419200,
			'title' => $pf_title,
			'websiteId' => $authdata['websiteId']
        );
        $secduletime = 0;
        if($pf_notification_type == 'specificTime'){
         $secdule_time =  strtotime($pf_delivery_date.' '.$pf_delivery_houre.':'.$pf_delivery_minite.':00 '.$pf_delivery_ampm);
         $secduletime = (int)$secdule_time;
        }
		
        if($pf_notification_type == 'specificTime'){
			$postUrl = "https://app.pushflew.com/v1/push/scheduleNotification";
		}else{
			$postUrl = "https://app.pushflew.com/api/v1/send/all";
		}
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt_array($curl, array(
			CURLOPT_URL => $postUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\"iconFile\":\"".$pf_image_url."\",\"websiteId\":\"".$authdata['websiteId']."\",\"title\":\"".$pf_title."\",\"message\":\"".$pf_message."\",\"landingURL\":\"".$pf_landingURL."\",\"imageURL\":\"".$pf_image_url."\",\"timeToLive\":2419200,\"source\":\"web\",\"segmentId\":\"0\",\"imageFile\":\"\",\"ctaButtons\":[],\"scheduleTime\":".$secduletime."}",
			CURLOPT_HTTPHEADER => array(
				"authorization: ".$authdata['auth'],
				"cache-control: no-cache",
				"content-type: application/json",
			),
		));
		$result = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
			
        if($err) {
            $return = array('success' => false, 'message' => "Something went wrong: " . $err);
        } else {
            $return = array('success' => true, 'message' => 'Push notification is being sent to all subscribers');
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}

/* ----------------------------------------------------------------------------
 * pushflew Add/Edit Optin list
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_addedit_optin', 'pf_addedit_optin');

function pf_addedit_optin() {
    global $wpdb;
    
    $return = array('success' => false, 'message' => '');
    $nonce = $_REQUEST['nonce'];
    if (!wp_verify_nonce($nonce, 'pf_addedit_optin')) {
        wp_send_json($return);
    }
    $error = array();

    $authdata = Pushflew::getData();
    if (isset($authdata['auth']) && !empty($authdata['auth'])) {

        $pf_requestlayout = isset($_REQUEST['pf_requestlayout']) ? $_REQUEST['pf_requestlayout'] : 'default';

        if ($pf_requestlayout == 'blueLagoon') {

            $desktopOptSetting = array(
                'title' => $_REQUEST['pf_noti_bluelagoon_desk_title'],
                'subTitle' => $_REQUEST['pf_noti_bluelagoon_desk_sub_title'],
                'allowButtonText' => $_REQUEST['pf_noti_bluelagoon_desk_btn_allow_txt'],
                'disallowButtonText' => $_REQUEST['pf_noti_bluelagoon_desk_btn_disallow_txt'],
            );

            $mobileOptSetting = array(
                'title' => $_REQUEST['pf_noti_bluelagoon_mob_title'],
                'subTitle' => $_REQUEST['pf_noti_bluelagoon_mob_sub_title'],
                'allowButtonText' => $_REQUEST['pf_noti_bluelagoon_mob_btn_allow_txt'],
                'disallowButtonText' => $_REQUEST['pf_noti_bluelagoon_mob_btn_disallow_txt'],
            );
            
        } else if ($pf_requestlayout == 'electrolite') {
            
            $desktopOptSetting = array(
                'title' => $_REQUEST['pf_noti_electro_desk_title'],
                'subTitle' => $_REQUEST['pf_noti_electro_desk_sub_title'],
                'allowButtonText' => $_REQUEST['pf_noti_electro_desk_btn_allow_txt'],
                'disallowButtonText' => $_REQUEST['pf_noti_elctro_desk_btn_disallow_txt'],
            );

            $mobileOptSetting = array(
                'title' => $_REQUEST['pf_noti_electro_mob_title'],
                'subTitle' => $_REQUEST['pf_noti_electro_mob_sub_title'],
                'allowButtonText' => $_REQUEST['pf_noti_electro_mob_btn_allow_txt'],
                'disallowButtonText' => $_REQUEST['pf_noti_electro_mob_btn_disallow_txt'],
            );
            
        } else {

            $desktopOptSetting = array(
                'title' => $_REQUEST['pf_noti_desk_title'],
                'subTitle' => $_REQUEST['pf_noti_desk_sub_title'],
                'allowButtonText' => $_REQUEST['pf_noti_desk_btn_allow_txt'],
                'allowButtonBackgroundColor' => $_REQUEST['pf_noti_desk_btn_allow_bckgound'],
                'disallowButtonText' => $_REQUEST['pf_noti_desk_btn_disallow_txt'],
                'disallowButtonBackgroundColor' => $_REQUEST['pf_noti_desk_btn_disallow_bckgound'],
                'optInBackgroundColor' => $_REQUEST['pf_noti_desk_btn_optin_background'],
                'optInAlignment' => $_REQUEST['pf_noti_desk_optin_alignment'],
                'logo' => $_REQUEST['logo_url'],
            );

            $mobileOptSetting = array(
                'title' => $_REQUEST['pf_noti_title'],
                'subTitle' => $_REQUEST['pf_noti_sub_title'],
                'allowButtonText' => $_REQUEST['pf_noti_btn_allow_txt'],
                'allowButtonBackgroundColor' => $_REQUEST['pf_noti_btn_allow_bckgound'],
                'disallowButtonText' => $_REQUEST['pf_noti_btn_disallow_txt'],
                'disallowButtonBackgroundColor' => $_REQUEST['pf_noti_btn_disallow_bckgound'],
                'optInBackgroundColor' => $_REQUEST['pf_noti_btn_optin_background'],
                'optInAlignment' => $_REQUEST['pf_noti_optin_alignment'],
                'logo' => $_REQUEST['logo_url'],
            );
        }

        $body = array(
            'name' => trim($_REQUEST['optTitle']),
            'desktopOptSetting' => $desktopOptSetting,
            'mobileOptSetting' => $mobileOptSetting,
            'requestLayout' => trim($_REQUEST['pf_requestlayout']),
            'promptMessage' => array(
                'heading' => $_REQUEST['promptmessage_heading'],
                'details' => $_REQUEST['promptmessage_details'],
                'isHttpsPromptBox' => false,
            ),
            'httpsSubscriptionReqEvent' => 'custom_req',
            'reappearTime' => (int) $_REQUEST['reappearTime'],
            'displayEvent' => trim($_REQUEST['displayEvent']),
            'delay' => (int) $_REQUEST['pfdelay'],
            'scroll' => (int) $_REQUEST['pfscroll'],
            'websiteId' => $authdata['websiteId'],
        );
        
        if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'edit' && !empty($_REQUEST['optin_id'])) {
            $body['optInId'] = $_REQUEST['optin_id'];
            $reqdata = json_encode($body);
            $postUrl = "https://app.pushflew.com/v1/push/pushOptIn/".$_REQUEST['optin_id'];
            $response = wp_remote_request( $postUrl, array(
                'method' => 'PUT',
                'sslverify' => false,
                'timeout' => 100,
                'headers' => array("Content-type" => "application/json","Authorization:" => $authdata['auth']),
                'body' => $reqdata
            ));
        } else {
            $reqdata = json_encode($body);
            $postUrl = "https://app.pushflew.com/v1/push/pushOptIn";
            $response = wp_remote_post( $postUrl, array(
                'method' => 'POST',
                'sslverify' => false,
                'timeout' => 100,
                'headers' => array("Content-type" => "application/json","Authorization:" => $authdata['auth']),
                'body' => $reqdata
            ));
        }
        if (is_wp_error($response)) {
            $error_message = esc_html($response->get_error_message());
            $return = array('success' => false, 'message' => "Something went wrong: " . $error_message);
        } else if (isset($response['response']['code']) && $response['response']['code'] == '200') {
            $return = array('success' => true, 'message' => 'Success', 'redirect_url' => admin_url('admin.php?page=optinlist'));
        } else {
            $return = array('success' => false, 'message' => $response['response']['message']);
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}

/* ----------------------------------------------------------------------------
 * pushflew Optinlist Active/Deactive
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_pf_optin_onoff', 'pf_optin_onoff');
function pf_optin_onoff() {
    global $wpdb;
    
    $return = array('success' => false, 'message' => '');
    
    $authdata = Pushflew::getData();
    if (isset($authdata['auth']) && !empty($authdata['auth'])) {
        $optnlid = $_REQUEST['optinid'];
        $type = $_REQUEST['type'];
        
        if($type == 1)
            $postUrl = "https://app.pushflew.com/v1/push/activatePushOptIn/".$optnlid;
        else    
            $postUrl = "https://app.pushflew.com/v1/push/deactivatePushOptIn/".$optnlid;
        
        $response = wp_remote_request( $postUrl, array(
                'method' => 'PUT',
                'sslverify' => false,
                'timeout' => 100,
                'headers' => array("Content-type" => "application/json","Authorization:" => $authdata['auth']),
        ));
        
      if (is_wp_error($response)) {
            $error_message = esc_html($response->get_error_message());
            $return = array('success' => false, 'message' => "Something went wrong: " . $error_message,'active'=>$type);
        } else if (isset($response['response']['code']) && $response['response']['code'] == '200') {
            $return = array('success' => true, 'message' => 'Success', 'active'=>$type);
        } else {
            $return = array('success' => false, 'message' => $response['response']['message'],'active'=>$type);
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found','active'=>$type);
    }
    wp_send_json($return);
    die();
}


/* ----------------------------------------------------------------------------
 * pushflew Optinlist Delete
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_pf_optin_duplicate', 'pf_optin_duplicate');
function pf_optin_duplicate() {
    global $wpdb;
    
    $return = array('success' => false, 'message' => '');
    
    $authdata = Pushflew::getData();
    if (isset($authdata['auth']) && !empty($authdata['auth'])) {
        $optnlid = $_REQUEST['optinid'];
        
        $postUrl = "https://app.pushflew.com/v1/push/duplicatePushOptIn/".$optnlid;
        
        $response = wp_remote_post( $postUrl, array(
                'method' => 'POST',
                'sslverify' => false,
                'timeout' => 100,
                'headers' => array("Content-type" => "application/json","Authorization:" => $authdata['auth']),
        ));
        
      if (is_wp_error($response)) {
            $error_message = esc_html($response->get_error_message());
            $return = array('success' => false, 'message' => "Something went wrong: " . $error_message);
        } else if (isset($response['response']['code']) && $response['response']['code'] == '200') {
            $return = array('success' => true, 'message' => 'Success');
        } else {
            $return = array('success' => false, 'message' => $response['response']['message']);
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found','active'=>$type);
    }
    wp_send_json($return);
    die();
}

/* ----------------------------------------------------------------------------
 * pushflew Optinlist Duplicate
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_pf_optin_delete', 'pf_optin_delete');
function pf_optin_delete() {
    global $wpdb;
    
    $return = array('success' => false, 'message' => '');
    
    $authdata = Pushflew::getData();
    if (isset($authdata['auth']) && !empty($authdata['auth'])) {
        $optnlid = $_REQUEST['optinid'];
        
        $postUrl = "https://app.pushflew.com/v1/push/pushOptIn/".$optnlid;
        
        $response = wp_remote_request( $postUrl, array(
                'method' => 'DELETE',
                'sslverify' => false,
                'timeout' => 100,
                'headers' => array("Content-type" => "application/json","Authorization:" => $authdata['auth']),
        ));
        
      if (is_wp_error($response)) {
            $error_message = esc_html($response->get_error_message());
            $return = array('success' => false, 'message' => "Something went wrong: " . $error_message);
        } else if (isset($response['response']['code']) && $response['response']['code'] == '200') {
            $return = array('success' => true, 'message' => 'Success');
        } else {
            $return = array('success' => false, 'message' => $response['response']['message']);
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found','active'=>$type);
    }
    wp_send_json($return);
    die();
}

/* ----------------------------------------------------------------------------
 * pushflew multidimensional array sorting
 * ---------------------------------------------------------------------------- */

function pf_cmp_function($a, $b) {
    if ($a['numClicked'] < $b['numClicked']) {
        return 1;
    } else if ($a['numClicked'] > $b['numClicked']) {
        return -1;
    } else {
        return 0;
    }
}

/* ----------------------------------------------------------------------------
 * pushflew Push Analytics List action
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_push_analytics', 'pf_push_analytics');

function pf_push_analytics() {
    global $wpdb;
    $return = array('success' => false, 'message' => '');

    $authdata = Pushflew::getData();
    if (isset($authdata['auth']) && !empty($authdata['auth'])) {

        $size = $_REQUEST['size'];
        $sort = $_REQUEST['sort'];
        $total_records = $_REQUEST['total_records'] > 10 ? $_REQUEST['total_records'] : 10;
        $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $size = $size == 'all' ? $total_records : $size;
        $postUrl = "https://api.pushflew.com/v1/push/sentNotifications?size=" . $size . "&page=" . $page;
        $response = wp_remote_get($postUrl, array(
            'sslverify' => false,
            'timeout' => 100,
            'headers' => array("Authorization:" => $authdata['auth']),
                )
        );

        if (is_wp_error($response)) {
            echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
        } else {
            $result = json_decode($response['body'], true);
            $data = '';
            if (count($result['notifications']) > 0) {
                $notifications = $result['notifications'];
                if ($sort == 'Most Clicked') {
                    // usort($result['notifications'], 'numClicked');
                    usort($notifications, "pf_cmp_function");
                }
                foreach ($notifications as $_result) {

					
                    $data.= '<tr>
                            <td>
                                <div class="clearfix float-my-children">
                                      <img style="width:96px;height:96px;object-fit: contain;" src="' . $_result['iconFile'] . '">
                                      <div><h3 class="ng-binding">' . $_result['title'] . '</h3>' . $_result['message'] . '<br>' . $_result['landingURL'] . '</div>
                                </div>
                            </td>
                            <td>' . date("D", $_result['creationTime']) . ', ' . date("d M Y, H:i", $_result['creationTime']) . '</td>
                            <td>' . $_result['numDelivered'] . '</td>
                            <td>' . $_result['numClicked'] . '</td>
                        </tr>';
                }
                $pagination = pf_custom_pagination($result['totalCount'], 2, $page, $size);
                $return = array('success' => true, 'data' => $data, 'total_record' => $result['totalCount'], 'pagination' => $pagination);
            } else {
                $data.= '<tr>
                            <td colspan="4">
                                No Record Found.
                            </td>
                    </tr>';
                $return = array('success' => false, 'data' => $data, 'total_record' => 0);
            }
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}

/* ----------------------------------------------------------------------------
 * pushflew OptIn Templates List action
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_optin_templates', 'pf_optin_templates');

function pf_optin_templates() {

    global $wpdb;
    $return = array('success' => false, 'message' => '');

    $authdata = Pushflew::getData();

    if (isset($authdata['auth']) && !empty($authdata['auth'])) {

        $postUrl = "https://api.pushflew.com/v1/push/pushOptIn";
        $response = wp_remote_get($postUrl, array(
            'sslverify' => false,
            'timeout' => 100,
            'headers' => array("Authorization:" => $authdata['auth']),
                )
        );

        if (is_wp_error($response)) {
            echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
        } else {
            $result = json_decode($response['body'], true);
            $data = '';
            if ($result['status']) {
                $pushOptInList = $result['pushOptInList'];
                foreach ($pushOptInList as $_pushOptInList) {
                    $status = $_pushOptInList['status'] == 'active' ? 'checked' : '';
                    $data.= '<tr>
			<td>' . $_pushOptInList['name'] . '</td>
			<td>
				<div class="pf-opt_status">
					 <label class="pf-switch">
						<input class="pf-optin-onoff" data-id="'.$_pushOptInList['optInId'].'" type="checkbox" ' . $status . '>
						<span class="pf-status-slider pf-round"></span>
						<span class="pf-status-text">' . ucfirst($_pushOptInList['status']) . '</span>
					</label>
				 </div>
			</td> 
			<td><button class="pf-btn-prime">Display Rules</button></td>
			<td>
				<div class="pf-opt-actions">
					<a href="#" class="pf-btn-prime pf-action-btn" >Actions</a>
					
					<div id="pf-dd-menu-action" class="current">
						<ul class="pf-dropdown-menu">
							<li role="menuitem">
								<a href="' . menu_page_url('optinlist', 0) . '?page=optinlist&mode=edit&optin=' . $_pushOptInList['optInId'] . '">
									<i class="fa fa-pencil" aria-hidden="true"></i> Edit
								</a>
							</li>
							<li role="menuitem">
								<a  class="pf_optin_duplicate" data-id="'.$_pushOptInList['optInId'].'"   href="javascript:void(0);">
									<i class="fa fa-clone" aria-hidden="true"></i> Duplicate
								</a>
							</li>
							<li role="menuitem">
								<a class="pf_optin_active_dea" data-id="'.$_pushOptInList['optInId'].'" data-type="1"  href="javascript:void(0);">
									<i class="fa fa-play" aria-hidden="true"></i> Activate
								</a>
							</li>
							<li role="menuitem">
								<a class="pf_optin_active_dea" data-id="'.$_pushOptInList['optInId'].'" data-type="0"  href="javascript:void(0);">
									<i class="fa fa-pause" aria-hidden="true"></i> Deactivate
								</a>
							</li>
							<li role="menuitem">
								<a class="pf_optin_delete" data-id="'.$_pushOptInList['optInId'].'" href="javascript:void(0);">
									<i class="fa fa-trash" aria-hidden="true"></i> Delete
								</a>
							</li>
						</ul>
					</div>
				</div>
			</td>
		  </tr>';
                    $return = array('success' => true, 'data' => $data);
                }
            }
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}


/* ----------------------------------------------------------------------------
 * pushflew Scheduled Broadcast List action
 * ---------------------------------------------------------------------------- */
 
add_action('wp_ajax_scheduled_notifications', 'pf_scheduled_notifications');

function pf_scheduled_notifications() {

    global $wpdb;
    $return = array('success' => false, 'message' => '');

    $authdata = Pushflew::getData();

    if (isset($authdata['auth']) && !empty($authdata['auth'])) {
 
        $size = $_REQUEST['size'];
        $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $postUrl = "https://api.pushflew.com/v1/push/scheduledNotifications?size=" . $size . "&page=" . $page;
        $response = wp_remote_get($postUrl, array(
            'sslverify' => false,
            'timeout' => 100,
            'headers' => array("Authorization:" => $authdata['auth']),
                )
        );    

        if (is_wp_error($response)) {
            echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
        } else {
            $result = json_decode($response['body'], true);
		 
            $data = '';
            if (count($result['notifications']) > 0) {
                $notifications = $result['notifications'];
                 
				 foreach ($notifications as $_result) {

                    $data.= '<tr>
                            <td>
                                <div class="clearfix float-my-children">
									<div class="pf-schedule-list-img">
										<img style="" src="' . $_result['iconFile'] . '">
									 </div>
									<div class="pf-schedule-list-details">
										<h3 class="">' . $_result['title'] . '</h3>' . $_result['message'] . '<br>' . $_result['landingURL'] . '
									</div>
                                </div>
                            </td>
                            <td>' . date("D", $_result['scheduleTime']) . ', ' . date("d M Y, H:i", $_result['scheduleTime']) . '</td>
							<td>
								<a id="' .$_result['messageId'] . '" href="javascript:;" class="pf-btn-prime pf-btn-prime3 pf-remv-icn"><span class="dashicons dashicons-trash"></span>Delete </a>
								<input type="hidden" class="sced_item_delete" value="' .$_result['messageId'] . '">
							</td>
                        </tr>';
                }
                    $pagination = pf_custom_pagination($result['totalCount'], 2, $page, $size);
                $return = array('success' => true, 'data' => $data, 'total_record' => $result['totalCount'], 'pagination' => $pagination);
            } else {
                $data.= '<tr>
                            <td colspan="4">
                                No Record Found.
                            </td>
						</tr>';
                $return = array('success' => false, 'data' => $data, 'total_record' => 0);
            }
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}


/* ----------------------------------------------------------------------------
 * pushflew Scheduled Broadcast Delete acation
 * ---------------------------------------------------------------------------- */
 
add_action('wp_ajax_scheduled_notifications_delete', 'pf_scheduled_notifications_delete');

function pf_scheduled_notifications_delete() {

    global $wpdb;
	$return = array('success' => false, 'message' => '');
	
	$authdata = Pushflew::getData();

    if (isset($authdata['auth']) && !empty($authdata['auth'])) {
		
        $messageId = $_REQUEST['messageId'];
        $postUrl = "https://api.pushflew.com/v1/push/scheduledNotifications/". $messageId;
        $response = wp_remote_request($postUrl, array(
            'method' => 'DELETE',
            'sslverify' => false,
            'timeout' => 100,
            'headers' => array("Content-type" => "application/json","Authorization:" => $authdata['auth']),
            )
        );    
		
        if (is_wp_error($response)) {
            echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
        } else {
            $result = json_decode($response['body'], true);
			
			$return = array('success' => false, 'data' => $data, 'total_record' => 0);
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}


/* ----------------------------------------------------------------------------
 * pushflew Subscription List action
 * ---------------------------------------------------------------------------- */

add_action('wp_ajax_push_Susbcriptions', 'pf_push_Susbcriptions');

function pf_push_Susbcriptions() {

    global $wpdb;
    $return = array('success' => false, 'message' => '');

    $authdata = Pushflew::getData();

    if (isset($authdata['auth']) && !empty($authdata['auth'])) {
 
        $size = $_REQUEST['size'];
        $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $postUrl = "https://api.pushflew.com/v1/push/pushSusbcriptions?size=" . $size . "&page=" . $page;
        $response = wp_remote_get($postUrl, array(
            'sslverify' => false,
            'timeout' => 100,
            'headers' => array("Authorization:" => $authdata['auth']),
                )
        );    

        if (is_wp_error($response)) {
            echo '[PushFlew]Failed to check Pushflew server about data, try again. <br> Error:' . esc_html($response->get_error_message());
        } else {
            $result = json_decode($response['body'], true);

            $data = '';
            if (count($result['susbcriptions']) > 0) {
                $susbcriptions = $result['susbcriptions'];
                 
				 foreach ($susbcriptions as $_result) {
					$loc = json_decode($_result['ipAddressDetails'], true);
                    $data.= '<tr>
								<td>' . date("D", $_result['creationTime']) . ', ' . date("d M Y, H:i", $_result['creationTime']) . '</td>
								<td> '.$_result['platform'].' </td>
								<td> '.$_result['device'].' </td>
								<td> '.$_result['ipAddress'].' </td>
								<td> '.$loc['geoplugin_city'].', '.$loc['geoplugin_countryName'].' </td>
								<td> '.$_result['visitPage'].' </td>
							</tr>';
                }
                $pagination = pf_custom_pagination($result['totalCount'], 2, $page, $size);
                $return = array('success' => true, 'data' => $data, 'total_record' => $result['totalCount'], 'pagination' => $pagination);
            } else {
                $data.= '<tr>
                            <td colspan="4">
                                No Record Found.
                            </td>
						</tr>';
                $return = array('success' => false, 'data' => $data, 'total_record' => 0);
            }
        }
    } else {
        $return = array('success' => false, 'message' => 'API Token Not Found');
    }
    wp_send_json($return);
    die();
}
?>