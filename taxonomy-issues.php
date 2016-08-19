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

get_header();
$options = get_option('general-options');
if($options['featured_image_setting'] == "yes"){
	$featured_class = "list-thumbs";
}else{
	$featured_class = "";
}
?>

<div id="primary" class="col-sm-12 <?php echo $featured_class ?>">

	<header role="page-title">
		<h1 class="archive-title"><?php
			if (is_day()) {
				printf(__('Daily Archives: %s', 'carrington-blueprint'), '<span>' . get_the_date() . '</span>');
			} elseif (is_month()) {
				printf(__('Monthly Archives: %s', 'carrington-blueprint'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'carrington-blueprint')) . '</span>');
			} elseif (is_year()) {
				printf(__('Yearly Archives: %s', 'carrington-blueprint'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'carrington-blueprint')) . '</span>');
			}  elseif (is_tax('issues')) {
				printf(__('Issue: %s', 'carrington-blueprint'), '<span>' . single_cat_title('', false ) . '</span>');
			}elseif (is_tax('aauthor')) {
				printf(__('Author Archives: %s', 'carrington-blueprint'), '<span>' . single_cat_title('', false ) . '</span>');
			}
		?></h1>

		<!-- issue taxonomy print date -->

		<div class="issue-print-date">
			<?php
				//Get the correct taxonomy ID by slug
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

				//Get Taxonomy Meta
				$saved_data = get_tax_meta($term->term_id,'print_date');
				echo $saved_data;
			?>
		</div>

	</header>

<!-- issue taxonomy description field  -->

<?php
	$termDescription = term_description( '', get_query_var( 'taxonomy' ) );
	if($termDescription != '') : ?>
		<h3 class="subhead"><?php echo $termDescription; ?></h3>
<?php endif; ?>

<!-- issue taxonomy bibliography field  -->

<?php
	$issue_link;
	$post_terms = (wp_get_post_terms($post->ID, 'issues'));
	$the_issue = wp_list_filter($post_terms, array('slug'=>'current-issue'),'NOT');
	foreach ($the_issue as $issue) {
		echo $issue_link;
	}
?>

<?php if ( get_tax_meta($issue->term_id, 'bibliography', true) ) { ?>

<?php
	$saved_data = get_tax_meta($issue->term_id,'bibliography');
	echo '<h3 class="section-label"><span>Bibliography</span></h3><div class="bibliography">';
	echo $saved_data;
	echo '</div>';
?>
<?php } ?>

<!-- issue taxonomy articles  -->

<?php
	global $query_string;
	query_posts( $query_string . '&order=ASC&orderby=menu_order' );

	cfct_loop();

	// Pagination
	cfct_misc('nav-posts');
?>

</div><!-- #primary -->

<?php
/* get_sidebar(); */


get_footer();
?>
