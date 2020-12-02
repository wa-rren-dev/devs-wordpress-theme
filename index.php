<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (is_single()) { ?>

	<?php the_post(); ?>
	<div class="container">
		<main class="column column__reading">
			<header>
				<h1>
					<?php the_title(); ?>
					<span class="byline">by <?php echo get_the_author_meta("first_name") ?></span>, <span
						class="date"><?php echo get_the_date("d/m/Y"); ?></span>
				</h1>
			</header>
			<article>
				<?php the_content(); ?>
			</article>
		</main>
		<aside class="column column__writing">
			<?php comments_template() ?>
		</aside>
	</div>
<?php } else { ?>
	<div class="column">
	<header>
		<h1><?php echo get_bloginfo('name'); ?></h1>
		<p><?php echo get_bloginfo('description'); ?></p>
		<p>Done? <a href="<?php echo wp_logout_url( home_url()); ?>" title="Logout">Log out</a></p>
	</header>
	<main>
		<ul class="archive">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li>
					<h2 class="post-title h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-meta h4">
						&nbsp;by
						<span class="byline"><?php echo get_the_author_meta("first_name") ?></span>,
						<span class="date"><?php echo get_the_date("d-m-Y"); ?></span>

						<?php
							$comments = get_comments_number();
							if ($comments > 0) {
								echo "<span class='comment-count'>" . strval($comments) . "&nbsp;" . pluralize($comments, 'comment', 'comments') . "</span>";
							}
						?>
					</p>
				</li>
			<?php endwhile; endif; ?>
		</ul>
	</main>
	</div>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
