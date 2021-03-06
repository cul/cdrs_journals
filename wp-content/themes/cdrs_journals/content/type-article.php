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

?>
<div class="col-sm-2" id="left-bar">

<div id="scrolled-head" class="hidden-xs hidden-print" style="display:none">

	<h1 class="entry-title"><?php the_title() ?></h1>
	<h2 class="authors">
	<?php

  		$authors =  wp_get_object_terms($post->ID, 'authors', array("fields" => "all", 'orderby' => 'term_order'));
  		$moreAuthors = array();
  		if($authors){
           foreach ( $authors as $author ) {

    		// The $term is an object, so we don't need to specify the $taxonomy.
    		$term_link = get_term_link( $author );

    		// If there was an error, continue to the next term.
			if ( is_wp_error( $term_link ) ) {
				continue;
			}

    		// We successfully got a link. Print it out.
    		array_push( $moreAuthors, '<a href="' . esc_url( $term_link ) . '">' . $author->name . '</a>');
		}
		echo implode(', ', $moreAuthors);



   }?>
	</h2>

	<hr>

	<?php

	$issue_link;

	$post_terms = (wp_get_post_terms($post->ID, 'issues'));
	$the_issue = wp_list_filter($post_terms, array('slug'=>'current-issue'),'NOT');
	foreach ($the_issue as $issue) {

			$issue_link = '<a href="'.get_term_link($issue->slug, 'issues').'">'.$issue->name.'</a>';
			echo $issue_link;
		}
	?>
</div>
</div>

<div id="primary" class="col-sm-8">

<article id="post-<?php the_ID() ?>" <?php post_class('clearfix') ?>>
	<header class="entry-header">
		<?php $sections = wp_get_post_terms($post->ID, 'sections');
			if(!empty($sections)){
				foreach ($sections as $section) {
				$term_link = get_term_link( $section );
				echo '<h3 class="super"><a href="' . esc_url($term_link) . '"><span class="super-l">' . $section->name. '</span></a><span class="super-r">'.$issue_link.'</h3>';
				}
			}else{
				echo '<h3 class="super"><span class="super-l">Article</span><span class="super-r">'.$issue_link.'</h3>';
			}

		?>


		<h1 class="entry-title"><?php the_title() ?></h1>
		<?php
			$post_custom = get_post_custom($post->ID);
			$options = get_option('general-options');
			$foot_options = get_option( 'my-footer-options' );
        	$copyright_url = $foot_options['copyright_url'];
	  		$cc = $options['cc_setting'];
	  		$issues =  wp_get_post_terms($post->ID, 'issues', array("fields" => "all"));
	  		foreach ($issues as $issue) {
	  			$cc_id = get_tax_meta($issue->term_id, 'cc_id');
	  		}

	        if($cc_id != null && $cc_id != "None"){
	        	get_cc_status($cc_id);
	        }
			elseif($cc != null && $cc != "None"){
				get_cc_status($cc);
			}
		?>
		<div class="auth_div">
	<?php


  		$authors =  wp_get_object_terms($post->ID, 'authors', array("fields" => "all", 'orderby' => 'term_order'));
  		$moreAuthors = array();

  		$schools = array();
  		$num = 1;
  		$auth_count = 1;
  		$school_count = 1;

  		if($authors){
           foreach ( $authors as $author ) {
	           $their_school = get_tax_meta($author->term_id, 'institution');
	           $their_email = get_tax_meta($author->term_id, 'email');
	           if(!empty($their_school) && $their_school != NULL && !$schools[$their_school]){
	           	 $schools[$their_school] = $num;
	           	 ++$num;
	           }

	    		// The $term is an object, so we don't need to specify the $taxonomy.
	    		$term_link = get_term_link( $author );

	    		// If there was an error, continue to the next term.
				if ( is_wp_error( $term_link ) ) {
					continue;
				}

				echo '<h2 class="authors">' . '<a href="' . esc_url( $term_link ) . '">' .  $author->name . '</a>' . ( !empty($schools[$their_school])? ( count($authors) == 1 ? '' : '<sup>' . $schools[$their_school] . '</sup>')  : ''  ) . ( !empty($their_email) ? '<sup><a title="' . $their_email . '" href="mailto:'. $their_email .'"><i class="fa fa-envelope"></i></a></sup>' : ''  ) . ($auth_count < count($authors)? ', ' : '')  .  '</h2>';
				++$auth_count;

			}
		}

		echo '<div class="auths_schools">';
 		foreach ($schools as $school => $number) {
 			echo '<h5 class="schools">' . ( count($authors) > 1 ? '<span class="school_num">'. $number .'</span>' : '') . ' ' .$school . ($school_count < count($schools)? ', ' : '') . '</h5>';
 			++$school_count;
 		}
 		echo '</div>';

   ?>
