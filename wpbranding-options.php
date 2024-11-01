<?php
$location = $options_page; // Form Action URI
?>
<div class="wrap">
<div id="icon-options-general" class="icon32 icon32-posts-post"><br></div>
<h2>WP Branding</h2>

<form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
<h2>Generic Settings</h2>
	<table class="form-table">

        <tr valign="top">
        	<th scope="row"><strong>Developer Name : </strong></th>
        	<td>
        		<input type="text" size="60" name="wpmbtb_developer" id="wpmbtb_developer" value="<?php $wpmbtb_developer = get_option('wpmbtb_developer'); if(!empty($wpmbtb_developer)) {echo $wpmbtb_developer;} ?>">
			</td>
        </tr>

        <tr valign="top">
        	<th scope="row"><strong>Developer Website : </strong></th>
        	<td>
        		<input type="text" size="60" name="wpmbtb_developer_website" id="wpmbtb_developer_website" value="<?php $wpmbtb_developer_website = get_option('wpmbtb_developer_website'); if(!empty($wpmbtb_developer_website)) {echo $wpmbtb_developer_website;} ?>">
			</td>
        </tr>

        <tr valign="top">
        	<th scope="row"><strong>Custom Version  : </strong></th>
        	<td>
        		<input type="text" name="wpmbtb_customversion" id="wpmbtb_customversion" value="<?php $wpmbtb_developer = get_option('wpmbtb_customversion'); if(!empty($wpmbtb_developer)) {echo $wpmbtb_developer;} ?>">
			</td>
        </tr>

        <tr valign="top">
        	<th scope="row"><strong>Upload Login Logo (274 x 65px)</strong></th>
        	<td>
	        	<input type="text"  name="wpmbtb_logo" value="<?php echo get_option('wpmbtb_logo');?>" size="80" />
				<input type="button" class="mobisoft-upload-button button" value="Upload Image" /><br />
				<span>Enter the image location or upload an image from your computer.</span>
				<br /><br /> <strong>Current Logo Image : </strong> <?php echo get_option('wpmbtb_logo');?><br />
				<blockquote><img src="<?php echo get_option('wpmbtb_logo');?>"/></blockquote>
			</td>
        </tr>

    </table>
    

					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="page_options" value="wpmbtb_developer,wpmbtb_developer_website,wpmbtb_customversion,wpmbtb_logo" />
					<p class="submit"><input type="submit" class="button button-primary" name="Submit" value="<?php _e('Save Changes') ?>" /></p>









</form>
</div>        	
<div class="clear"></div>



