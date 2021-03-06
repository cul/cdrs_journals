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
		
				
		
		
		<link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic,700' rel='stylesheet' type='text/css'>
		
		<link rel="shortcut icon" type="image/x-icon" href="//morningsidereview-dev.cdrs.columbia.edu/wp-content/uploads/2012/06/icon.ico">

		
		<title>

	 <?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ); ?></title>

 
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	 
	

		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/blueprint/screen.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />
		<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/blueprint/print.css"/>
<?php

function my_scripts_method() {
   
   wp_register_script('tmr_js',
       get_template_directory_uri() . '/js/tmr.js',
       array('jquery'),
       '1.0' );
   
   wp_enqueue_script('tmr_js');
}
//add_action('wp_enqueue_scripts', 'my_scripts_method');
?>
	
	 
	
<link rel="profile" href="http://gmpg.org/xfn/11" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

 

<div class="container">

<div id='header' role="banner" class="span-15 prepend-1 clearfix">		

<h1 class="masthead"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span class='light'>The</span><br/>Morningside<br/>

<span class='bottom'>Review</span></a></h1>

<div id="cu-writing"><a href="http://www.college.columbia.edu/core/uwp"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/selected-essays-home.png"></a></div>

</div>
 
<div class="span-8 last">
 


<ul class="home-nav">

<li>
<a href="<?php home_url('/')  ?>?page_id=123">
Current</a>
<p>Read the Current Issue of TMR</p>
</li>

<li>
<a href="<?php home_url('/')  ?>?page_id=131">
Archive
</a>
<p>Browse essays by Assignment type, Citation, Progression, Year and more.</p>
</li>

<li>
<a href="<?php home_url('/')  ?>?page_id=129">
About
</a>
<p>Learn more about the journal.</p>
</li>

<li>
<a href="<?php home_url('/')  ?>?page_id=133">
Submissions
</a>
<p>Eligible students may submit their work for publication.</p>
</li>

<li>
<?php get_search_form(); ?>
</li>
</ul>

</div>
