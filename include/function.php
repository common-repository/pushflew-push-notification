<?php
/* ----------------------------------------------------------------------------
 * pushflew custom ajax pagination
 * ---------------------------------------------------------------------------- */

function pf_custom_pagination($pages = '', $range = 2, $paged = 1, $perpage = 10) {
    $showitems = ($range * 2) + 1;
    $pagination = '';

    $pages = ceil($pages / $perpage);

    if (1 != $pages) {
        $pagination.= "<div class='brfpagination'>";
        //if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
        $pagination.= "<a data-id='" . (1) . "' href='javascript: void(0)'>First</a>";
        // if ($paged > 1 && $showitems < $pages)
        $pagination.= "<a data-id='" . (1) . "' href='javascript: void(0)'>Previous</a>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                $pagination.= ($paged == $i) ? "<span class='current'>" . $i . "</span>" : "<a data-id='" . $i . "' href='javascript: void(0)' class='inactive' >" . $i . "</a>";
            }
        }

        //if ($paged < $pages && $showitems < $pages)
        $pagination.= "<a data-id='" . ($paged + 1) . "' href='javascript: void(0)'>Next</a>";
        // if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
        $pagination.= "<a data-id='" . ($paged) . "' href='javascript: void(0)'>Last</a>";
        $pagination.= "</div>\n";
    }

    return $pagination;
}

function pf_upgradenow_message() {
	$pushflewData = Pushflew::getPushflewData();
	if ($pushflewData['alreadyRegistredStatus']) {
		$url = menu_page_url('accountsetting', 0);	?>	
		<div class="pf-alert pf-alert-danger fade in">
			Please Login to Pushflew dashboard Click <a href="<?php echo $url;?>" /><strong>here</strong></a>
		</div>	
	<?php } else {?>
    <div class="pf-alert pf-alert-danger fade in">
        <a href="https://pushflew.com/pricing/" target="_blank" />To get access to additional premium features, <strong>Upgrade Now.</strong></a>
    </div>
    <?php
	}
}