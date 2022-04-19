<?php
/**
* WP Post Template: Silhouettes
*/

$writers = get_post_meta($post->ID, 'writer', false);
$names = array();
$formatted_writers = "";

foreach($writers as $writer) {
  $writer_profile = term_exists($writer, 'staff_name');
  if ($writer_profile !== null) {
    $writer_link = get_term_link((int)$writer_profile['term_id'], 'staff_name');
    $names[] = "<a style='color: inherit; text-decoration: underline;' href='" . $writer_link . "'>" . $writer . "</a>";
  } else {
    $names[] = $writer;
  }
}

$count = count($names);
if ($count == 1) {
  $formatted_writers .= $names[0];
} else if ($count == 2) {
  $formatted_writers .= $names[0] . " and " . $names[1];
} else {
  $i = 0;

  foreach($names as $name) {
    $i++;

    if ($i == $count) {
      $formatted_writers .= $name;
    } else if ($i < $count - 1) {
      $formatted_writers .= $name . ", ";
    } else if ($i < $count) {
      $formatted_writers .= $name . ", and ";
    }
  }
}

$thumbnail_id = get_post_thumbnail_id($post->ID);
$thumbnail = wp_get_attachment_image_src($thumbnail_id, 'full');
$photographer = explode(" | ",get_post_meta($thumbnail_id, 'photographer', true))[0];
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
    <meta property="og:title" content="<?php the_title(); ?>" />
    <meta property="og:description" content="<?php the_excerpt() ?>" />
    <meta property="og:url" content="<?php the_permalink() ?>" />
    <meta property="og:site_name" content="The Pitt News" />
    <meta property="article:publisher" content="https://www.facebook.com/thepittnews/" />
    <meta property="article:published_time" content="<?php echo the_date('c'); ?>" />
    <meta property="article:modified_time" content="<?php echo the_modified_date('c'); ?>" />
    <meta property="og:image" content="<?php echo $thumbnail[0] ?>" />
    <meta property="og:image:width" content="<? echo $thumbnail[1] ?>" />
    <meta property="og:image:height" content="<? echo $thumbnail[2] ?>" />
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
        /*background-color: rgba(0, 0, 0, 0);*/
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

      .author-info, #date-info {
        font-family: 'Oswald', sans-serif;
        font-size: 20px;
      }

      #date-info {
        font-weight: 300;
        font-size: 18px;
      }

      /* ** QUOTES ** */
      .show-quote {
        right: 0px !important;
        transition: right 1s ease-out, border-left 2s ease-in;
        border-left: 5px solid #5ca0c3 !important;
      }

      blockquote {
        font-family: 'Merriweather', serif;
        font-weight: 900;
        border-left: 5px solid white;

        float: right;
        max-width: 250px;
        font-weight: bold;
        padding: 13px;
        margin: 0 13px 13px 10px;
      }

      .inline-quote {
        border-left: 5px solid #5ca0c3 !important;
        display: block !important;
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

      p:first-child:first-letter {
        float: left;
        font-size: 75px;
        line-height: 60px;
        padding-top: 4px;
        padding-right: 8px;
        padding-left: 3px;
      }

      .header-image {
        width: 100%;
        height: 100vh;
        object-fit: cover;
        object-position: top center;
      }

      figure.wp-caption { margin: 0 auto !important; text-align: center !important; }
      .aligncenter { margin: 0 auto; text-align: center; }
      .wp-caption-text { font-style: italic; }
      img.size-large { height: auto; width: 100% }

      .silhouettes-teaser {
        text-decoration: underline;
        font-weight: 900;
        font-family: 'Merriweather', serif;
        color: white;
        font-size: 24px;
      }

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
        /*#story-title { top: -225px !important; } Believe this is duplicitous */
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

    <img class="header-image" src="<?php echo $thumbnail[0]; ?>" />

    <div class="section white">
      <h4 id="story-title"><?php the_title(); ?></h4>

      <div class="container">
        <span class="author-info">Written by <?php echo $formatted_writers; ?></span><br/>
        <span class="author-info"><?php echo (strpos($photographer, "ourtesy") ? "Courtesy photos" : "Photos by " . $photographer); ?></span><br/>
        <span id="date-info"><?php echo get_the_date('F d, Y', $post->ID); ?></span>
      </div>
    </div>

    <div class="section white">
      <div class="container">
        <div class="row">
          <div class="col s12 m11">
            <?php echo do_shortcode(wpautop(get_the_content())); ?>
            <div class="card card-small blue-grey darken-1">
              <div class="card-content white-text">
                <a class="silhouettes-teaser" href="https://pittnews.com/silhouettes/">Read more silhouettes from The Pitt News</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script type="text/javascript">
    $(document).ready(function() {
      $('blockquote.inline-quote').each((idx, el) => {
        //const $el =  $(el);
        //const elText = $el.text();
        //const elStyle = $el.data('style');
        //const blockquoteColumn = $el.parent().siblings()[0];

        //$el.html(elText);
      });

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

      $("blockquote[class!='inline-quote']").each((idx, el) => {
        var $el = $(el);
        if (scrollTop > $el.offset().top - 600) {
          $el.addClass('show-quote');
        }
      });
    });
  </script>
</html>
