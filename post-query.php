<?php 
$lazy_image=null;
function lazy_image(){
    global $lazy_image;
    $lazy_image = ot_get_option('lazy_image');
}



/*This fucnctionfor top slider */
function spotlight_news($count=2){
    
   $media='';
    $mt='mt-10';
    
	$newspress_args = array(
	'post_type'        => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    
    $newspress_args['meta_query'] = array(
            'relation' => 'AND',
            array(
                array(
                    'key'     => 'spotlight',
                    'value'   => 'Yes',
                    'compare' => '='
                )
            )
        );

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             if($counter>1){
                 $mt='mt-10';
             }
             
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
            
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                  if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             
             
             
              $list3.='
                 <div class="top_lead_box white_box hover_effect pb-3 border_bottom '.$mt.'">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box right_lead_height ">
                            <div class="hover_box_inner">
                                
                                <div class="hover_box_news">
                                    <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                             আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             
		 }
         
         
         $list=$list3;
	 }
 wp_reset_query();
 return $list;
}




/*This fucnctionfor top slider */
function home_top_lead($count=6){
    
   $media='';
    
	$newspress_args = array(
	'post_type'        => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    
    $newspress_args['meta_query'] = array(
            'relation' => 'AND',
            array(
                array(
                    'key'     => 'news_featured',
                    'value'   => 'Yes',
                    'compare' => '='
                )
            )
        );

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
    $mt='mt-10';
    $subtitle='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             if($counter>2){
                 $mt='mt-10';
             }
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 //sub title
                 if($is_subtitle = get_post_meta(get_the_ID(), 'subtitle', true)){
                     $subtitle = '<h3 class="shoulder"> '.$is_subtitle; '</h3>';
                 }else{
                     $subtitle = '';
                 }
                 
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }elseif($counter>1 and $counter<=6){
                 
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                  if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }
             
             if($counter==1){
                 $list1.='
                 <div class="top_lead_box white_box hover_effect border_bottom pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box  top_lead_height">
                            <div class="hover_box_inner">
                                <div class="category_and_date">
                                    <p>
                                        <span class="date" style="float:left">
                                            
                                             আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                                <div class="hover_box_news mt-2">
                                    '.$subtitle.'
                                    <h1 class="news_head_line" style="line-height: 44px;"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h1>
                                    <div class="short_description">
                                        <p>
                                           <a href="'.esc_url(get_permalink()).'">'.get_the_excerpt().' </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }elseif($counter>1 and $counter<=6){
                 $list2.='
                 <div class="list_news lead_sidebox_height '.$mt.'">
                       <h1><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                       <div class="category_and_date">
                            <p>
                                <span class="category_name">
                                    '.$cat_link.'
                                </span>
                                <span class="date">
                                    আপডেট  '.get_the_date('d M y | H:i ').'
                                </span>
                            </p>
                        </div>

                    </div>
                 ';
             }else{
                 $list3.='
                 <div class="top_lead_box white_box hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">
                                
                                <div class="hover_box_news">
                                    <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }
             
		 }
         
         
         $list='
                <div class="container custom_col">
                    <div class="row custom_row custom_row  custom_row">
                        <div class="col-md-9 custom_col">
                            <div class="row  custom_row custom_row  custom_row">
                                <div class="col-md-8 custom_col">
                                    '.$list1.'
                                </div>
                                <div class="col-md-4 custom_col">
                                    '.$list2.'

                                </div>
                            </div>

                        </div>
                        <div class="col-md-3 custom_col">

                            '.spotlight_news().'

                        </div>
                    </div>
                </div>
         ';
	 }
 wp_reset_query();
 return $list;
}









/*This fucnctionfor top slider */
function home_second_lead($count=8){
    
   $media='';
    
	$newspress_args = array(
	'post_type'        => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    
    $newspress_args['meta_query'] = array(
            'relation' => 'AND',
            array(
                array(
                    'key'     => 'second_lead',
                    'value'   => 'Yes',
                    'compare' => '='
                )
            )
        );

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
                $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                  if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             
                $list1.='
                <div class="col-md-6 custom_col">
                        <div class="top_lead_box  white_box hover_effect pb-3 border_bottom mt-10">
                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box">
                                <div class="hover_box_inner">

                                    <div class="hover_box_news">
                                        <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h1>
                                    </div>
                                    <div class="category_and_date">
                                        <p>
                                            <span class="category_name">
                                                '.$cat_link.'
                                            </span>
                                            <span class="date">
                                                আপডেট '.get_the_date('d M y | H:i ').'
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             
             
             
		 }
         
         
         $list='
                <div class="row  custom_row">
                    '.$list1.'
                </div>
         ';
	 }
 wp_reset_query();
 return $list;
}







