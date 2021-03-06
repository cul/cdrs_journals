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
 
<div class="span-6">
&nbsp;
<div id="cu-writing" class="clearfix">

<a href="http://www.college.columbia.edu/core/uwp"><img id="selected-essays" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/selected-essays-home.png" alt="Selected Essays from the Columbia University Undergraduate Writing Program"></a>

</div>

</div>
<div class="span-14">

<?php
 
//global $term;
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  

$tax = ucfirst($term->taxonomy);
$taxname = $term->taxonomy;
$name= $term->name;
$slug = $term->slug; 
 
/* echo "Morningside Review Content by ". $tax; */
 
/*
 
switch ($tax) {
    case "source":
        echo "<h1>Essays based on ".$name."</h1>";
        break;
    case "progression":
        echo "<h1>Essays in progression ".$name."</h1>";
        break;
    case "writing-strategy":
        echo "<h1>Essays using writing strategy ".$name."</h1>";
        break;
    case "assignment":
        echo "<h1>Essays written for assignment ".$name."</h1>";
        break;
}
 
 


if (have_posts()) {
	echo '<ol>';
 
*/

echo "<h1>".$name."</h1>";



 
$termDiscription = term_description( '', get_query_var( 'taxonomy' ) );
if($termDiscription != ''){
echo'<div class="tag-desc">'.  $termDiscription .' </div>';
 
}

$taxEdition = get_terms('edition', 'orderby=slug&hide_empty&order=DESC');
$edition = array();
//var_dump($taxEdition);

foreach ($taxEdition as $ed) {
	if ($ed->slug == "current") {
		// do nothing
	}
	else {
		$edition[] = $ed->slug;
	}
}

//var_dump($edition);


/*for ($edCount = 0; $edCount<sizeof($edition); $edCount++) {

	$multiArgs = array(
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => $taxname,
				'terms' => array($slug),
				'field' => 'slug'
			),
			array(
				'taxonomy' => 'issue',
				'terms' => $edition[$edCount],
				'field' => 'slug'
				
			)
		)
	);
	
 
 	$taxQuery = new WP_Query($multiArgs);
 	

}*/

//var_dump($taxQuery);

//$taxQuery = query_posts(array($taxname=>$slug, 'order'=>'ASC'));
$taxQuery = query_posts(array($taxname=>$slug, 'meta_key'=>'author', 'orderby'=>'meta_value', 'order'=>'ASC'));

//echo "size of edition: ".sizeof($edition)."<br><br>";
//var_dump($edition);

//var_dump($taxQuery);


if (have_posts()) {
	
	//echo "taxQuery has posts!<br><br>";
	//	$edQuery = get_posts(array('issue'=>'20092010', 'meta_key'=>'author', 'orderby'=>'meta_value', 'order'=>'ASC'));
	//var_dump($edQuery);
 	
	while (have_posts()) {
		//for ($edCount=0; $edCount<sizeof($edition); $edCount++) {
			//$edQuery = query_posts(array('issue'=>$edition[$edCount], 'meta_key'=>'author', 'orderby'=>'meta_value', 'order'=>'ASC'));
			
			//var_dump($edQuery);
			

			echo '<ul class="archive-list">';
				
			the_post();
			
			echo "<li>";
			cfct_excerpt();
			echo "</li>";
			
		//}

	}
	echo '</ul>';
}


?>

</div>