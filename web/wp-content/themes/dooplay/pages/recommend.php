<?php
/*
Template Name: DT - recommend
*/
// Header
get_header();
// Glossary
doo_glossary();
// Modules
$default = array(
    'slider'        => false,
    'featured-post' => false,
    'movies'        => false,
    'ads'           => false,
    'tvshows'       => false,
    'seasons'       => false,
    'episodes'      => false,
    'top-imdb'      => false,
    'blog'          => false
);
// Options
$fullwid = dooplay_get_option('homefullwidth');
$sidebar = dooplay_get_option('sidebar_position_home','right');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400) ? 'full' : 'normal';
$hoclass = ($fullwid == true) ? ' full_width_layout' : ' '.$sidebar;
$modules = [
    'kg_recommendations' => 'kg_recommendations',
    'content_based_CF_recommendations' => 'content_based_CF_recommendations',
    'tfrs_predict' => 'tfrs_predict',
    ];
// Print home
echo '<div class="module">';
echo '<div class="content'.$hoclass.' '.$maxwidth.'">';
if(!empty($modules)){
    // Get template
    foreach($modules as $template => $template_name) {
        get_template_part('inc/parts/modules/'.$template);
    }
}
echo '</div>';
// Sidebar
if(!$fullwid) {
    echo '<div class="sidebar '.$sidebar.' scrolling"><div class="fixed-sidebar-blank">';
    dynamic_sidebar('sidebar-home');
    echo '</div></div>';
}
echo '</div>';
// Footer
get_footer();
