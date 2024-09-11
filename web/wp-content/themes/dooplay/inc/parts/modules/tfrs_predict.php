<?php
$logg = is_user_logged_in();
if ($logg) {
    $userinfo = wp_get_current_user();
    $userinfo = (array)$userinfo;
    $title = 'TensorFlow Recommenders Base On User';
    $genre = 'action';

    $url = 'http://flask-api:5000/tfrs_predict';
    $data = json_encode(['user' => $userinfo['ID']]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    $list = (array)json_decode($response);
//Display Query posts
    $transient = new WP_Query(array(
        'post_titles' => $list['recommendations'],
    ));
} else {
    $home_topmovies = getTopMovieIds(40, 40);
    $home_topmovies = array_slice($home_topmovies, -10, 10);
    $transient = new WP_Query(array(
        'post_ids' => implode(',', $home_topmovies),
    ));
}

?>

<header>
    <h2><?php echo $title; ?></h2>
    <div class="nav_items_module">
        <a class="btn next_<?php echo $genre; ?>"><i class="fas fa-caret-left"></i></a>
        <a class="btn prev_<?php echo $genre; ?>"><i class="fas fa-caret-right"></i></a>
    </div>
    <?php
    echo '</header>';
    echo '<div class="genreload load_modules">' . __d('Loading..') . '</div>';
    ?>
    <div id="genre_<?php echo $genre; ?>" class="list_genres items">
        <?php while ($transient->have_posts()) : $transient->the_post(); ?>
            <?php get_template_part('inc/parts/item'); ?>
        <?php endwhile; ?>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            var owl = $("#genre_<?php echo $genre; ?>");
            owl.owlCarousel({
                items: 7,
                autoPlay: false,
                stopOnHover: true,
                pagination: false,
                itemsDesktop: [1400, 6],
                itemsDesktopSmall: [1300, 5],
                itemsTablet: [768, 4],
                itemsTabletSmall: false,
                itemsMobile: [479, 3],
            });
            $(".next_<?php echo $genre; ?>").click(function () {
                owl.trigger('owl.prev');
            })
            $(".prev_<?php echo $genre; ?>").click(function () {
                owl.trigger('owl.next');
            })
        });
    </script>
    <?php wp_reset_query(); ?>


