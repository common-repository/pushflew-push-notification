<?php

class PF_pushbuilder {

    public function getPushBuilder_Content() {
?>

	<?php /*==== Header ====*/ ?>
	<div class='wrap pf-head pf-clearfix'>
		<span class="pf-title">Quick Push Setup</span>
	</div>
	
	<?php /*==== Content ====*/ ?>
	<form>
		<div id="pf_subscription_req">
			<div class="form-group">
				<label class="control-label">Optin Name</label>
				<input type="text" class="form-control" name="optTitle" value="Default" placeholder="Enter a name for Optin">
			</div>

			<div class="req_layout_wrapper">
				<h2>Request Layout</h2>
					<div class="tab_wrapper first_tab">
						<ul class="pf-tab_list tab_list">
							<li class="active">
								<input type="radio" class="req_layout_radio" id="req_layout_blueLagoon_id" value="blueLagoon" name="select_layout">
								<label class="req_layout_label" for="req_layout_blueLagoon_id">
									<img src="<?php echo plugins_url( 'assets/images/blue_lagoon.png', dirname(__FILE__) ); ?>" />
									<p class="req_layout_label_text">Blue Lagoon</p>
								</label>
							</li>
							<li>
								<input type="radio" class="req_layout_radio" id="req_layout_electrolite_id" value="electrolite" name="select_layout">
								<label class="req_layout_label" for="req_layout_electrolite_id">
									<img src="<?php echo plugins_url( 'assets/images/electrolite.png', dirname(__FILE__) ); ?>">
									<p class="req_layout_label_text">Electrolite</p>
								</label>
							</li>
							<li>
								<input type="radio" class="req_layout_radio" id="req_layout_customize_id" value="default" name="select_layout" checked>
								<label class="req_layout_label" for="req_layout_default_id">
									<img src="<?php echo plugins_url( 'assets/images/classic_optin.png', dirname(__FILE__) ); ?>">
									<p class="req_layout_label_text">Customizable Classic</p>
								</label>
							</li>
						</ul>	
						
						 <div class="content_wrapper">
							<?php /* ======== Tab 1 ======== */?>
							<div class="tab_content active">
								<div id="pf-tabs">
									<div class="tab_wrapper fourth_tab">
						
										<ul class="tab_list">
											<li class="active"><a href="#">Desktop Settings</a></li>
											<li><a href="#">Mobile Settings</a></li>
										</ul>

										<div class="content_wrapper">
											<div class="tab_content active">
												<div class="pf-tab-content-wrapper">
													<div class="pf-tab-form">

														<div class="form-group">
															<label class="control-label">Title</label>
															<input class="form-control" id="pf_noti_bluelagoon_desk_title" name="pf_noti_bluelagoon_desk_title" placeholder="Enter Title for popup" value="Lorem ipsum would like to send you notifications." type="text">
														</div>
														<div class="form-group">
															<label class="control-label">Sub Title</label>
															<input class="form-control" id="pf_noti_bluelagoon_desk_sub_title" name="pf_noti_bluelagoon_desk_sub_title" placeholder="Enter Sub Title for popup" value="You can turn it off anytime using browser settings." type="text">
														</div>
														<div class="form-group">
															<label class="control-label">Allow Button Text</label>
															<input class="form-control" id="pf_noti_bluelagoon_desk_btn_allow_txt" name="pf_noti_bluelagoon_desk_btn_allow_txt" placeholder="" type="text" value="Allow">
														</div>
														<div class="form-group">
															<label class="control-label">Disallow Button Text</label>
															<input class="form-control" id="pf_noti_bluelagoon_desk_btn_disallow_txt" name="pf_noti_bluelagoon_desk_btn_disallow_txt" placeholder="" type="text" value="Not Now">
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
																			Lorem ipsum would like to send you notifications.
																		</div>
																		<div class="pf-dialog-bluelagoon-subtitle">
																			You can turn it off anytime using browser settings.
																		</div>
																		<div class="pf-push-bluelagoon-dialog-btns">
																			
																			<button type="button" class="pf-bluelagoon-not-now-btn">
																				Not Now
																			</button>
																			<button type="button" class="pf-bluelagoon-allow-btn">
																				Allow
																			</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

												</div>
												
											</div>
				
											<div class="tab_content active">
												<div class="pf-tab-content-wrapper">
													<div class="pf-tab-form">

														<div class="form-group">
																<label class="control-label">Title</label>
																<input class="form-control" id="pf_noti_bluelagoon_mob_title" name="pf_noti_bluelagoon_mob_title" placeholder="Enter Title for popup" value="Lorem ipsum would like to send you notifications." type="text">
															</div>
															<div class="form-group">
																<label class="control-label">Sub Title</label>
																<input class="form-control" id="pf_noti_bluelagoon_mob_sub_title" name="pf_noti_bluelagoon_mob_sub_title" placeholder="Enter Sub Title for popup" value="You can turn it off anytime using browser settings." type="text">
															</div>
															<div class="form-group">
																<label class="control-label">Allow Button Text</label>
																<input class="form-control" id="pf_noti_bluelagoon_mob_btn_allow_txt" name="pf_noti_bluelagoon_mob_btn_allow_txt" placeholder="" type="text" value="Allow">
															</div>
															<div class="form-group">
																<label class="control-label">Disallow Button Text</label>
																<input class="form-control" id="pf_noti_bluelagoon_mob_btn_disallow_txt" name="pf_noti_bluelagoon_mob_btn_disallow_txt" placeholder="" type="text" value="Not Now">
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
																			Lorem ipsum would like to send you notifications.
																		</div>
																		<div class="pf-dialog-bluelagoon-subtitle">
																			You can turn it off anytime using browser settings.
																		</div>
																		<div class="pf-push-bluelagoon-dialog-btns">
																			
																			<button type="button" class="pf-bluelagoon-not-now-btn">
																				Not Now
																			</button>
																			<button type="button" class="pf-bluelagoon-allow-btn">
																				Allow
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
							<?php /* ======== Tab 2 ======== */?>
							<div class="tab_content">
								<div id="pf-tabs">
									<div class="tab_wrapper third_tab">
						
										<ul class="tab_list">
											<li class="active"><a href="#">Desktop Settings</a></li>
											<li><a href="#">Mobile Settings</a></li>
										</ul>

										<div class="content_wrapper">
											<div class="tab_content active">
												<div class="pf-tab-content-wrapper">
													<div class="pf-tab-form">

														<div class="form-group">
															<label class="control-label">Title</label>
															<input class="form-control" id="pf_noti_electro_desk_title" name="pf_noti_electro_desk_title" placeholder="Enter Title for popup" value="Lorem ipsum would like to send you notifications." type="text">
														</div>
														<div class="form-group">
															<label class="control-label">Sub Title</label>
															<input class="form-control" id="pf_noti_electro_desk_sub_title" name="pf_noti_electro_desk_sub_title" placeholder="Enter Sub Title for popup" value="You can turn it off anytime using browser settings." type="text">
														</div>
														<div class="form-group">
															<label class="control-label">Allow Button Text</label>
															<input class="form-control" id="pf_noti_electro_desk_btn_allow_txt" name="pf_noti_electro_desk_btn_allow_txt" placeholder="" type="text" value="Allow">
														</div>
														<div class="form-group">
															<label class="control-label">Disallow Button Text</label>
															<input class="form-control" id="pf_noti_elctro_desk_btn_disallow_txt" name="pf_noti_elctro_desk_btn_disallow_txt" placeholder="" type="text" value="Not Now">
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
																			Lorem ipsum would like to send you notifications.
																		</div>
																		<div class="pf-dialog-electro-subtitle">
																			You can turn it off anytime using browser settings.
																		</div>
																		<div class="pf-push-electro-dialog-btns">
																			<button type="button" class="pf-electro-allow-btn">
																				Allow
																			</button>
																			<button type="button" class="pf-electro-not-now-btn">
																				Not Now
																			</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

												</div>
											
											</div>
				
											<div class="tab_content active">
												<div class="pf-tab-content-wrapper">
													<div class="pf-tab-form">

														<div class="form-group">
																<label class="control-label">Title</label>
																<input class="form-control" id="pf_noti_electro_mob_title" name="pf_noti_electro_mob_title" placeholder="Enter Title for popup" value="Lorem ipsum would like to send you notifications." type="text">
															</div>
															<div class="form-group">
																<label class="control-label">Sub Title</label>
																<input class="form-control" id="pf_noti_electro_mob_sub_title" name="pf_noti_electro_mob_sub_title" placeholder="Enter Sub Title for popup" value="You can turn it off anytime using browser settings." type="text">
															</div>
															<div class="form-group">
																<label class="control-label">Allow Button Text</label>
																<input class="form-control" id="pf_noti_electro_mob_btn_allow_txt" name="pf_noti_electro_mob_btn_allow_txt" placeholder="" type="text" value="Allow">
															</div>
															<div class="form-group">
																<label class="control-label">Disallow Button Text</label>
																<input class="form-control" id="pf_noti_electro_mob_btn_disallow_txt" name="pf_noti_electro_mob_btn_disallow_txt" placeholder="" type="text" value="Not Now">
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
																			Lorem ipsum would like to send you notifications.
																		</div>
																		<div class="pf-dialog-electro-subtitle">
																			You can turn it off anytime using browser settings.
																		</div>
																		<div class="pf-push-electro-dialog-btns">
																			<button type="button" class="pf-electro-allow-btn">
																				Allow
																			</button>
																			<button type="button" class="pf-electro-not-now-btn">
																				Not Now
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
							<?php /* ======== Tab 3 ======== */?>	
							<div class="tab_content">
								<div id="pf-tabs">
									<div class="tab_wrapper second_tab">
						
										<ul class="tab_list">
											<li class="active"><a href="#">Desktop Settings</a></li>
											<li><a href="#">Mobile Settings</a></li>
										</ul>
						
										<div class="content_wrapper">
											<div class="tab_content active">
												<div id="tabs-1-content">
													<div class="pf-tab-content-wrapper">
														<div class="pf-tab-form">
															<div class="form-group">
																<label class="control-label">Title</label>
																<input class="form-control" id="pf_noti_desk_title" name="pf_noti_desk_title" placeholder="Enter Title for popup" value="Lorem ipsum would like to send you notifications." type="text">
															</div>
															<div class="form-group">
																<label class="control-label">Sub Title</label>
																<input class="form-control" id="pf_noti_desk_sub_title" name="pf_noti_desk_sub_title" placeholder="Enter Sub Title for popup" value="You can turn it off anytime using browser settings." type="text">
															</div>
															<div class="form-group">
																<label class="control-label">Allow Button Text</label>
																<input class="form-control" id="pf_noti_desk_btn_allow_txt" name="pf_noti_desk_btn_allow_txt" placeholder="" type="text" value="Allow">
															</div>
															<div class="form-group">
																<div class="">
																	<label class="control-label">Allow Button Background</label>
																	<input class="form-control" value="#bada55" id="pf_noti_desk_btn_allow_bckgound" name="pf_noti_desk_btn_allow_bckgound" placeholder="" type="text">
																</div>
															</div>
															<div class="form-group">
																<label class="control-label">Disallow Button Text</label>
																<input class="form-control" id="pf_noti_desk_btn_disallow_txt" name="pf_noti_desk_btn_disallow_txt" placeholder="" type="text" value="Not Now">
															</div>
															<div class="form-group">
																<label class="control-label">Disallow Button Background</label>
																<input class="form-control" id="pf_noti_desk_btn_disallow_bckgound" name="pf_noti_desk_btn_disallow_bckgound" placeholder="" type="text">
															</div>
															<div class="form-group">
																<label class="control-label">OptIn Background</label>
																<input class="form-control" id="pf_noti_desk_btn_optin_background" name="pf_noti_desk_btn_optin_background" placeholder="" type="text">
															</div>
															<div class="form-group">
																<label class="control-label">OptIn Alignment</label>
																<select class="pf-optin-postition">
																	<option value="pftopLeft">Top Left</option>
																	<option value="pftopRight">Top Right</option>
																	<option value="pfbottomLeft">Bottom Left</option>
																	<option value="pfbottomRight">Bottom Right</option>
																	<option value="pftopCenter">Top Center</option>
																</select>
															</div>
														</div>
														
														<div class="pf-popup-preivew">
															<div class="pf-default-preview-wrapper desktop-preview">
																<div id="pf-push-dialog" class="window pftopLeft">
																  <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/send-broadcast.png">
																  <div class="pf-push-dialog-body">
																	<div class="pf-dialog-title">Lorem ipsum would like to send you notifications.</div>
																	<div class="pf-dialog-subtitle">You can turn it off anytime using browser settings.</div>
																  </div>
																  <div class="pf-push-dialog-btns">
																	<button type="button" class="pf-allow-btn">Allow</button>
																	<button type="button" class="pf-not-now-btn">Not Now</button>
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
																	<input class="form-control" id="pf_noti_mob_title" name="pf_noti_title" placeholder="Enter Title for popup" value="Lorem ipsum would like to send you notifications." type="text">
																</div>
																<div class="form-group">
																	<label class="control-label">Sub Title</label>
																	<input class="form-control" id="pf_noti_mob_sub_title" name="pf_noti_sub_title" placeholder="Enter Sub Title for popup" value="You can turn it off anytime using browser settings." type="text">
																</div>
																<div class="form-group">
																	<label class="control-label">Allow Button Text</label>
																	<input class="form-control" id="pf_noti_mob_btn_allow_txt" name="pf_noti_btn_allow_txt" placeholder="" type="text" value="Allow">
																</div>
																<div class="form-group">
																	<div class="">
																		<label class="control-label">Allow Button Background</label>
																		<input class="form-control" value="#bada55" id="pf_noti_mob_btn_allow_bckgound" name="pf_noti_btn_allow_bckgound" placeholder="" type="text">
																	</div>
																</div>
																<div class="form-group">
																	<label class="control-label">Disallow Button Text</label>
																	<input class="form-control" id="pf_noti_mob_btn_disallow_txt" name="pf_noti_btn_disallow_txt" placeholder="" type="text" value="Not Now">
																</div>
																<div class="form-group">
																	<label class="control-label">Disallow Button Background</label>
																	<input class="form-control" id="pf_noti_mob_btn_disallow_bckgound" name="pf_noti_btn_disallow_bckgound" placeholder="" type="text">
																</div>
																<div class="form-group">
																	<label class="control-label">OptIn Background</label>
																	<input class="form-control" id="pf_noti_mob_btn_optin_background" name="pf_noti_btn_optin_background" placeholder="" type="text">
																</div>
																<div class="form-group">
																	<label class="control-label">OptIn Alignment</label>
																	<select class="pf-optin-postition-mobile">
																		<option value="pftop">Top</option>
																		<option value="pfCenter">Center</option>
																		<option value="pfbottom">Bottom</option>
																	</select>
																</div>
															</div>
															
															<div class="pf-popup-preivew">
																<div class="pf-default-preview-wrapper mobile-preview">
																	<div id="pf-push-dialog" class="window pftop">
																	  <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/send-broadcast.png">
																	  <div class="pf-push-dialog-body">
																		<div class="pf-dialog-title">Lorem ipsum would like to send you notifications.</div>
																		<div class="pf-dialog-subtitle">You can turn it off anytime using browser settings.</div>
																	  </div>
																	  <div class="pf-push-dialog-btns">
																		<button type="button" class="pf-allow-btn">Allow</button>
																		<button type="button" class="pf-not-now-btn">Not Now</button>
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
					<input type="number" min="0" class="form-control">
				</div>
			</div>
			
			<div class="pf-display-form-opt">
				<div class="form-group">
					<label class="control-label">Display Form:</label>
					<div class="pf-radio-list">
					  <label class="pf-radio"> After a delay
						<input type="radio" value="delay" name="displayEvent" class="pf-displayEvent-delay" checked="">
						<span></span>
					  </label>
					  <label class="pf-radio"> After specific scrolling
						<input type="radio" value="scroll" name="displayEvent" class="pf-displayEvent-scroll">
						<span></span>
					  </label>
					  <label class="pf-radio"> When user try to exit
						<input type="radio" value="exit" name="displayEvent" class="pf-displayEvent-exit">
						<span></span>
					  </label>
					</div>
				</div>
				
				<div class="pf-appear-delay active">
					<div class="form-group">
						<label class="control-label">Delay (in seconds)</label>
						<input type="number" min="0" class="form-control">
					</div>
				</div>
				
				<div class="pf-appear-scroll">
					<div class="form-group">
						<label class="control-label">Scroll (in % page scroll)</label>
						<input type="number" min="0" class="form-control">
					</div>
				</div>
			</div>
			 
			 <?php //add_thickbox(); ?>
			<div class="pf-prompt-poup">
				<h2>Prompt Message Settings
					<a href="javascript:;" class="pf-prompt-example thickbox">Prompt Example</a>
				</h2>
				<div class="form-group">
					<label class="control-label">Main Heading</label>
					<input type="text" class="form-control" id="pf-prompt-title" value="Lorem Ipsum">
				</div>
				<div class="form-group">
					<label class="control-label">Details</label>
					<textarea class="form-control" id="pf-prompt-details">Click on Allow button to receive push notifications. You can turn it off anytime.</textarea>
				</div>
			</div>
			
			<div class="pf-action-btns">
				<a href="javascript:;" class="pf-btn-prime pf-btn-green-haze">Save Settings</a>
				<a href="javascript:;" id="pf-full-window-prive" class="pf-btn-prime">Preview</a>
				<a href="javascript:;" class="pf-btn-prime pf-btn-default">Cancel</a>
			</div>
			
		</div>
	</form>	
	<?php /*==== Footer ====*/ ?>
	<div class="pf-help-block pf-top-brdr">
		<p>Need help with the setup? <a href="https://pushflew.com/contact-us/" target="_blank"> Just let us know.</a></p>
	</div>

	
	<div id="pf-thankyou">
		<a class="pf-thank-You-PreviewClose" href="javascript:;">Close Preview</a>
		<div class="pf-thankyou-outer-wrapper"></div>
		<div class="pf-thankyou-inner-wrapper">
			<div class="pf-allow-popup-direction-image">
				<img src="<?php echo plugins_url( 'assets/images/allow-arraw-light.png', dirname(__FILE__) ); ?>">
			</div>
			<h1 class="pf-prompt-prevw-title">Lorem Ipsum</h1>
			<p class="pf-prompt-prevw-details">Click on Allow button to receive push notifications. You can turn it off anytime.</p>
		</div>
	</div>
	
	<?php /*==== PUSH Popup Full Desktop Preivew ====*/ ?>
	<div class="pf-popup-preivew full-window">
		<div class="pf-default-preview-wrapper desktop-preview">
			<div id="pf-push-dialog" class="window pftop pf-dialog-animation">
			  <img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/send-broadcast.png">
			  <div class="pf-push-dialog-body">
				<div class="pf-dialog-title">Lorem ipsum would like to send you notifications.</div>
				<div class="pf-dialog-subtitle">You can turn it off anytime using browser settings.</div>
			  </div>
			  <div class="pf-push-dialog-btns">
				<button type="button" class="pf-allow-btn">Allow</button>
				<button type="button" class="pf-not-now-btn">Not Now</button>
			  </div>
			</div>
		</div>
	</div>
	

<?php
 
	
        }
    }