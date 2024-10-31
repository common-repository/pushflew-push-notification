<?php

class PF_campaignlist {

    public function getCampaignList_Content() {
?>

	<?php /*==== Header ====*/ ?>
	<div class='wrap pf-head pf-clearfix'>
		<span class="pf-title">Broadcast Push</span>
	</div>
	
	<div class="pf-broad-analytics-header">
		<div class="pf-broad-list-sort">
			<span>Showing</span>
			<select class="pf-form-control">
			  <option value="all">All</option>
			  <option value="10">10</option>
			  <option value="20">20</option>
			</select>
			<span>Broadcast sorted by</span>
			<select class="pf-form-control">
			  <option value="Newest Sending Time">Newest Sending Time</option>
			  <option value="Most Clicked">Most Clicked</option>
			</select>
		</div>
		
		<div class="pf-borad-list-search">
			<form>
				<div class="form-group">
					<label>
						<input type="search" id="pf_broadcast_search" name="pf_broadcast_search" class="form-control"  placeholder="Search Broadcasts">
						<input type="submit" class="pf_broadcast_search_btn" value="">
					</label>
				</div>
			</form>	
		</div>
	</div>	
	
	<div class="pf-campaigns-listing">
		 <table class="table" cellspacing="0">
			<thead>
			  <tr>
				<th>
					<select class="">
					  <option value="all">Group: Everything</option>
					  <option value="">Lorem</option>
					  <option value="">Lorem</option>
					</select>
				</th>
				<th>Opens</th>
				<th>Clicks</th>
				<th>Conversions</th>
				<th>Unsubscribes</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>
					<h4>New Broadcast</h4>
					<p class="pf-subscribe-count">
						<span>0 Subscriber</span>
						<span class="pf-campaigns-date"></span>
					</p>
				</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			  </tr>
			  <tr>
				<td>
					<h4>Test broadcast</h4>
					<p class="pf-subscribe-count">
						<span>268 Subscriber</span>
						<span class="pf-campaigns-date"></span>
					</p>
				</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			  </tr>
			  <tr>
				<td>
					<h4>Drop Shipping 101</h4>
					<p class="pf-subscribe-count">
						<span>268 Subscriber</span>
						<span class="pf-campaigns-date"></span>
					</p>
				</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			  </tr>
			  <tr>
				<td>
					<h4>Jabong Case Study - Weekly Digest</h4>
					<p class="pf-subscribe-count">
						<span>268 Subscriber</span>
						<span class="pf-campaigns-date"></span>
					</p>
				</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			  </tr>
			  <tr>
				<td>
					<h4>Why Do You Need To Add Web Push Nodifications To Your Instapage Landing Page? (resend to unopened)</h4>
					<p class="pf-subscribe-count">
						<span>198 Subscriber</span>
						<span class="pf-campaigns-date">Sent on Jul 15, 2018 at 5:15pm</span>
					</p>
				</td>
				<td>12.6%</td>
				<td>0.5%</td>
				<td>0.0%</td>
				<td>0.0%</td>
			  </tr>
			   <tr>
				<td>
					<h4>Why Do You Need To Add Web Push Nodifications To Your Instapage Landing Page?</h4>
					<p class="pf-subscribe-count">
						<span>253 Subscriber</span>
						<span class="pf-campaigns-date">Sent on Jul 13, 2018 at 5:15pm</span>
					</p>
				</td>
				<td>26.19%</td>
				<td>1.2%</td>
				<td>0.0%</td>
				<td>0.8%</td>
			  </tr>
			</tbody>
		  </table>
	</div>
		
	</div>
	

<?php
 
	
        }
    }