/*This fucnctionfor top slider */
function category_news_1($category, $count=8){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }elseif($counter>1 and $counter<=5){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                  if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }
             
             if($counter==1){
                 $list1.='
                    
                    <div class="top_lead_box white_box hover_effect pb-3 border_bottom  pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box lead_hover_box_min_height">
                            <div class="hover_box_inner">
                               <div class="hover_box_news">
                                    <h1 class="news_head_line head_3_line_height"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h1>

                                </div>

                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                 ';
             }elseif($counter>1 and $counter<=5){
                 $list2.='
                    <div class="list_news style-2 mt-10">
                        <div class="left_media">
                            '.$media.'
                        </div>
                        <div class="mdeia_right">
                            <h1><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>
                                    <span class="category_name">
                                        '.$cat_link.'
                                    </span>
                                    <span class="date">
                                        আপডেট  '.get_the_date('d M y | H:i ').'
                                    </span>
                                </p>
                            </div>

                        </div>
                    </div>
                 ';
             }else{
                 $list3.='
                    <div class="col-md-4 custom_col">
                        <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box ">
                                <div class="hover_box_inner">

                                    <div class="hover_box_news">
                                        <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                    </div>
                                    <div class="category_and_date">
                                        <p>
                                            <span class="category_name">
                                                '.$cat_link.'
                                            </span>
                                            <span class="date">
                                                আপডেট '.get_the_date('d M y | H:i ').'
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                 ';
             }
             
		 }
         
         
         $list='
                <div class="row  custom_row">
                   <div class="col-md-6 custom_col">
                       '.$list1.'
                   </div>
                   <div class="col-md-6 custom_col">

                        '.$list2.'


                   </div>
               </div>

               <div class="row  custom_row">

                  '.$list3.'

               </div>
         ';
	 }
 wp_reset_query();
 return $list;
}






/*This fucnctionfor top slider */
function category_news_2($category, $count=8){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
    $subtitle='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             
             
             if($counter==1){
                 //sub title
                 if($is_subtitle = get_post_meta(get_the_ID(), 'subtitle', true)){
                     $subtitle = '<h3 class="shoulder"> '.$is_subtitle; '</h3>';
                 }else{
                     $subtitle = '';
                 }
                 
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }elseif($counter>1 and $counter<=3){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

             }else{
                 
             }
             
             if($counter==1){
                 $list1.='
                    
                    <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box lead_box_3_height">
                            <div class="hover_box_inner">
                                <div class="category_and_date">
                                    <p>
                                         
                                        <span class="date" style="float:left">
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                                <div class="hover_box_news mt-2">
                                    '.$subtitle.'
                                    <h1 class="news_head_line no-height small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                    <div class="short_description">
                                        <p>
                                           <a href="'.esc_url(get_permalink()).'"> '.get_the_excerpt().' </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }elseif($counter>1 and $counter<=3){
                 $list2.='
                    
                    <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line more_small_head_3line_height small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                        '.$cat_link.'
                                        </span>
                                        <span class="date">
                                             '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }else{
                 $list3.='
                    
                    <div class="list_news style-2 mt-10">
                       <div class="mdeia_right ">
                           <h1 class="title_heigth_3"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>
                                    <span class="category_name">
                                        '.$cat_link.'
                                    </span>
                                    <span class="date">
                                        আপডেট '.get_the_date('d M y | H:i ').'
                                    </span>
                                </p>
                            </div>
                       </div>

                    </div>
                 ';
             }
             
		 }
         
         
         $list='
                <div class="row  custom_row">
                    <div class="col-md-5  custom_col">
                        '.$list1.'
                    </div>
                    <div class="col-md-7  custom_col">
                        <div class="row  custom_row">
                            <div class="col-md-6  custom_col">
                                '.$list2.'
                            </div>

                            <div class="col-md-6  custom_col ">
                                '.$list3.'
                            </div>
                        </div>

                    </div>

                </div>
         ';
	 }
 wp_reset_query();
 return $list;
}







/*This fucnctionfor top slider */
function category_news_3($category, $count=5){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }
             
             if($counter==1){
                 $list1.='
                    
                    
                    
                    <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line small title_height_4"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }else{
                 $list2.='
                    
                     <div class="list_news style-2 mt-10">
                       <div class="mdeia_right ">
                           <h1><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>
                                    <span class="category_name">
                                        '.$cat_link.'
                                    </span>
                                    <span class="date">
                                        আপডেট '.get_the_date('d M y | H:i ').'
                                    </span>
                                </p>
                            </div>
                       </div>

                    </div>
                 ';
             }
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row mt-10">
                       <div class="col-sm-12  custom_col">
                           <h1 class="category_heading">
                               <span class="cat_head_left"><a href="'.get_category_link($category).'" class=""> '.get_cat_name($category).' </a></span> 
                               <span class="cat_head_right"><a href="'.get_category_link($category).'" class=""> আরও  <i class="fal fa-caret-right"></i> </a></span>
                           </h1>
                       </div>
                   </div>
                   
                   '.$list1.'
                   '.$list2.'
         ';
	 }
 wp_reset_query();
 return $list;
}











