<?php
function childtheme_doctitle() {
 
 // You don't want to change this one.
 $site_name = get_bloginfo('name');
 
 // But you like to have a different separator
 $separator = '&raquo;';
 
 // We will keep the original code
 if ( is_single() ) {
 $content = single_post_title('', FALSE);
 }
 elseif ( is_home() || is_front_page() ) {
 $content = get_bloginfo('description');
 }
 elseif ( is_page() ) {
 $content = single_post_title('', FALSE);
 }
 elseif ( is_search() ) {
 $content = __('Search Results for:', 'thematic');
 $content .= ' ' . wp_specialchars(stripslashes(get_search_query()), true);
 }
 elseif ( is_category() ) {
 $content = __('Category Archives:', 'thematic');
 $content .= ' ' . single_cat_title("", false);;
 }
 elseif ( is_tag() ) {
 $content = __('Tag Archives:', 'thematic');
 $content .= ' ' . thematic_tag_query();
 }
 elseif ( is_404() ) {
 $content = __('Not Found', 'thematic');
 }
 else {
 $content = get_bloginfo('description');
 }
 
 if (get_query_var('paged')) {
 $content .= ' ' .$separator. ' ';
 $content .= 'Page';
 $content .= ' ';
 $content .= get_query_var('paged');
 }
 
 // until we reach this point. You want to have the site_name everywhere?
 // Ok .. here it is.
 $my_elements = array(
 'site_name' => $site_name,
 'separator' => $separator,
 'content' => $content
 );
 
 // and now we're reversing the array as long as we're not on home or front_page
 if (!( is_home() || is_front_page() )) {
 $my_elements = array_reverse($my_elements);
 }
 
 // And don't forget to return your new creation
 return $my_elements;
}
 
// Add the filter to the original function
add_filter('thematic_doctitle', 'childtheme_doctitle');

//Add in a link to the bootstrap css
function childtheme_create_stylesheet($content) {
   $content .= "\t";
    $content .= "
          <link rel=\"stylesheet\" type=\"text/css\" href=\"";
    //$content .= get_bloginfo('stylesheet_directory') . '/';
    $content .= 'http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css';
     $content .= "\" />";
     $content .= "\n\n";
      return $content;
}
//add_filter('thematic_create_stylesheet', 'childtheme_create_stylesheet');

//auto resize embeds to have a width of 340px
function resize_objects_and_embeds(){
  //$script = <<< SCRPT

    //<script type='text/javascript'>

    //setWidth('340px','embed');
    //setWidth('340px','object');
    //function setWidth(w,tagname){
      //var items =getElementsByTagName(tagname); 
      //for item in items{
        //item.setAttribute('width',w);
      //}
    //}

    //</script>
    //SCRPT;
    //return $script;
  return '<script type="text/javascript">alert("hello!");</script>';

}

add_action('thematic_before', 'resize_objects_and_embeds');


?>
