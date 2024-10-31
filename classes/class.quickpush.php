<?php

class PF_Quickpush {

    public function getQuickpush_Content() {
?>
	<?php /*==== Header ====*/ ?>
<?php echo pf_upgradenow_message(); ?>  
	<div class='wrap pf-head pf-clearfix'>
		<span class="pf-title">Quick Push Setup</span>
	</div>
        
	<div class="pf-quick-setup">
		<div class="quick-setup-wrapper">
			<div class="pf-no-data">
				<span class="pf-totatl-subscriber"><span></span> Subscribers</span>
				<p>You have not completed the setup yet.</p>
				<p>Setup your subscription request message now and start collection push subscribers instantaneously</p>
				<a href="<?php echo menu_page_url('optinlist', 0); ?>" class="pf-btn-prime">Setup Subscription Request</a>
			</div>
		</div>
	</div>
	
	
	 
	<div class="pf-help-block pf-top-brdr">
		<p>Need help with the setup? <a href="https://pushflew.com/contact-us/" target="_blank"> Just let us know.</a></p>
	</div>


<?php
        }
    }