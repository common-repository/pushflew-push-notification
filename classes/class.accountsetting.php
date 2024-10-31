<?php

class PF_accountsetting {

    public function getAccountSetting_Content() {
?>

	<?php /*==== Header ====*/ ?>
        <?php echo pf_upgradenow_message(); ?>
	<div class='wrap pf-head pf-clearfix'>
		<span class="pf-title">Account Setting</span>
	</div>
	
	 <?php /*====== General Setting ===========*/ ?>
				<div class="tab_content">
					<div class="wrap">	
						<form id="pf_broadcast_form" action="#" class="pf-general-setting">
							<div class="form-group">
								<label class="control-label"><b>Website Id : </b>Loremipsum</label>
							</div>
							<div class="form-group">
								<label class="control-label"><b>Website : </b> http://loremipsum.com</label>
							</div>
							<div class="form-group">
								<label class="control-label"><b>Sub Domain : </b>Lorem</label>
							</div>
							<div class="form-group">
								<label class="control-label">Company Name</label>
								<input type="text" class="form-control"> 
							</div>
							<div class="form-group ">
								<label class="control-label">Logo</label>
								<div class="fileinput fileinput-new div-dis-block" data-provides="fileinput">
									<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
										<img alt="" src="" id="pf_preview_image_gen" class="iconFile">
									</div>
									<div>
										<span class="btn red btn-outline btn-file">
											<span class="fileinput-new"> Select image </span>
											<input id="pf_image_button_gen_set" name="pf_general_setting_iconFile" class="in-image" type="button"> 
										</span>
										<span class="pf-help-block">
										Please upload image in square size with maximum length upto 500px</br>
										(Recommended size 192x192 pixels in jpg, jpeg or png format)</span>
									</div>
								</div>
								<input type="hidden" name="pf_image_url" id="pf_image_url2" value="">
								<div class="pf-errormassage"></div>
							</div>
							<div class="form-actions">
								<div class="">
									<a href="javascript:;" class="pf-btn-prime"> Save Settings</a>
									<a href="javascript:;" class="pf-btn-prime pf-btn-green-haze">Cancel </a>
								</div>
							</div>
						</form>
					</div>
				</div>
	
	
	
	<?php /* ==== Footer ==== */ ?>
		<div class="pf-help-block pf-top-brdr">
			<p>Need help with the setup? <a href="https://pushflew.com/contact-us/" target="_blank"> Just let us know.</a></p>
		</div>



<?php
 
	
        }
    }