/*This fucnctionfor top slider */
function category_news_4($category, $count=9){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
    
    $subtitle='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

             }
             
             if($counter==1){
                 //sub title
                 if($is_subtitle = get_post_meta(get_the_ID(), 'subtitle', true)){
                     $subtitle = '<h3 class="shoulder"> '.$is_subtitle; '</h3>';
                 }else{
                     $subtitle = '';
                 }
                 
                 $list1.='
                    
                    <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box lead_box_4_height">
                                <div class="hover_box_inner">
                                    <div class="category_and_date">
                                        <p>
                                            
                                            <span class="date" style="float:left">
                                                আপডেট '.get_the_date('d M y | H:i ').'
                                            </span>
                                        </p>
                                    </div>
                                    <div class="hover_box_news mt-2">
                                        '.$subtitle.'
                                        <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                        <div class="short_description">
                                            <p>
                                               <a href="'.esc_url(get_permalink()).'"> '.get_the_excerpt().' </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 ';
             }elseif($counter>1 and $counter<=5){
                 $list2.='
                    
                    
                    <div class="col-md-6 custom_col">
                            <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                                <div class="image_box">
                                    '.$media.'
                                </div>
                                <div class="hover_box ">
                                    <div class="hover_box_inner">

                                        <div class="hover_box_news">
                                            <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                        </div>
                                        <div class="category_and_date">
                                            <p>
                                                <span class="category_name">
                                                '.$cat_link.'
                                                </span>
                                                <span class="date">
                                                    আপডেট '.get_the_date('d M y ').'
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                 ';
             }else{
                 $list3.='
                    
                    <div class="col-md-3  custom_col">
                            <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                                <div class="image_box">
                                    '.$media.'
                                </div>
                                <div class="hover_box ">
                                    <div class="hover_box_inner">

                                        <div class="hover_box_news">
                                            <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                        </div>
                                        <div class="category_and_date">
                                            <p>
                                                <span class="category_name">
                                                    '.$cat_link.'
                                                </span>
                                                <span class="date">
                                                     আপডেট '.get_the_date('d M y ').'
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                 ';
             }
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row">
                       <div class="col-md-5  custom_col">
                           '.$list1.'
                       </div>
                       <div class="col-md-7  custom_col">
                           <div class="row  custom_row">
                               '.$list2.'
                           </div>
                       </div>
                   </div>
                   <div class="row  custom_row">
                      '.$list3.'
                   </div>
         ';
	 }
 wp_reset_query();
 return $list;
}








/*This fucnctionfor top slider */
function category_news_5($category, $count=5){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

             }
             
             if($counter==1){
                 $list1.='
                    
                    <div class="editorial_news p-2 mt-10">
                      '.$media.'
                      <div class="news_heading">
                          <p> <a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a> </p>
                      </div>
                      <div class="news_footer">
                          <p> <i class="fal fa-edit"></i>  '.get_the_author( ).' </p>
                      </div>
                  </div>
                 ';
             }elseif($counter>1 and $counter<=3){
                 $list2.='
                    
                    
                    <div class="list_news style-2 list_editorial ">
                        <div class="left_media">
                            '.$media.'
                        </div>
                        <div class="mdeia_right">
                            <h1 class="no-bold"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>

                                    <span class="date">
                                       <i class="fal fa-edit"></i>  '.get_the_author( ).'
                                    </span>
                                </p>
                            </div>

                        </div>
                    </div>
                 ';
             }else{
                 $list3.='
                    <div class="col-sm-6  custom_col col_border_right">
                           <div class="list_news style-2 list_editorial no-border">
                                <div class="left_media">
                                   '.$media.'
                                </div>
                                <div class="mdeia_right">
                                    <h1 class="no-bold"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                   <div class="category_and_date">
                                        <p>

                                            <span class="date">
                                               <i class="fal fa-edit"></i>  '.get_the_author( ).'
                                            </span>
                                        </p>
                                    </div>

                                </div>
                            </div>
                       </div>
                 ';
             }
             
		 }
         
         
         $list='
                
        <div class="row  custom_row">
              <div class="col-sm-12  custom_col">
                  <div class="white_box mt-10 p-0">
                      <div class="row  custom_row">
                          <div class="col-sm-5  custom_col col_border_right">

                             '.$list1.'

                           </div>
                           <div class="col-sm-7">
                               '.$list2.'
                           </div>

                      </div>
                  </div>
              </div>

           </div>
           <div class="row  custom_row">
               <div class="col-sm-12  custom_col">
                   <div class="white_box  p-0 col_border_top">
                       <div class="row  custom_row">
                           '.$list3.'
                       </div>
                   </div>
               </div>
           </div>
         ';
	 }
 wp_reset_query();
 return $list;
}












