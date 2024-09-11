<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/

// Compose data MODULE
$sldr = doo_is_true('moviemodcontrol','slider');
$auto = doo_is_true('moviemodcontrol','autopl');
$orde = dooplay_get_option('moviemodorderby','date');
$ordr = dooplay_get_option('moviemodorder','DESC');
$pitm = dooplay_get_option('movieitems','10');
$titl = dooplay_get_option('movietitle','Movies');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400 && !$sldr) ? 'full' : 'normal';
$pmlk = get_post_type_archive_link('movies');
$totl = doo_total_count('movies');
$eowl = ($sldr == true) ? 'id="dt-movies" ' : false;

if (!is_user_logged_in()) {
    $home_topmovies = getTopMovieIds(20, 20, 'DESC', 100);
    $home_topmovies = array_slice($home_topmovies, 0, 10);
    $query = array(
        'post_ids' => implode(',', $home_topmovies),
    );
} else {
    $userinfo = wp_get_current_user();
    $userinfo = (array)$userinfo;
    $ch = curl_init();
    $url = 'http://flask-api:5000/kg_recommendations?userid=' . $userinfo['ID'] . '&limit=20';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 将结果返回而不是直接输出
    curl_setopt($ch, CURLOPT_HEADER, 0); // 不包含头部信息
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    $post_titles = array_column(json_decode($response), 'title');

// Compose Query
    $query = array(
        'post_titles' => $post_titles,
    );
}
// End Data
?>
<header>
	<h2><?php echo 'Knowledge Graph Recommenders'; ?></h2>
	<?php if($sldr == true && !$auto) { ?>
	<div class="nav_items_module">
	  <a class="btn prev3"><i class="fas fa-caret-left"></i></a>
	  <a class="btn next3"><i class="fas fa-caret-right"></i></a>
	</div>
	<?php } ?>
</header>
<div id="movload" class="load_modules"><?php _d('Loading..'); ?></div>
<div <?php echo $eowl; ?>class="items <?php echo $maxwidth; ?>">
	<?php query_posts($query); while(have_posts()){ the_post(); get_template_part('inc/parts/item'); } wp_reset_query(); ?>
</div>