</div>
	<div class="library_data">
	<?php
  		$the_doi = $post_custom['doi'];
  		$the_citation = $post_custom['citation'];

  		if($the_doi[0]||$the_citation[0]){

  		echo "<table class='lib-data'><tbody>";
  		if($the_doi[0]){
  		echo '<tr><td class="tlabel">DOI:</td><td> <a href="http://dx.doi.org/'. $the_doi[0] . '">' . $the_doi[0] . '</a></td></tr>';
  		}



  		if($the_citation[0]){
  		echo '<tr><td class="tlabel">Citation:</td><td>' . $the_citation[0] . '</td></tr>';
  		};

		echo "</tbody></table>";
		}

	?>
	</div>
	<?php
		if ( has_post_thumbnail() ) { ?>
	<div class="featured_image col-md-12 hidden-sm hidden-xs">
		<?php
			    the_post_thumbnail('full');
				echo '<h3 class="featured_image_caption">' . get_post( get_post_thumbnail_id() )->post_excerpt . '</h3>';
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>
	</div>
	<div class="featured_image col-xs-12 hidden-md hidden-lg">
		<?php
			    the_post_thumbnail('large');
				echo '<h3 class="featured_image_caption">' . get_post( get_post_thumbnail_id() )->post_excerpt . '</h3>';
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>
	</div>

	<?php } ?>

	</header>
	<div class="entry-content">
		<?php the_content() ?>
	</div>
	<div class="col-sm-6 hidden-sm hidden-xs prev_article"><?php previous_post_link('%link', 'Previous Article: %title', TRUE, ' ', 'issues'); ?></div>
	<div class="col-sm-6 hidden-sm hidden-xs next_article"><?php next_post_link('%link', 'Next Article: %title' , TRUE, ' ', 'issues') ?></div>

	<div class="col-xs-6 hidden-md hidden-lg prev_article"><?php previous_post_link('%link', '<i class="fa fa-arrow-circle-left fa-2x"></i>', TRUE, ' ', 'issues'); ?></div>
	<div class="col-xs-6 hidden-md hidden-lg next_article"><?php next_post_link('%link', '<i class="fa fa-arrow-circle-right fa-2x"></i>' , TRUE, ' ', 'issues') ?></div>

	<div class="entry-footer entry-meta">

	</div>



</article><!-- .post -->
</div>

<div class="col-sm-2" id="right-bar">
<div id="article-tools" class="hidden-xs hidden-print">

<!-- 	<a href="javascript:print();"><i class="fa fa-print"></i>&nbsp;Print</a> -->
<?php

	$pdf_link = get_post_meta(get_the_id(), '_cmb_pdf', true);
	$ac_pdf_link = $post_custom['ac_pdf'];

		if($pdf_link != ""){
			echo '<h5>Download Full Text</h5>';
			foreach ($pdf_link as $pdf) {
				echo '<a href="' . $pdf . '"><i class="fa fa-file-text"></i>&nbsp;PDF</a>';
			}
		}elseif ($ac_pdf_link[0] != "") {
			echo '<h5>Download Full Text</h5>';
			foreach ($ac_pdf_link as $pdf) {
				echo '<a href="' . $pdf . '"><i class="fa fa-file-text"></i>&nbsp;PDF</a>';
			}
		}
 ?>





<?php
$options = get_option( 'social-media-options' );
	$twitter_name =  $options['twitter_name'];
	$fb_name = $options['fb_name'];
	$linked_in = $options['linkedin_name'];
	$link = get_permalink();