/*This fucnctionfor top slider */
function category_news_6($category, $count=4){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }
             
             
             $list1.='

                    
                    <div class="list_news style-2 list_editorial">
                        <div class="left_media">
                            '.$media.'
                        </div>
                        <div class="mdeia_right">
                            <h1 class="no-bold"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>
                                    
                                    <span class="date">
                                       <i class="fal fa-edit"></i>  '.get_the_author( ).'
                                    </span>
                                </p>
                            </div>

                        </div>
                    </div>
             ';
             
		 }
         
         
         $list='
                
                   
                   <div class="row  custom_row mt-10 mb-3">
                       <div class="col-sm-12  custom_col">
                           <h1 class="category_heading">
                               <span class="cat_head_left"><a href="'.get_category_link($category).'" class=""> '.get_cat_name($category).' </a></span> 
                               <span class="cat_head_right"><a href="'.get_category_link($category).'" class=""> আরও  <i class="fal fa-caret-right"></i> </a></span>
                           </h1>
                       </div>
                   </div>

                   '.$list1.'
                   
         ';
	 }
 wp_reset_query();
 return $list;
}




/*This fucnctionfor top slider */
function category_news_7($category, $count=5){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
    $subtitle='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }

             }
             
             if($counter==1){
                 //sub title
                 if($is_subtitle = get_post_meta(get_the_ID(), 'subtitle', true)){
                     $subtitle = '<h3 class="shoulder"> '.$is_subtitle; '</h3>';
                 }else{
                     $subtitle = '';
                 }
                 $list1.='
                    
                  
                  <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box lead_box_4_height">
                            <div class="hover_box_inner">
                                <div class="category_and_date">
                                    <p>
                                        <span class="date" style="float:left">
                                             আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                                <div class="hover_box_news mt-2">
                                '.$subtitle.'
                                    <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a> </h1>
                                    <div class="short_description">
                                        <p>
                                           <a href="'.esc_url(get_permalink()).'"> '.get_the_excerpt().' </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }else{
                 $list2.='
                    <div class="col-md-6  custom_col">
                                    
                        <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box ">
                                <div class="hover_box_inner">

                                    <div class="hover_box_news">
                                        <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                    </div>
                                    <div class="category_and_date">
                                        <p>
                                            <span class="category_name">
                                                '.$cat_link.'
                                            </span>
                                            <span class="date">
                                                 আপডেট '.get_the_date('d M y | H:i ').'
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }
             
		 }
         
         
         $list='
            <div class="row  custom_row">
                <div class="col-md-5  custom_col">
                    '.$list1.'
                </div>
                <div class="col-md-7  custom_col">
                    <div class="row  custom_row">

                        '.$list2.'

                    </div>
                </div>
            </div>
         ';
	 }
 wp_reset_query();
 return $list;
}



/*This fucnctionfor top slider */
function category_news_8($category, $count=9){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
    $subtitle='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter>=1 and $counter<=2){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }elseif($counter>2 and $counter<=3){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }

             }
             
             if($counter>=1 and $counter<=2){
                 $list1.='
                    
                  
                    <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                        <div class="image_box">
                           '.$media.'
                        </div>
                        <div class="hover_box lead_box_6_height">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                             আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }elseif($counter>2 and $counter<=3){
                 //sub title
                 if($is_subtitle = get_post_meta(get_the_ID(), 'subtitle', true)){
                     $subtitle = '<h3 class="shoulder"> '.$is_subtitle; '</h3>';
                 }else{
                     $subtitle = '';
                 }
                 $list2.='
                    <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box lead_box_7_height">
                            <div class="hover_box_inner">
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                                '.$cat_link.'
                                            </span>
                                            <span class="date">
                                                 আপডেট '.get_the_date('d M y | H:i ').'
                                            </span>
                                    </p>
                                </div>
                                <div class="hover_box_news mt-2">
                                    '.$subtitle.'
                                    <h1 class="news_head_line"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                    <div class="short_description">
                                        <p>
                                           <a href="'.esc_url(get_permalink()).'"> '.get_the_excerpt().' </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }else{
                 $list3.='
                 <div class="list_news style-2 mt-10">
                      <div class="mdeia_right">
                           <h1><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>
                                    <span class="category_name">
                                        '.$cat_link.'
                                    </span>
                                    <span class="date">
                                         আপডেট '.get_the_date('d M y | H:i ').'
                                    </span>
                                </p>
                            </div>
                          </div>

                    </div>
                 ';
             }
             
		 }
         
         
         $list='
            <div class="row  custom_row">
                <div class="col-md-3  custom_col">
                    '.$list1.'
                   
                </div>
                <div class="col-md-6  custom_col">
                    '.$list2.'
                </div>
                <div class="col-md-3  custom_col">
                 
                  '.$list3.'
                  
                    
                </div>
            </div>
         ';
	 }
 wp_reset_query();
 return $list;
}




