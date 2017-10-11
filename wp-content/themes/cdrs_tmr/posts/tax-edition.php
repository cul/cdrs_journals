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

get_header();

$tag_title =   single_tag_title('', false) ;

?>
 
 
<div class="span-6">
&nbsp;
<div id="cu-writing">
<a href="http://www.college.columbia.edu/core/uwp"><img id="selected-essays" src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/selected-essays-home.png" alt="Selected Essays from the Columbia University Undergraduate Writing Program"></a>
</div>
</div>
<div id="content" role="main" class="span-15">
<h1 class="edition-label"><?php 
echo $tag_title." Edition" ?></h1>

<?php

/* cfct_loop(); */


cfct_template_file('loop', 'loop-tax-edition.php');


/*
cfct_misc('nav-posts');

get_sidebar();
*/

?>

</div>

<?php

get_footer();

?>