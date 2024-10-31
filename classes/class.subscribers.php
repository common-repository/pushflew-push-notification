<?php

class PF_subscriberslist {

    public function getSubscribers_Content() {
?>

	<?php /*==== Header ====*/ ?>
        <?php echo pf_upgradenow_message(); ?>
		
		<div id="processingIndicator" class="loading_center" style="display: none;">
			<div style="margin-top: 18%;">
				<img src="<?php echo PUSHFLEW_PLUGIN_URL; ?>assets/images/loading.gif" alt="Loading..." style="max-height: 60px; max-width: 60px;">
				<p style="font-size: 20px; color: #000;">Please Wait...</p>
			</div>
		</div>
								
	<div class='wrap pf-head pf-clearfix'>
		<span class="pf-title">Subscribers</span>
	</div>
	
	<div class="pf-subscribe-head-title">
		<div>
			<h3>Total Subscribers: <span id="head_total_records"></span></h3>
		</div>
		<?php /*
		<div class="pf-sub-cnt-prev">
			<h3>Subscribers in the last 7 days: <span>--</span></h3>
		</div> 
		*/ ?>
	</div>
	  
	<div class="pf-subscribe-list-content">
		 <table class="table" cellspacing="0">
			<thead>
			  <tr>
				<th>Date</th>
				<th>Browser</th>
				<th>Device</th>
				<th>IP Address</th>
				<th>Location</th>
				<th>Page</th>
			  </tr>
			</thead>
			<tbody>
			   
			</tbody>
		  </table>
	</div>
		<input type="hidden" name="total_records" id="total_records" value="" />
		<input type="hidden" name="current_page" id="current_page" value="1" />
		<div id="pf_pagination"></div>
	<script>
		jQuery(document).ready(function ($) {
			/*---  broadcast Page tab ---*/
			$(document).on("click", '.brfpagination a', function (event) {    
				jQuery("#current_page").val($(this).attr('data-id'));
				push_Susbcriptions();
			});
			$(document).on("change", '#pf_size', function (event) {    
				jQuery("#current_page").val(1);
				push_Susbcriptions();
			}); 
		}); 	  
		 
		 
	</script>
	
	
	<?php /* ==== Footer ==== */ ?>
	<div class="pf-help-block pf-top-brdr">
		<p>Need help with the setup? <a href="https://pushflew.com/contact-us/" target="_blank"> Just let us know.</a></p>
	</div>



<?php
        }
    }
?>