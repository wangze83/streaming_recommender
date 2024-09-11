<?php
$title = 'Content-Based Filtering Recommenders';
$genre = 'comedy';

$movieOptions = getMysqlData("SELECT ID, post_title FROM wp_posts WHERE post_type='movies' AND post_status='publish' LIMIT 30");
$movieOptions = array_column($movieOptions, 'post_title');
?>

<style>
    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }
    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color);
        text-align: center;
        white-space: nowrap;
        background-color: var(--bs-tertiary-bg);
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
    }
    select {
        position: relative;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
    }
</style>

<header>
    <h2><?php echo "Content-Based Filtering Recommenders"; ?></h2>
    <div class="nav_items_module">
        <a class="btn next_<?php echo $genre; ?>"><i class="fas fa-caret-left"></i></a>
        <a class="btn prev_<?php echo $genre; ?>"><i class="fas fa-caret-right"></i></a>
    </div>
    <?php
    echo '</header>';
    echo '<div class="genreload load_modules">' . __d('Loading..') . '</div>';
    //Display Query posts
    $transient = new WP_Query(array(
        'post_titles' => getContentBasedCF_recommendations($movieOptions[0])['recommendations'],
    ));
    ?>
    <?php

    if ($movieOptions[0] !== "0 results") {
        echo '<div class="input-group" style="margin-left: 10px;"><span class="input-group-text">Select a movie:</span> <select id="movieSelect" class="form-select" aria-label="Select a movie" style="width: 300px;">';

        foreach ($movieOptions as $option) {
            echo '<option value="' . $option . '">' . $option . '</option>';
        }

        echo '</select></div>';
    } else {
        echo "0 results";
    }
    ?>
    <p></p>

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

    <script>
        jQuery(document).ready(function($) {
            $("#movieSelect").change(function() {
                var selectedMovie = $(this).val();

                // 使用 AJAX 请求
                $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8080/sr-admin/admin-ajax.php",
                    data: {
                        action: "content_based_action",
                        title: selectedMovie
                    },
                    success: function(response) {
                        // 在这里处理 AJAX 请求成功后的逻辑
                        console.log("Response from server: " + response.recommendations);

                        // 将获取的 HTML 替换到页面上的元素
                        $("#genre_comedy .owl-wrapper").html(response.html);
                    },
                    error: function(error) {
                        // 在这里处理 AJAX 请求失败后的逻辑
                        console.log("Error: " + error);
                    }
                });
            });
        });
    </script>

