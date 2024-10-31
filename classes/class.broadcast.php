<?php

/* =====================
      pushflew Boradcast Class
======================= */

class PF_Broadcast {

    /* =====================
      pushflew Boradcast Push notification
      ======================= */

    public function getBroadcast_Content() {
		$pushflewData = Pushflew::getPushflewData();
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
			$logo = "https://app.pushflew.com".$pushflew_account->logo;
		}
		?>
        <div class="pf_push_notification">
            <div id="processingIndicator" class="loading_center" style="display: none;">
                <div style="margin-top: 18%;">
                    <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/loading.gif" alt="Loading..." style="max-height: 60px; max-width: 60px;">
                    <p style="font-size: 20px; color: #000;">Please Wait...</p>
                </div>
            </div>

            <h2>Push Broadcast</h2>
            <?php echo pf_upgradenow_message(); ?>
            <div class="updated notice">
                <p><a href="https://pushflew.groovehq.com/knowledge_base/topics/campaign-push-notifications" target="_blank" /><b>Learn more about Push Notifications Campaign</b></a></p>
            </div>
                        <?php 
                            $active_tab = '1';
                            if(isset($_GET['save']) && $_GET['save'] == 'optn'){
                                $active_tab = '1';
                            }
				if(isset($_GET['delete']) && $_GET['delete'] == 'optn'){
					$active_tab = '2';
				}
                        ?>
			<div class="tab_wrapper broadcast_setup_tab">
				<ul class="tab_list">
					<li>Send Push Broadcast</li>
					<li>Scheduled Broadcast</li>
					<li>Sent Broadcast</li>
				</ul>
				
				<div class="content_wrapper">
					
					<div class="tab_content active">
						<div class="wrap">	
							<form id="pf_broadcast_form" action="#" class="">
								<input type="hidden" name="action" value="send_broadcast" />    
								<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('pf_send_broadcast'); ?>" />   
								<div class="alert alert-danger display-hide" id="send_push_notification_alert">
									<button class="close" data-close="alert"></button>
                                    <span class="ng-binding"> All fields are mandatory </span>
								</div>
								<div class="form-group">
									<label class="control-label">Title</label>
									<input class="form-control" id="pf_title" name="pf_title" maxlength="48" placeholder="Maximum in 48 Characters." type="text">
									<div class="pf-errormassage"></div>
								</div>
								<div class="form-group">
									<label class="control-label">Message</label>
									<textarea id="pf_message" name="pf_message" class="form-control" maxlength="100" rows="2" placeholder="Maximum in 100 Characters." required=""></textarea>
									<div class="pf-errormassage"></div>
								</div>
								<div class="form-group">
									<label class="control-label">Landing Page URL</label>
									<input class="form-control" name="pf_landingURL" id="pf_landingURL" placeholder="Enter URL with http:// or https://" required="" type="text">
									<div class="pf-errormassage"></div>
								</div>
								<div class="form-group ">
									<label class="control-label">Image</label>
									<div class="fileinput fileinput-new div-dis-block" data-provides="fileinput">
										<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
											<img alt="" src="" id="preview_image" class="iconFile">
										</div>
										<div>
											<span class="btn red btn-outline btn-file">
												<span class="fileinput-new"> Select image </span>
												<span class="fileinput-exists"> Change </span>
												<input id="pf_image_button" name="iconFile" class="in-image" type="button"> </span>
											<span class="pf-help-block">Recommended size 192x192 pixels in jpg, jpeg or png format</span>
											<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
										</div>
									</div>
									<input type="hidden" name="pf_image_url" id="pf_image_url" value="" />
									<input type="hidden" name="pf_notification_type" id="pf_notification_type_id" value="" />
									<input type="hidden" name="pf_delivery_date" id="pf_delivery_date_id" value="" />
									<input type="hidden" name="pf_delivery_houre" id="pf_delivery_houre_id" value="" />
									<input type="hidden" name="pf_delivery_minite" id="pf_delivery_minite_id" value="" />
									<input type="hidden" name="pf_delivery_ampm" id="pf_delivery_ampm_id" value="" />
									<div class="pf-errormassage"></div>
								</div>
								<div class="form-actions">
									<div class="">
										<input type="submit" name="submit" value="Next" class="pf-btn-prime" />
										<a href="javascript:;" class="pf-btn-prime pf-btn-prime3">Cancel</a>
									</div>
									
