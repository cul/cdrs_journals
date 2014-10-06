<?php

// This file is part of the Carrington Blueprint Theme for WordPress
//
// Copyright (c) 2008-2014 Crowd Favorite, Ltd. All rights reserved.
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

$blog_desc = get_bloginfo('description');
$title_description = (is_home() && !empty($blog_desc) ? ' - '.$blog_desc : '');

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 oldie" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie10 lt-ie9 lt-ie8 oldie" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9 oldie" <?php language_attributes() ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10 oldie" <?php language_attributes() ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset') ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ).$title_description; ?></title>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.ico"  type="image/x-icon" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- 	adding meta tags  -->
	
	<?php if(get_post_type() == 'article'): ?>
	<meta name="citation_publisher" content="Center for Research and Digital Scholarship, Columbia University"/>
	<meta name="citation_journal_title" content="<?php echo get_bloginfo(); ?>" />
	<?php $options = get_option( 'my-theme-options' ); 
		$print = $options['print_issn'];
		echo '<meta name="citation_issn" content="'. $print .'"/>';
	?>
	<meta name="citation_title" content="<?php echo get_the_title($POST->ID); ?>"/>

	<?php 
		$authors =  wp_get_post_terms($post->ID, 'aauthor', array("fields" => "all")); 
		foreach ( $authors as $author ) {
			echo '<meta name="citation_author" content="' . $author->name . '">';  
		};
		$attachments = get_posts(array('post_type' => 'attachment','numberposts' => null,'post_status' => null,'post_parent' => $post->ID));
		if ($attachments) {
          foreach ($attachments as $attachment) {
             echo '<meta name="citation_pdf_url" content="'.wp_get_attachment_link($attachment->ID).'"/>'; 
          }
        }	
		$volumes = get_the_terms($post->ID, 'issues');
		  foreach($volumes as $volume){
		  		$pieces = explode(" ", $volume->name);
				$the_volume = trim($pieces[1], ',');
				echo '<meta name="citation_volume" content="'. $the_volume .'">'; 
				
				$the_issue = array_pop($pieces);
				echo '<meta name="citation_issue" content="'. $the_issue .'">';
				
				$print_date = get_tax_meta($volume->term_id ,'print_date'); 
				echo '<meta name="citation_publication_date" content="'. $print_date .'">';
	 		}
	 	$custom_doi = get_post_custom($post->ID);
  		$the_doi = $custom_doi['doi'];
  		foreach ( $the_doi as $doi ) {
  			echo '<meta name="citation_doi" content="'. $doi .'">'; 
		} 

	?>
	<meta name="citation_online_date" content="<?php echo get_the_date('Y/m/d', $POST->ID); ?>" />
	<meta name="citation_date" content="<?php echo date('Y/m/d'); ?>" />
	<?php endif; ?>
	
	<?php wp_head(); ?>
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/ie78-style.css" type="text/css" media="all"><![endif]-->

</head>
<body <?php body_class(); ?>>
<div class="breakpoint-context"></div>
<div class="container grid">
	<header id="masthead" class="row site-header clearfix">
	 
 
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url(); ?>">
                <?php bloginfo('name'); ?>
            </a>
    </div>

        <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </div>
</nav>


<img id="header_image" src="<?php header_image(); ?>" height=100px width=100px  alt="CURJ logo" />


<h1 id="site-name"><a href="<?php echo home_url('/'); ?>" title="<?php _e('Home', 'carrington-blueprint'); ?>"><?php bloginfo('name'); ?></a></h1>


 
	</header><!-- #masthead -->

	<div id="main" class="row clearfix">