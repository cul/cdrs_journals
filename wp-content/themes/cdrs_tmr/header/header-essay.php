
<?php

// This file is part of the Carrington JAM Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2010 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>

 <!DOCTYPE html>
<!--[if lt IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie6 lte7 lte8 lte9"><![endif]-->
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js ie ie7 lte7 lte8 lte9"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie ie8 lte8 lte9"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie ie9 lte9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>

<meta http-equiv="X-UA-Compatible" content="chrome=1">

<meta charset="<?php bloginfo( 'charset' ); ?>" />
		
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
	
<link rel="shortcut icon" type="image/x-icon" href="/wp-content/uploads/2012/06/icon.ico">

<title>

<?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>


<link rel="stylesheet" type="text/css" media="screen"  href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/blueprint/screen.css" />

<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />

<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/print.css"/>

<?php

function my_scripts_method() {
   
      wp_register_script('pnumb', get_template_directory_uri() .'/js/jquery.numberedParagraphs.js');
   
   wp_register_script('tmr_js',
       get_template_directory_uri() . '/js/tmr.js',
       array('jquery',  'pnumb', 'jquery-ui-dialog', 'jquery-effects-slide', 'jquery-effects-blind'),
       
       '1.0' );
   
   wp_enqueue_script('tmr_js');
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

?>
	
	 
	
<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="container">

 <div class="span-18 prepend-3" id='super' >
 <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/lion.png" id="nav-lion-icon" style='display:none' width=40 >
<nav id="access" role="navigation">



		 
 
<?php	wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>	
 <?php get_search_form(); ?>
 
</nav><!-- #access -->
 </div>
</div>
 
<div class="container" id="main">
<div id="print-header">


 <img src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/lion.png" id="print-lion-icon"  >

<img id="print-cuwp" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/selected-essays-home.png" alt="Selected Essays from the Columbia University Undergraduate Writing Program">
<h1 class="masthead"> <span class='light'>The</span><br/>Morningside<br/><span class='bottom'>Review</span></h1>
 

</div>
 

<div id="header" class="span-16 prepend-6" role="banner">

	 
<h1 class="masthead"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span class='light'>The</span><br/>Morningside<br/><span class='bottom'>Review</span></a></h1>

</div>


 
 

<!--


<div class="cdrs-colophon">
<h6>Published in Partnership with</h6>

<div id="cdrs-id">

CDRS

</div>

Center For Digital Research &amp; Scholarship<br>
<span class="small">Columbia University Libraries/Information Services</span>
</div>

-->

 

 
 

<div class="span-14 prepend-6" id='essay-title'>
  <h1 class="page-title">
<?php the_title() ?>
</h1>

<h2 class="author-edition">

<?php

global $post;
$author_terms = wp_get_object_terms($post->ID, 'tmr_author');
if(!empty($author_terms)){
  if(!is_wp_error( $author_terms )){
  
    foreach($author_terms as $term){
    
    $auth_bio = get_tax_meta($term, 'author_bio');
	$auth_photo = get_tax_meta($term,'author_image',true);
   
   if($auth_bio){
    
    
    
    echo '<span class="author-credit"><a href="'.get_term_link($term->slug, 'tmr_author').'">'.formatName($term->name).'</a></span>'; 
   }
   
   else{
   
   echo '<span class="author-credit">'.formatName($term->name).'</span>';
   }
   
   }
   }}
 
  ?>
  
</h2>

		</div>