/*This fucnctionfor top slider */
function category_news_9($category, $count=6){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter>=1 and $counter<=2){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }

                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }

             }
             
             if($counter>=1 and $counter<=2){
                 $list1.='
                    
                    
                    
                    <div class="col-sm-6  custom_col">
                            <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                                <div class="image_box">
                                    '.$media.'
                                </div>
                                <div class="hover_box ">
                                    <div class="hover_box_inner">

                                        <div class="hover_box_news">
                                            <h1 class="news_head_line small "><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                        </div>
                                        <div class="category_and_date">
                                            <p>
                                                <span class="category_name">
                                                    '.$cat_link.'
                                                </span>
                                                <span class="date">
                                                     আপডেট '.get_the_date('d M y | H:i ').'
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                 ';
             }else{
                 $list2.='
                 
                    
                    <div class="col-sm-3  custom_col">
                            <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-10">
                                <div class="image_box">
                                    '.$media.'
                                </div>
                                <div class="hover_box ">
                                    <div class="hover_box_inner">

                                        <div class="hover_box_news">
                                            <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                        </div>
                                        <div class="category_and_date">
                                            <p>
                                                <span class="category_name">
                                                    '.$cat_link.'
                                                </span>
                                                <span class="date">
                                                     '.get_the_date('d M y | H:i ').'
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                 ';
             }
             
		 }
         
         
         $list='
            <div class="row  custom_row">
               '.$list1.'
           </div>
           <div class="row  custom_row">
              '.$list2.'
           </div>
         ';
	 }
 wp_reset_query();
 return $list;
}





/*This fucnctionfor top slider */
function category_news_10($category, $count=5){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }
             }
             
             if($counter==1){
                 $list1.='
                    
                    
                    
                    <div class="top_lead_box white_box border_bottom hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line small title_height_5"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                 ';
             }else{
                 $list2.='
                    
                    <div class="list_news style-2 list_editorial">
                        <div class="left_media">
                            '.$media.'
                        </div>
                        <div class="mdeia_right">
                            <h1><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                           <div class="category_and_date">
                                <p>
                                     <span class="category_name">
                                        '.$cat_link.'
                                    </span>
                                    <span class="date">
                                        আপডেট '.get_the_date('d M y').'
                                    </span>
                                </p>
                            </div>

                        </div>
                    </div>
                    
                 ';
             }
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row mt-10">
                       <div class="col-sm-12  custom_col">
                           <h1 class="category_heading">
                               <span class="cat_head_left"><a href="'.get_category_link($category).'" class=""> '.get_cat_name($category).' </a></span> 
                               <span class="cat_head_right"><a href="'.get_category_link($category).'" class=""> আরও  <i class="fal fa-caret-right"></i> </a></span>
                           </h1>
                       </div>
                   </div>
                   
                   '.$list1.'
                   '.$list2.'
         ';
	 }
 wp_reset_query();
 return $list;
}








/*This fucnctionfor top slider */
function category_news_11($category, $count=4){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             if($counter==1){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }


                 if(get_post_format()=='video'){
                     $content = do_shortcode(apply_filters('the_content', get_the_content()));
                    $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                     if($embed){
                       $media='
                            <div class="embed-responsive embed-responsive-16by9">
                                '.$embed[0].'
                            </div>
                        ';  
                     }

                 }
             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
                 if(has_post_thumbnail()){
                     $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
                 }
             }
             
             if($counter==1){
                 $list1.='
                    <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-10">
                        <div class="image_box">
                           '.$media.'
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    
                 ';
             }else{
                 $list2.='
                 <div class="list_news style-2 mt-10">
                    <div class="left_media">
                        '.$media.'
                    </div>
                    <div class="mdeia_right">
                        <h1><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                       <div class="category_and_date">
                            <p>
                                 <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                            </p>
                        </div>

                    </div>
                </div>
                    
                    
                 ';
             }
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row">
                           <div class="col-sm-6  custom_col">
                                '.$list1.'   
                           </div>
                           <div class="col-sm-6  custom_col">
                               '.$list2.'
                           </div>
                       </div>
         ';
	 }
 wp_reset_query();
 return $list;
}





/*This fucnctionfor top slider */
function category_news_12($category, $count=7){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
             if(has_post_thumbnail()){
                 $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
             }


             if(get_post_format()=='video'){
                 $content = do_shortcode(apply_filters('the_content', get_the_content()));
                $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                 if($embed){
                   $media='
                        <div class="embed-responsive embed-responsive-16by9">
                            '.$embed[0].'
                        </div>
                    ';  
                 }

             }
             
             if($counter<=3){
                 $list1.='
                 
                 <div class="col-sm-4  custom_col">
                                    <div class="top_lead_box border_bottom white_box  hover_effect pb-3 mt-10">
                                        <div class="image_box">
                                            '.$media.'
                                        </div>
                                        <div class="hover_box ">
                                            <div class="hover_box_inner">

                                                <div class="hover_box_news">
                                                    <h1 class="news_head_line small"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                                </div>
                                                <div class="category_and_date">
                                                    <p>
                                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            আপডেট '.get_the_date('d M y | H:i ').'
                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                               </div>
                 
                   
                    
                 ';
             }else{
                 $list2.='
                 
                
                 <div class="col-sm-3  custom_col">
                    <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-10">
                        <div class="image_box">
                            '.$media.'
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                                <div class="category_and_date">
                                    <p>
                                        <span class="category_name">
                                            '.$cat_link.'
                                        </span>
                                        <span class="date">
                                            '.get_the_date('d M y').'
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>    
               </div>
                    
                    
                 ';
             }
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row">
                       '.$list1.$list2.'
                   </div>
         ';
	 }
 wp_reset_query();
 return $list;
}



