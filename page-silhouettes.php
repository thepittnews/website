<?php
/**
 *  Template Name: Silhouettes Big List
*/
?>

<!DOCTYPE html>
<head>
  <style>
    .story {
      width: 25%;
      height: 325px;
      float: left;
      background-size: cover !important;
      background-position: center !important;
      background-repeat: no-repeat !important;
    }

    .story:hover > .overlay {
      width: 25%;
      height: 325px;
      position: absolute;
      background-color: rgba(0,0,0,0.7);
    }

    .storyTitle {
      font-family: 'Source Sans Pro', sans-serif;
      text-align: center;
      position: relative;
      top: 120px;
      color: rgba(255,255,255,1);
      font-size: 30px;
    }

    @media(max-width: 993px) {
      .story {
        width: 33.3333%;
      }

      .story:hover > .overlay {
        width: 33.3333%;
      }
    }

    @media(max-width: 750px) {
      .story {
        width: 50%;
      }

      .story:hover > .overlay {
        width: 50%;
      }
    }

    @media(max-width: 600px) {
      .story {
        width: 100%;
      }

      .story:hover > .overlay {
        width: 100%;
      }
    }

    .yearContainer {
      clear: both;
      width: 100%;
      height: auto;
      display: inline-block;
    }

    .yearTitle {
      text-align: center;
      font-family: 'Source Sans Pro', sans-serif;
      font-weight: 300;
      font-size: 56px;
      margin: 40px;
    }

    .yearTitle small {
      font-size: 32px;
    }
  </style>

<?php get_header(); ?>
</div>

<?php
  $categories = get_categories(array(
    'name__like' => 'Silhouettes',
    'orderby' => 'name',
    'order' => 'DESC'
  ));

  foreach($categories as $category) {
?>

<h1 class="yearTitle"><?php echo $category->name; ?> <small><? echo $category->description ?></small></h1>

<div class="yearContainer">
<?php
	$stories = new WP_Query();
  $stories->query(array(
    'category_name' => $category->name,
    'nopaging' => true
  ));

	if ($stories->have_posts()) {
		while ($stories->have_posts()) {
			$stories->the_post(); ?>
				<a href="<?php the_permalink(); ?>">
					<div class="story" style="background:url(<?php the_post_thumbnail_url('large'); ?>);">

						<div class="overlay"></div>
						<p class="storyTitle"><?php the_title(); ?></p>
					</div>
				</a>
		<?php
		}
	}
?>
</div>

<?php } ?>

<?php get_footer(); ?>