								</div>
							</form>
						</div>
					</div>
					
					<?php /*======== Scheduled Notification =======*/ ?>
					<div class="tab_content">
						<div class="wrap">	
							 <div class="pf-schedule-setting-outer-wrap">
								<div id="processingIndicator" class="loading_center" style="display: none;">
									<div style="margin-top: 18%;">
										<img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/loading.gif" alt="Loading..." style="max-height: 60px; max-width: 60px;">
										<p style="font-size: 20px; color: #000;">Please Wait...</p>
									</div>
								</div>
								<div class="pf-broad-analytics-header">
									<div class="pf-broad-list-sort">
										<span>Showing</span>
										<select id="pf_s_size" class="pf-form-control">
											<option value="10">10</option>
											<option value="20">20</option>
											<option value="all">All</option>
										</select>
										
									</div>
								</div>	
								<div class="">
									<table class="table table-bordered" cellspacing="0">
										<thead>
										<tr>
											<th>Notification </th>
											<th colspan="2">Schedule Date</th>
										</tr>
										</thead>
										<tbody>
											  
										</tbody>
									</table>
								</div>
								<input type="hidden" name="total_records" id="total_records_sche" value="" />
								<input type="hidden" name="current_page" id="current_page" value="1" />
								<div id="pf_pagination_schedule"></div>
							</div>
						</div>
					</div>
					 
			<?php /*======== Sent Broadcast =======*/ ?> 
						 
					<div class="tab_content">
						<div class="wrap">	
							<div class="pf_pushanalytic">
								<div id="processingIndicator" class="loading_center" style="display: none;">
									<div style="margin-top: 18%;">
										<img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/loading.gif" alt="Loading..." style="max-height: 60px; max-width: 60px;">
										<p style="font-size: 20px; color: #000;">Please Wait...</p>
									</div>
								</div>
								
								<div class="pf-add-new-brod">
									<a href="" class="pf-btn-prime">New Broadcast</a>
								</div>
								
								<div class="pf-broad-analytics-header">
									<div class="pf-broad-list-sort">
										<span>Showing</span>
										<select id="pf_size" class="pf-form-control">
											<option value="10">10</option>
											<option value="20">20</option>
											<option value="all">All</option>
										</select>
										<span>Broadcast sorted by</span>
										<select id="pf_sort" onchange="push_analytics()" class="pf-form-control">
											<option value="Newest Sending Time">Newest Sending Time</option>
											<option value="Most Clicked">Most Clicked</option>
										</select>
									</div>

									<div class="pf-borad-list-search">
										<form>	
											<div class="form-group">
												<label>
													<input type="search" id="pf_broadcast_search" name="pf_broadcast_search" class="form-control"  placeholder="Search Broadcasts">
													<input type="button" class="pf_broadcast_search_btn" value="">
												</label>
											</div>
										</form>	
									</div>
								</div>	