/*This fucnctionfor top slider */
function category_news_13($category, $count=4){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
             if(has_post_thumbnail()){
                 $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
             }


             if(get_post_format()=='video'){
                 $content = do_shortcode(apply_filters('the_content', get_the_content()));
                $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                 if($embed){
                   $media='
                        <div class="embed-responsive embed-responsive-16by9">
                            '.$embed[0].'
                        </div>
                    ';  
                 }

             }
             $list1.='
                 
                 <div class="col-sm-3  custom_col">
                        <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-10">
                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box">
                                <div class="hover_box_inner">

                                    <div class="hover_box_news">
                                        <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                    </div>
                                    <div class="category_and_date">
                                        <p>
                                            <span class="category_name">
                                '.$cat_link.'
                            </span>
                            <span class="date">
                                আপডেট '.get_the_date('d M y').'
                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                   </div>';
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row">
                       '.$list1.$list2.'
                   </div>
         ';
	 }
 wp_reset_query();
 return $list;
}





/*This fucnctionfor top slider */
function category_news_14($category, $count=4){
    
   $media='';
    
	$newspress_args = array(
	'cat'             => $category,
	'post_type'       => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
             if(has_post_thumbnail()){
                 $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
             }


             if(get_post_format()=='video'){
                 $content = do_shortcode(apply_filters('the_content', get_the_content()));
                $embed = get_media_embedded_in_content($content, array('video', 'iframe'));
                 if($embed){
                   $media='
                        <div class="embed-responsive embed-responsive-16by9">
                            '.$embed[0].'
                        </div>
                    ';  
                 }

             }
             $list1.='
                 
                 <div class="col-sm-3  custom_col">
                        <div class="top_lead_box white_box border_bottom  hover_effect pb-3 mt-1">
                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box ">
                                <div class="hover_box_inner">

                                    <div class="hover_box_news">
                                        <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                    </div>
                                    <div class="category_and_date">
                                        <p>
                                            <span class="category_name">
                                '.$cat_link.'
                            </span>
                            <span class="date">
                                আপডেট '.get_the_date('d M y | H:i ').'
                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>    
                   </div>';
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row">
                       '.$list1.$list2.'
                   </div>
         ';
	 }
 wp_reset_query();
 return $list;
}










/*More Posts of the cateogr*/
function related_posts($category_in=null,$id_not_in=null , $count=15){
	$newspress_args = array(
	'type'            => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'category__in'    => $category_in,
    'post__not_in'    => $id_not_in,
	'posts_per_page'  => $count,
	'suppress_filters' => true );
	$list='';
	$newspress_query = new WP_Query($newspress_args);
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
			 $list.='
             <div class="list_news">
                   <a href="'.esc_url(get_permalink()).'">
                       <img src="'.$thumbnail[0].'"  class="img-fluid">
                       <p> '.get_the_title().' </p>
                   </a>
              </div>
             ';
		 }
	 }
 wp_reset_query();
 return $list;
}

/*More Posts of the cateogr*/
function related_posts_bottom($category_in=null, $count=4){
    $return = array();
    $ids = array();
	$newspress_args = array(
	'type'            => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'category__in'  => $category_in,
	'posts_per_page'  => $count,
	'suppress_filters' => true );
	$list='';
	$newspress_query = new WP_Query($newspress_args);
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $ids[] = get_the_ID();
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'meduim');
			 $list.='
             <div class="col-sm-6">
                 <div class="list_news single_page_bottom_list">
                       <a href="'.esc_url(get_permalink()).'">
                           <img src="'.$thumbnail[0].'"  class="img-fluid">
                           <p> '.get_the_title().' </p>
                       </a>
                  </div>
              </div>
             ';
		 }
	 }
 wp_reset_query();
    $return['ids'] = $ids;
    $return['data'] = $list;
 return $return;
}

/*More Posts of the cateogr*/
function latest_posts($count=15){
	$newspress_args = array(
	'type'            => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
	$list='';
	$newspress_query = new WP_Query($newspress_args);
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
			 $list.='
             <div class="list_news">
                   <a href="'.esc_url(get_permalink()).'">
                       <img src="'.$thumbnail[0].'"  class="img-fluid">
                       <p> '.get_the_title().' </p>
                   </a>
              </div>
             ';
		 }
	 }
 wp_reset_query();
 return $list;
}

