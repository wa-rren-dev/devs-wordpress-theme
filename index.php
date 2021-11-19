<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/assets/css/main.css"/>
	<?php include get_template_directory() . '/analytics.php'; ?>
</head>

<body <?php body_class(); ?>>

<div style="display: none">
___________________________________________________________________
      __   __   ___              __   ___      ___         __
|\ | /  \ /__` |__  \ /     /\  |__) |__  |\ |  |     \ / /  \ |  |
| \| \__/ .__/ |___  |     /~~\ |  \ |___ | \|  |      |  \__/ \__/
-------------------------------------------------------------------
</div>

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
			<img src="<?php echo bloginfo('template_directory'); ?>/assets/images/learnding.gif" alt="">
			<h1><?php echo get_bloginfo('name'); ?></h1>
			<p><?php echo get_bloginfo('description'); ?></p>
			<p>Done? <a href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">Log out</a>. Wanna write something? <a href="/wp-admin/edit.php">Create a new post!</a></p>
			<button class="btn" id="dark-mode">Dark mode</button>
			<button class="btn" id="super-dark-mode">Super Dark mode</button>
		</header>
		<main>
			<ul class="archive">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li>
						<h2 class="post-title h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p class="post-meta h4">by
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

	<script src="<?php echo bloginfo('template_directory'); ?>/assets/js/bundle.js"></script>
</body>
</html>
