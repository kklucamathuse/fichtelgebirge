<?php get_header(); ?>

<div id="intro">
	<div class="wrapper">
		<?php if (have_posts()) : ?>
			<h1>Suchergebnisse für: <?php echo $s ?></h1>
		<?php else : ?>
			<h1>Keine Ergebnisse gefunden</h1>
		<?php endif; ?>
	</div>
</div>

<?php if (have_posts()) : ?>
	<div id="search">
		<div class="wrapper">
		
			<?php while (have_posts()) : the_post(); ?>

				<?php
					$fields = get_fields( $post->ID );
					//var_dump($fields);
					$permalink = get_permalink( $post->ID );
					$title = $fields["name"];
				?>

				<div class="result">
					<a href="<?php echo $permalink; ?>">
						<strong><?php echo $title; ?></strong>
					</a>
				</div>
			<?php endwhile; ?>

		</div>
	</div>
<?php endif; ?>

<?php  get_footer(); ?>