/*More Posts of the cateogr*/
function populer_posts( $count=15){
	$newspress_args = array(
	'type'            => 'post',
	'meta_key'        => 'wpb_post_views_count',
    'orderby'         => 'meta_value_num',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
	$list='';
	$newspress_query = new WP_Query($newspress_args);
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
			 $list.='
             <div class="list_news">
                   <a href="'.esc_url(get_permalink()).'">
                       <img src="'.$thumbnail[0].'" class="img-fluid">
                       <p> '.get_the_title().' </p>
                   </a>
              </div>
             ';
		 }
	 }
 wp_reset_query();
 return $list;
}


/*More Posts of the cateogr*/
function populer_list( $count=5){
	$newspress_args = array(
	'type'            => 'post',
	'meta_key'        => 'wpb_post_views_count',
    'orderby'         => 'meta_value_num',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
	$list='';
	$newspress_query = new WP_Query($newspress_args);
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
			 $list.='
             
                <li>
                    <div class="media">
                        <div class="media-left" style="position: relative;">
                           <a href="'.esc_url(get_permalink()).'">
                              <div class="positionRelative">
                                 <img class="media-object" src="'.$thumbnail[0].'" title="" style="">
                              </div>
                           </a>
                        </div>

                        <div class="media-body">
                           <h3 style="margin: 0px" class="lineHeight22"><a class="app-font-weight-normal lineHeight22 fontWeightNormal" href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h3>
                        </div>

                    </div>
                </li>
                                   
             ';
		 }
	 }
 wp_reset_query();
 return $list;
}



/*More Posts of the cateogr*/
function latest_list($count=6){
	$newspress_args = array(
	'type'            => 'post',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
	$list='';
	$newspress_query = new WP_Query($newspress_args);
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_small');
			 $list.='
             
                <li>
                    <div class="media">
                        <div class="media-body">
                           <h3 style="margin: 0px" class="lineHeight22"><a class="app-font-weight-normal lineHeight22 fontWeightNormal" href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h3>
                        </div>
                    </div>
                </li>
             ';
		 }
	 }
 wp_reset_query();
 return $list;
}










/*This fucnctionfor top slider */
function home_video_gallery( $count=7){
    
   $media='';
    
	$newspress_args = array(
	'post_type'       => 'video_gallery',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
    $list4='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             if($counter==2){
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_big');
                 if(has_post_thumbnail()){
                     $media='<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> ';
                 }

             }else{
                 $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
                 if(has_post_thumbnail()){
                     $media='<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> ';
                 }
             }
             
             if($counter==1){
                 $list1.='
                    
                    <div class="video_small">
                          <a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" >
                              <span class="video_play_button"><i class="fal fa-caret-right"></i></span>

                               '.$media.'
                            <h1 class=""> '.get_the_title().' </h1>
                            <div class="video_short_description">
                                <p>'.get_the_excerpt().'</p>
                            </div>
                          </a>
                       </div>
                    
                    
                 ';
             }elseif($counter==2){
                 $list2.='
                
                <div class="video_big">
                                  
                            <span class="video_play_button"><i class="fal fa-caret-right"></i></span>

                           <a  href="'.esc_url(get_permalink()).'" >
                               '.$media.'
                           </a>
                       </div>
                    
                    
                 ';
             }elseif($counter==3){
                 $list3.='
                 
                    <div class="video_small">
                          <a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" >
                              <span class="video_play_button"><i class="fal fa-caret-right"></i></span>

                               '.$media.'
                            <h1 class=""> '.get_the_title().' </h1>
                            <div class="video_short_description">
                                <p>'.get_the_excerpt().'</p>
                            </div>
                          </a>
                       </div>
                 ';
             }else{
                 $list4.='
                 <div class="col-sm-3  custom_col">
                    <div class="top_lead_box gallery  hover_effect pb-3 mt-10">
                        <span class="video_play_button"><i class="fal fa-caret-right"></i></span>

                        <div class="image_box">
                            <a href="'.esc_url(get_permalink()).'">'.$media.'</a>
                        </div>
                        <div class="hover_box ">
                            <div class="hover_box_inner">

                                <div class="hover_box_news">
                                    <h1 class="news_head_line small-more"><a href="'.esc_url(get_permalink()).'"> '.get_the_title().' </a></h1>
                                </div>
                               
                            </div>
                        </div>
                    </div>
               </div>
                 ';
             }
             
		 }
         
         
         $list='
                
                   <div class="row  custom_row">
               <div class="col-sm-12  custom_col">
                   <div class="video_bg">
                       <div class="row  custom_row">
                           <div class="col-md-3  custom_col">
                               '.$list1.'
                           </div>
                           <div class="col-md-6  custom_col">
                               '.$list2.'
                           </div>
                           <div class="col-md-3  custom_col">
                               '.$list3.'
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           
           <div class="row  custom_row">
               '.$list4.'
           </div>
                       </div>
         ';
	 }
 wp_reset_query();
 return $list;
}