?>

<h5>Share This</h5>

<a href="mailto:?subject=<?php echo the_title(); ?>&body=<?php echo the_permalink(); ?>"><i class="fa fa-envelope"></i>&nbsp;Email</a>

	<?php

	    if($twitter_name){
	?>
		<a href="http://twitter.com/intent/tweet?text=<?php echo the_title() ?>&url=<?php echo $link ?>&via=<?php echo $twitter_name ?>" target="_blank"> <i class="fa fa-twitter"></i>&nbsp;Twitter</a>
	<?php } else{ ?>
		<a href="http://twitter.com/intent/tweet?text=<?php echo the_title() ?>&url=<?php echo $link ?>" target="_blank"> <i class="fa fa-twitter"></i>&nbsp;Twitter</a>
	<?php } ?>
		<a href="http://facebook.com//sharer/sharer.php?u=<?php echo $link ?>" target="_blank"> <i class="fa fa-facebook"></i>&nbsp;Facebook</a>

		<a href="http:///www.linkedin.com/shareArticle?mini=true&url=<?php echo $link ?>&title=<?php echo the_title() ?>" target="_blank"> <i class="fa fa-linkedin-square"></i>&nbsp;LinkedIn</a>




<?php if ( get_tax_meta($issue->term_id, 'link1name', true) ) { ?>

<h5>Article Access</h5>

<p>Search for this article in these subscription databases:</p>

<a href="<?php $saved_data = get_tax_meta($issue->term_id,'link1url'); echo $saved_data; ?>"><?php $saved_data = get_tax_meta($issue->term_id,'link1name'); echo $saved_data; ?></a>

<a href="<?php $saved_data = get_tax_meta($issue->term_id,'link2url'); echo $saved_data; ?>"><?php $saved_data = get_tax_meta($issue->term_id,'link2name'); echo $saved_data; ?></a>

<a href="<?php $saved_data = get_tax_meta($issue->term_id,'link3url'); echo $saved_data; ?>"><?php $saved_data = get_tax_meta($issue->term_id,'link3name'); echo $saved_data; ?></a>

<a href="<?php $saved_data = get_tax_meta($issue->term_id,'link4url'); echo $saved_data; ?>"><?php $saved_data = get_tax_meta($issue->term_id,'link4name'); echo $saved_data; ?></a>

<a href="<?php $saved_data = get_tax_meta($issue->term_id,'link5url'); echo $saved_data; ?>"><?php $saved_data = get_tax_meta($issue->term_id,'link5name'); echo $saved_data; ?></a>

<?php } ?>

</div>

<div class="mobile_social_media visible-xs">

	<?php
	if($pdf_link != ""){
			foreach ($pdf_link as $pdf) {
				echo '<a href="' . $pdf . '"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-file-text fa-1x"></i></span></a>';
			}
		}elseif ($ac_pdf_link[0] != "") {
			foreach ($ac_pdf_link as $pdf) {
				echo '<a href="' . $pdf . '"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-file-text fa-1x"></i></span></a>';
			}
		}
?>
	<a href="mailto:?subject=<?php echo the_title(); ?>&body=<?php echo the_permalink(); ?>"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-envelope fa-1x"></i></span></a>


	<?php

	    if($twitter_name){
	?>
		<a href="http://twitter.com/intent/tweet?text=<?php echo the_title() ?>&url=<?php echo $link ?>&via=<?php echo $twitter_name ?>" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i>  <i class="fa fa-twitter fa-1x"></i></span></a>
	<?php } else{ ?>
		<a href="http://twitter.com/intent/tweet?text=<?php echo the_title() ?>&url=<?php echo $link ?>" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i>  <i class="fa fa-twitter fa-1x"></i></span></a>

	<?php } ?>
		<a href="http://facebook.com//sharer/sharer.php?u=<?php echo $link ?>" target="_blank"> <span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-facebook fa-1x"></i></span></a>

		<a href="http:///www.linkedin.com/shareArticle?mini=true&url=<?php echo $link ?>&title=<?php echo the_title() ?>" target="_blank"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-linkedin fa-1x"></i></span></a>

</div>

</div>
