jQuery( document ).ready(function() {
	
	
	
	
	
  jQuery("body.home #masthead").waypoint(function() {
  jQuery("nav").toggle();
  }, {
  offset: function() {
    return -jQuery(this).height();
  }
});



  jQuery("article header").waypoint(function() {
  jQuery("#scrolled-head").toggle();
  
 
  }, {
  offset: function() {
    return -jQuery(this).height();
  }
});

  jQuery("div#footer_container").waypoint(function() {
  jQuery("#scrolled-head").toggle();
  
 
  }, {
  offset: function() {
    return -jQuery(this).height();
  }
});




var article = jQuery("#article-tools");
if(window.innerWidth < 766){
  jQuery(article).detach();
  jQuery(article).appendTo(".library_data");
  jQuery(article).removeAttr(style);
}

//removing some out of the box styling with the search everything plugin
jQuery("#s").addClass("form-control");
jQuery("input#searchsubmit").remove();
jQuery("#site-search .screen-reader-text").remove();
jQuery("#home-search-top .screen-reader-text").remove();
jQuery("#home-search .screen-reader-text").remove();
jQuery("#s").unwrap();
jQuery("#s").unwrap();
jQuery("#home-search #s").unwrap();
jQuery("#home-search #s").unwrap();



//hackey article header search fix
var url = "http://curj-dev.journals.cdrs.columbia.edu/?s=";
jQuery("#sub").on("click", function(){
  event.preventDefault();
  var new_url = url.concat(jQuery("#s").val());
//   jQuery.load(new_url);
  window.location.href = new_url;
});

window.addEventListener("hashchange", function() { scrollBy(0, -71);   });


	
	
});