								<div class="pf-campaigns-listing">
									<table class="table" cellspacing="0">
										<thead>
											<tr>
												<th>Notification</th>
												<th>Sent Date</th>
												<th>Number of recipient</th>
												<th>Number of clicks</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
								<input type="hidden" name="total_records" id="total_records" value="" />
								<input type="hidden" name="current_page" id="current_page" value="1" />
								<div id="pf_pagination"></div>
							</div>
						</div>
					</div>
					<script>
						jQuery(document).ready(function ($) {
							$(".broadcast_setup_tab").champ({
								active_tab: '<?php echo $active_tab; ?>',
							});
							/*---  broadcast Page tab ---*/
							$(document).on("click", '.brfpagination a', function (event) {   
								$(this).parents('.broadcast_setup_tab').find('.tab_content.active #current_page').val($(this).attr('data-id'));
                                                                var curpage = $(this).parents('.broadcast_setup_tab').find('.tab_content.active #current_page').val();
								push_analytics(curpage);
								scheduled_notifications(curpage);
							});
							$(document).on("change", '#pf_size, #pf_s_size', function (event) {    
								$(this).parents('.broadcast_setup_tab').find('.tab_content.active #current_page').val(1);
								push_analytics(1);
								scheduled_notifications(1);
							});
						
							/*--------- Delete - Scheduled Notification  ----------*/
							$(document).on("click",".pf-remv-icn", function () {
								var messageId = $(this).attr('id'); 
								var crow = $(this);
								var answer = confirm('Are you sure you want to delete this?');
								if (answer){
									function scheduled_notifications_delete() {
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'scheduled_notifications_delete', 
												messageId: messageId, 
											},
											dataType: 'json',
											success: function (data) {
												crow.closest('tr').remove();		
											},
											error: function (data) { 
												
											}
							});

									}
									scheduled_notifications_delete();
								}  
								 
						});
						
						});
						
						/*--------- Push List ----------*/
						function push_analytics(curre_page) {
							var size = jQuery('#pf_size').val();
							var sort = jQuery('#pf_sort').val();
							var total_records = jQuery('#total_records').val();
							var current_page = jQuery('#total_records').val();
							var page = curre_page;
							jQuery("#processingIndicator").show();
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'push_analytics', 
									size: size, 
									sort: sort, 
									total_records: total_records, 
									page: page, 
								},
								dataType: 'json',
								success: function (data) {
									jQuery("#processingIndicator").hide();
									if(data.success){
                                                                                //alert('asd');
										jQuery('.pf-campaigns-listing table tbody').html(data.data);
										jQuery("#total_records").val(data.total_record);
                                                                                setTimeout(function(){
                                                                                    jQuery("#pf_pagination").html(data.pagination);
                                                                                }, 1000);
									} else {
										jQuery('.pf-campaigns-listing table tbody').html(data.data);
										jQuery('#pf_pagination').html('');
									}    
								},
								error: function (data) {
									jQuery("#processingIndicator").hide();
									jQuery('#pf_pagination').html('');
								}
							});

						}
						push_analytics(1);
						
						
						function scheduled_notifications(curre_page) {
						 	var size = jQuery('#pf_s_size').val();
							var total_records = jQuery('#total_records_sche').val();
							var current_page = jQuery('#current_page').val();
							var page = curre_page;
							jQuery("#processingIndicator").show();
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'scheduled_notifications', 
									size: size, 
                                                                        total_records: total_records, 
									page: page, 
								},
								dataType: 'json',
								success: function (data) {
 									jQuery("#processingIndicator").hide();
									if(data.success){ 
										jQuery('.pf-schedule-setting-outer-wrap table tbody').html(data.data);
										jQuery('#pf_pagination_schedule').html(data.pagination);
										jQuery("#total_records_sche").val(data.total_record);
									} else { 
										jQuery('.pf-schedule-setting-outer-wrap table tbody').html(data.data);
										jQuery('#pf_pagination_schedule').html('');
									}    
								},
								error: function (data) { 
									jQuery("#processingIndicator").hide();
									jQuery('#pf_pagination_schedule').html('');
								}
							});

						}
						scheduled_notifications(1);
						 					
						 
					</script>
					 
				</div>
			</div>
		</div> 
		
		
	 <?php /*====== Display Schedule Popup For - Broadcast ======*/ ?>
	<div id="pf_schedule_noti_model" class="pf-cust-modal">
		<div class="pf-cust-modal-outer-wrapper"></div>
		
		<div class="pf-modal-dialog pf-cust-modal-inner-wrapper">
			<div class="pf-modal-content">
				<div class="pf-modal-header">
					<button type="button" class="pf-modal-close">×</button>
					<h4 class="pf-modal-title">Push Notification Settings</h4>
				</div>
				<div class="pf-modal-body">
					 <form class="pf-schedule-noti">
						<div class="form-group">
                            <label class="control-label">When should we send this broadcast?</label>
                            <select class="form-control pf-send-noti-time" id="pf_send_noti_types">
                                <option value="immediately">Immediately</option>
                                <option value="specificTime">At a specific time</option>
                            </select>
                        </div>
						<div class="pf-schedule-broad">
							<div class="form-group">
								<div>
									<label class="control-label">Delivery Date/Time :</label>
								</div>
								<span class="form-group pf-send-noti-dtpick">
									<span class="dashicons dashicons-calendar-alt"></span>
									<input type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="pf_send_noti_dtpick">
								</span>
								<span class="pf-send-noti-time">
									<span class="form-group">
										<input value="<?php echo date('g'); ?>" class="form-control" id="pf_send_noti_dthoure" type="number" min="1" max="12">
									</span>
									<span class="form-group">
										<input value="<?php echo date('i'); ?>" id="pf_send_noti_dttime" class="form-control" type="number" min="1" max="60">
									</span>
										<?php $ampm = date('A'); ?>
									<select class="form-control" id="pf_send_noti_dtampm">
										<option <?php echo $ampm == 'AM' ? 'selected=""' : '' ?>  value="AM">AM</option>
										<option <?php echo $ampm == 'PM' ? 'selected=""' : '' ?> value="PM">PM</option>
									</select>
								</span>
							</div>
							
							<div class="form-group">
								<label class="control-label">Timezone we will use :</label>
								<div class=""><?php echo date_default_timezone_get(); ?></div>
							</div>
				 		</div>
					 </form>
				</div>
				<div class="pf-modal-footer pf-send-immediate">
					<button type="button" class="pf-btn-prime pf-bck-btn pf-btn-prime3">Back</button>
					<a href="javascript:;" id="pf_send_brad_noti_immediate" class="pf-btn-prime pf-btn-green-haze">Send Immediately</a>
				</div>
				<div class="pf-modal-footer pf-schedule-broad">
					<button type="button" class="pf-btn-prime pf-bck-btn pf-btn-prime3">Back</button>
					<a href="javascript:;" id="pf_send_brad_noti_shedule" class="pf-btn-prime pf-btn-green-haze">Schedule Broadcast</a>
				</div>
			</div>
		</div>
		
	</div>
	
	<?php /*====== Display Confirm Popup - Broadcast ======*/ ?>
	<div id="pf_schedule_noti_confirm_model" class="pf-cust-modal">
		<div class="pf-cust-modal-outer-wrapper"></div>
		
		<div class="pf-modal-dialog pf-cust-modal-inner-wrapper">
			<div class="pf-modal-content">
				<div class="pf-modal-header">
					<button type="button" class="pf-modal-close">×</button>
					<h4 class="pf-modal-title">Confirm Push Notification Details</h4>
				</div>
				<div class="pf-modal-body">
					<div class="pf-brod-push-preview">
					   <h3>Notification preview</h3>
					   
						<div class="chrome-desktop-wrap">
							<h6>On Chrome Desktop</h6>
							<div class="pf-chrome-desktop-preview-wrap">
								<div class="pf-chrome-desktop-preview-image notification-preview-image-wrapper">
									<img id="pf_conf_pu_chro_img" src="">
								</div>
								<div class="pf-chrome-noti-preview-text">
									<p class="pf-chrome-heading"></p>
									<p class="pf-chrome-message"></p>
									<p class="pf-chrome-from-website">loremipsum.com</p>
								</div>
							</div>
						</div>
						<div class="pf-fire-desktop-wrap">
							<h6>On Firefox Desktop</h6>
							<div class="pf-fire-desktop-preview-wrap">
								<div class="pf-fire-desktop-icon">
									<img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/firefox-logo@2x.png">
								</div>
								<div class="pf-fire-noti-preview-text">
									<p class="pf-fire-heading">lorem</p>
									<p class="pf-fire-from-website">via loremipsum.com</p>
									<p class="pf-fire-message">lorem</p>
								</div>
								<div class="pf-fire-noti-icon notification-preview-image-wrapper">
									<img id="pf_conf_pu_firefox_img" src="" >
								</div>
							</div>
						</div>
						
					</div>
					<div class="pf-broad-push-landing">
						<h3>On Click URL -</h3>
						<a target="_blank" href="" class="pf_conf_pu_on_click_url"></a>
					</div>
				</div>
				<div class="pf-modal-footer pf-send-immediate">
					<button type="button" class="pf-btn-prime pf-confi-edit-btn pf-btn-prime3">Edit</button>
					<button type="button" id="pf_send__confrm_brad_noti_immediate" class="pf-btn-prime pf-btn-green-haze">Send Notification</button>
				</div>
				<div class="pf-modal-footer pf-schedule-broad">
					<button type="button" class="pf-btn-prime pf-confi-edit-btn pf-btn-prime3">Edit</button>
					<button type="button" id="" class="pf_send__confrm_brad_notification pf-btn-prime pf-btn-green-haze">Send Notification</button>
				</div>
			</div>
		</div>
		
	</div>
	 
            <?php
        }
}
?>
