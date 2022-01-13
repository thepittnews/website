<?php
/**
 *  Template Name: ACC Champs
*/

$featured_image_id = get_post_thumbnail_id($post->ID);
$featured_image_info = wp_get_attachment_image_src($featured_image_id, 'full');
$photographer = get_post_meta($featured_image_id, 'photographer', true);
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,900|Oswald:300,400|Slabo+27px" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-66952241-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-66952241-1');
    </script>

    <title><?php the_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="The Pitt News | <?php the_title(); ?>" />
    <meta property="og:description" content="<?php the_excerpt() ?>" />
    <meta property="og:url" content="<?php the_permalink() ?>" />
    <meta property="og:site_name" content="The Pitt News" />
    <meta property="article:publisher" content="https://www.facebook.com/thepittnews/" />
    <meta property="article:published_time" content="<?php echo get_the_date('c'); ?>" />
    <meta property="article:modified_time" content="<?php echo the_modified_date('c'); ?>" />
    <meta property="og:image" content="<?php the_post_thumbnail_url('full'); ?>" />
    <meta property="og:image:width" content="<?php echo $featured_image_info[1]; ?>" />
    <meta property="og:image:height" content="<?php echo $featured_image_info[2]; ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@thepittnews" />
    <meta name="twitter:site" content="@thepittnews" />

    <style>
      body { overflow-x: hidden; }

      /* ** TITLES and HEADER ** */
      #story-title, #header-title {
        font-weight: 900;
        font-family: 'Merriweather', serif;
        color: white;
      }

      #story-title {
        background-color:rgba(0, 255, 0, 0);
        height: 0px;
        position: relative;
        top: -190px; /* Used to be -225[x; */
        left: 100px;
        font-size: 50px;
        max-width: 80%;
        text-shadow: 2px 2px black;
        display: block;
      }

      #header-title {
        margin-left: auto;
        margin-right: auto;
        float: right;
        padding-right: 20px;
        opacity: 0;
        transition: all 1s linear;
      }

      .show-title {
        opacity: 1 !important;
        transition: all 1s linear;
      }

      nav {
        background-color: #212121 !important;
        opacity: 0.8;
      }

      .navbar-fixed {
				position: fixed;
				top: 0px;
      }

      .brand-logo {
        height: 40px;
        margin-top: 10px;
        margin-left: 10px;
      }

      .author-info {
        font-family: 'Oswald', sans-serif;
        font-size: 20px;
      }

      /* ** GENERAL CSS ** */
      .container a:hover {
        background-color: aliceblue;
        transition: background-color .5s linear;
      }

      p {
        font-family: 'Merriweather', serif;
        font-weight: 300;
      }

      .header-image {
        width: 100%;
        height: 100vh;
        object-fit: cover;
       <?php if ($featured_image_id != 168796) { echo "object-position: top;"; } ?>
      }

      .aligncenter { margin: 0 auto; text-align: center; }
      .wp-caption-text { font-style: italic; }
      img.size-large { height: auto; width: 100% }

      /* ** MEDIA ** */
      @media(min-width: 994px) {
        p { font-size: 20px !important; }
      }

      @media(max-width: 993px) {
        #header-title { display: none; }

        #story-title {
          /*top: -400px !important;*/
          left: 50px !important;
          font-size: 35px !important;
        }
      }

      @media(max-width: 600px) {
        figure.wp-caption { width: 100% !important; }
        img.size-large { width: 90%; height: 90%; }
      }
    </style>
  </head>

  <body>
    <div class="navbar-fixed">
      <nav>
        &nbsp;
        <a href="https://pittnews.com"><img class="brand-logo" src="https://pittnews.com/wp-content/uploads/2018/03/TPN-VECTOR-BLUE-small.png" /></a>
        <span id="header-title"><?php the_title(); ?></span>
      </nav>
    </div>

    <img class="header-image" src="<?php the_post_thumbnail_url('full'); ?>" />

    <div class="section white">
      <h4 id="story-title"><?php the_title(); ?></h4>
      <div class="container">
        <span class="author-info"> Written by The Pitt News Sports Staff</span><br/>
        <span class="author-info">Feature photo by <?php echo $photographer; ?></span><br/>
        <span class="author-info">Page design by Jon Moss | Editor-in-Chief</span><br/>
      </div>
    </div>

    <div class="section white">
      <div class="container">
        <div class="row">
          <div class="col s12 m11">
            <?php the_content(); ?>
            <br />
            <h4>The latest from Charlotte and the postseason:</h4>
          </div>
        </div>

          <?php
            $stories = new WP_Query();
            $stories->query(array(
              'category_name' => 'Football',
              'date_query' => array(
                array(
                  'after' => 'December 3, 2021',
                  'inclusive' => true,
                ),
              ),
              'nopaging' => true
            ));

            if ($stories->have_posts()) {
              $i = 0;
              while ($stories->have_posts()) {
                $stories->the_post();

                if ($i % 3 == 0) { ?><div class="row"><?php } ?>
                  <div class="col s8 m4">
                    <div class="card">
                      <div class="card-image">
                        <img src="<?php the_post_thumbnail_url('large'); ?>">
                      </div>
                      <div class="card-content">
                        <span class="card-title" style="line-height: inherit"><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                        <br />
                        <?php echo get_the_date('F j, Y'); ?>
                      </div>
                    </div>
                  </div>
                <?php if ($i % 3 == 2) { ?></div> <?php } ?>
              <?php
              $i++;
              }
            }
          ?>

        <div class="row">
          <div class="col s12 m11">
            <h4>Catch up on news from throughout the regular season:</h4>
          </div>
        </div>

          <?php
            $stories = new WP_Query();
            $stories->query(array(
              'category_name' => 'Football',
              'date_query' => array(
                array(
                  'before' => 'December 3, 2021',
                  'after' => 'August 6, 2021',
                  'inclusive' => true,
                ),
              ),
              'nopaging' => true
            ));

            if ($stories->have_posts()) {
              $i = 0;
              while ($stories->have_posts()) {
                $stories->the_post();

                if ($i % 3 == 0) { ?><div class="row"><?php } ?>
                  <div class="col s8 m4">
                    <div class="card">
                      <div class="card-image">
                        <img src="<?php the_post_thumbnail_url('large'); ?>">
                      </div>
                      <div class="card-content">
                        <span class="card-title" style="line-height: inherit"><a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                        <br />
                        <?php echo get_the_date('F j, Y'); ?>
                      </div>
                    </div>
                  </div>
                <?php if ($i % 3 == 2) { ?></div> <?php } ?>
              <?php
              $i++;
              }
            }
          ?>
      </div>
    </div>
  </body>

  <script type="text/javascript">
    $(document).ready(function() {
      $('div[id*="attachment_"]').each((idx, el) => {
        const $el = $(el);
        $el.css({ width: '', 'max-width': '910px' });
      });
    });

    $(window).scroll(function() {
      const scrollTop = $(window).scrollTop();
      if (scrollTop > 300) {
        $("#header-title").addClass('show-title');
      } else {
        $('#header-title').removeClass('show-title');
      }
    });
  </script>
</html>