/*This fucnctionfor top slider */
function video_category_1($taxonomy, $count=8){
    
   $media='';
    
	$newspress_args = array(
	'post_type'       => 'video_gallery',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true,
    'tax_query' => array(
        array(
        'taxonomy' => 'video_category',
        'field' => 'term_id',
        'terms' => $taxonomy
         )
      )
    );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
             if(has_post_thumbnail()){
                 $media='<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> ';
             }


   
             $list1.='
             
             <div class="col-sm-3  custom_col mt-10">
                    <div class="video_gallery_single">
                         
                          <a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'">
                              <span class="video_play_button"><i class="fal fa-caret-right"></i></span>

                               '.$media.'
                               
                               <div class="box_footer p-2">
                                    <h1 class="">  '.get_the_title().' </h1>
                                    <p class="date"><i class="fa fa-clock-o" style="font-size: 12px;vertical-align: unset;"></i> আপডেট  '.get_the_date('d M y | H:i ').'</p>
                               </div>
                            
                          </a>
                       </div>
                </div>
                
                 ';
             
		 }
         
         
         $list=$list1;
	 }
 wp_reset_query();
 return $list;
}






/*This fucnctionfor top slider */
function photo_gallery($count=15){
    
   $media='';
    
	$newspress_args = array(
	'post_type'       => 'gallery',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_terms(get_the_ID(), 'photo_category');//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_term_link($cd->term_id).'" class="small_category_name"> '.$cd->name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
             if(has_post_thumbnail()){
                 $media='<a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" ><img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> </a>';
             }


             $list1.='
             
             <div class="item">
                        <div class="top_lead_box gallery  hover_effect pb-3 mt-10">

                            <span class="gallery_icon"><i class="fa fa-image"></i></span>

                            <div class="image_box">
                                '.$media.'
                            </div>
                            <div class="hover_box ">
                                <div class="hover_box_inner">

                                    <div class="hover_box_news">
                                        <h1 class="news_head_line small-more"><a  href="'.esc_url(get_permalink()).'" title="'.get_the_title().'" >'.get_the_title().'</a></h1>
                                    </div>
                                    <div class="category_and_date">
                                        <p>
                                            <span class="category_name">
                                                '.$cat_link.'
                                            </span>
                                            <span class="date">
                                                আপডেট '.get_the_date('d M y | H:i ').'
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                 
                 ';
             
		 }
         
         
         $list='
                
             '.$list1.'
         ';
	 }
 wp_reset_query();
 return $list;
}





/*This fucnctionfor top slider */
function photo_category_1($taxonomy, $count=8){
    
   $media='';
    
	$newspress_args = array(
	'post_type'       => 'gallery',
	'orderby'         => 'post_date',
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'posts_per_page'  => $count,
	'suppress_filters' => true,
    'tax_query' => array(
        array(
        'taxonomy' => 'photo_category',
        'field' => 'term_id',
        'terms' => $taxonomy
         )
      )
    );
    

 
	
	$newspress_query = new WP_Query($newspress_args);
    $counter=0;
    $active='';
    $list='';
    $list1='';
    $list2='';
    $list3='';
	 if ($newspress_query->have_posts()) { 
		 while ( $newspress_query->have_posts()) {
			 $newspress_query->the_post();
             $counter++;
             $media = null;
             $cat_link = null;
             
             $category_detail = get_the_category(get_the_ID());//$post->ID
             
                foreach($category_detail as $cd){
                    $cat_link = '<a href="'.get_category_link($cd->term_id).'" class="small_category_name"> '.$cd->cat_name.'  </a>';
                }
             
             $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'home_medium');
             if(has_post_thumbnail()){
                 $media='<img src="'.$thumbnail[0].'" alt="'.get_the_title().'" class="d-block w-100" style="width:!00%" /> ';
             }


   
             $list1.='
             
             <div class="col-sm-3  custom_col mt-10">
                    <div class="video_gallery_single">
                         
                          <a href="'.esc_url(get_permalink()).'" title="'.get_the_title().'">
                              <span class="gallery_icon no-radius"><i class="fa fa-image"></i></span>

                               '.$media.'
                               
                               <div class="box_footer p-2">
                                    <h1 class="">  '.get_the_title().' </h1>
                                    <p class="date"><i class="fa fa-clock-o" style="font-size: 12px;vertical-align: unset;"></i> আপডেট '.get_the_date('d M y | H:i ').'</p>
                               </div>
                            
                          </a>
                       </div>
                </div>
                
                 ';
             
		 }
         
         
         $list=$list1;
	 }
 wp_reset_query();
 return $list;
}




 