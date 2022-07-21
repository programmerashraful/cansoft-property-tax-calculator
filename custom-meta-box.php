<?php

/*
==========================================================================================
							ADD A META BOX FOR SINGLE NEWS AND POST TYPE:POST
==========================================================================================
*/
function cansoft_meta_box(){
	add_meta_box('post_option', 'Options', 'city_meta_box_content', 'cansoft_city', 'normal'  );
}
add_action('add_meta_boxes', 'cansoft_meta_box');

//this function for meta box
function city_meta_box_content(){
		 global $post;
		$id = $post->ID;
		?>
		
		
		<p><label><span style="color:#d54e21;font-weight:bold;display:inline-block;width:200px">Property Tax rate </span>
		<input class="regular-text" type="text" name="tax_rate" placeholder="Property Tax rate" id="tax_rate" style="margin-top: -4px;" value="<?php echo get_post_meta($id, 'tax_rate', true); ?>"  /> 
		</label></p>
		
		<p><label><span style="color:#d54e21;font-weight:bold;display:inline-block;width:200px"> This is my primary residence </span>
		<input class="regular-text" type="checkbox" name="primary_residence" placeholder="primary_residence" id="primary_residence" style="margin-top: -4px;width:15px" value="Yes" <?php if(get_post_meta($id, 'primary_residence', true)=='Yes'){ echo 'checked';} ?> /> <span style="font-size:12px;font-style:italic"> (<?php echo get_post_meta($id, 'primary_residence', true); ?>)</span>
		</label></p>
		
		<p><label><span style="color:#d54e21;font-weight:bold;display:inline-block;width:200px">Property Tax rate (If Primary Recidance) </span>
		<input class="regular-text" type="text" name="tax_rate_primary" placeholder="Property Tax rate" id="tax_rate_primary" style="margin-top: -4px;" value="<?php echo get_post_meta($id, 'tax_rate_primary', true); ?>"  /> 
		</label></p>
		
		
		
		<?php
		
	}


	
function save_post_meta_box(){
		
        // Lead news 
        global $post;
    
        if(isset($_POST['primary_residence'])){
            update_post_meta($post->ID, 'primary_residence', $_POST['primary_residence']);
        }else{
            if($post){
                update_post_meta($post->ID, 'primary_residence', 'No');
            }
            
        }

        if(isset($_POST['tax_rate'])){
            update_post_meta($post->ID, 'tax_rate', $_POST['tax_rate']);
        }
        if(isset($_POST['tax_rate_primary'])){
            update_post_meta($post->ID, 'tax_rate_primary', $_POST['tax_rate_primary']);
        }
        
	}
	add_action('save_post', 'save_post_meta_box');

