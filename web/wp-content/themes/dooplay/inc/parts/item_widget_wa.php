<?php
$img = dbmovies_get_backdrop($post->ID,'w780');
if (strpos($img, "/assets/img/no/dt_backdrop.png") === false) {
?>
<article class="w_item_a"  id="post-<?php the_id(); ?>">
	<a href="<?php the_permalink() ?>">
		<div class="image">
			<img src="<?php $img = dbmovies_get_backdrop($post->ID,'w780'); echo $img; ?>" alt="<?php the_title(); ?>" />
			<div class="data">
				<h3><?php the_title(); ?></h3>
				<?php if($mostrar = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'dtyear'))) {  ?>
				<span class="wdate"><?php echo $mostrar; ?></span>
				<?php } ?>
			</div>
			<?php if($mostrar = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'dtquality'))) {  ?><span class="quality"><?php echo $mostrar; ?></span><?php } ?>

        </div>
	</a>
</article>

<?php
}
?>
