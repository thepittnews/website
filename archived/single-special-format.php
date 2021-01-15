<?php
/**
* WP Post Template: Special Post
*/

$credits = explode(" & ", get_post_meta($post->ID, 'writer', true));
$writer = explode(" ", $credits[0]);
$photos = explode(" ", $credits[1]);
?>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-66952241-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-66952241-1');
	</script>

	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@pittnews">
	<meta name="twitter:title" content="<?php the_title(); ?>">
	<meta name="twitter:description" content="<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>">
	<meta name="twitter:creator" content="<?php echo $writer[0] . " " . $writer[1]; ?>">
	<meta name="twitter:image:src" content="<?php $thumb_id = get_post_thumbnail_id(); $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); echo $thumb_url_array[0]; ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400" rel="stylesheet">
	<style>
		#story-title {
			font-size:64px;
			margin-top:40px;
			text-align:center !important;
			font-family:'Source Sans Pro', sans-serif !important;
			font-weight:200;
		}

	  .banner-ad-wrap {
			display:none;
		}

		.parallax-container {
      height: 500px !important;
    }

		#printButton {
			display: none !important;
		}

		.fbcb_container {
			display:none !important;
		}

		#footerAd {
			display:none !important;
		}

		.mailmunch-embedded {
			display:none !important;
		}

		#hideImage {
			display:none;
		}

		.photo-caption {
			display:inline-block;
		}

		#fullImage {
			width:100%;
		}

		#story-extra {
			text-align:center;
			color:darkgray;
			font-family:'Source Sans Pro', sans-serif;
			font-size:22px;
		}

		#___gcse_0 {
			display:none;
		}

		.fullWidthSide {
			height:400px;
		}

		p {
			font-size:18px;
		}

		h6 {
			font-family:'Source Sans Pro', sans-serif;
			font-weight:200 !important;
			text-align:center;
			font-size:32px !important;
			margin:20px !important;
		}

		.inline-img {
			width:40%;
			float:right;
			margin:20px !important;
			padding:0px !important;
			height:auto !important;
		}

		#leftPortrait {
			width:auto;
			max-height:400px;
			float:left !important;
			margin-left:15% !important
		}

		#rightPortrait {
			width:auto;
			max-height:400px;
			float:right;
			margin-right:15% !important;
		}

		#normalFullWidth {
			height:auto !important;
			width:70% !important;
			margin-left: 15% !important;
			margin-right: 15% !important;
		}

		#right {
			float:right;
			margin-right:15px !important;
		}

		#left {
			float:left;
			margin-left:15% !important;
		}

		.wp-caption-text {
			margin-right:15% !important;
			font-style:italic;
		}

		#full-width {
			width:100%;

		}

		.image-contain {
			display:inline;
			width:50%;
		}

		#captioned {
			width:90%;
			margin-bottom:5px !important;
		}

		.caption {
			margin-bottom:10px;
			margin-left:10px;
			display:inline-block;
			width:88%;
			clear:both;
			text-align:center;
			font-style:italic;
		}

		#author-info {
			text-align:center;
		}

		#photographer {
			color:lightGray;
		}

		#tweet {
			float:right;
			display:inline-block;
			width:30px;
			margin-right:25px;
			margin-top:15px;
		}

		#siteTitle {
			color:white;
			font-family:'Source Sans Pro', sans-serif;
			font-weight:100;
			text-align:left;
			margin-left:15px;
		}

		nav {
			background-color:#212121 !important;
			opacity:0.8;
			z-index:100000;
		}

		.parallax-container {
      height: 600px !important;
    }

		#authorButton {
			color:lightGray;
			font-size:18px;
		}

		#authorButton:hover {
			color:black;
		}

		#fullWidthSide {
			width:100%;
			margin:0px !important;
			padding-bottom:25px !important;
		}

		.alignnone {
			max-width:100% !important;
		}

		p {
			margin-left:15%;
			margin-right:15%;
		}

		#date-info {
			margin-left:15%;
		}

		#siteLogo {
			height:40px;
			margin-top:10px;
			margin-left:10px;
		}

		@media only screen and (max-width : 992px) {
 			.wp-caption-text {
				margin:0px !important;
				margin-left:15% !important;
				margin-right:15% !important;
				width:70% !important;
				margin-top:20px;
			}

			#leftPortrait {
				width:70% !important;
				display:block;
				margin-left:15% !important;
				max-height:100000px !important;
			}

			#rightPortrait {
				width:70% !important;
				display:block;
				margin-left:15% !important;
				max-height:100000px !important;
			}

			#right, #left {
				width:70% !important;
			}

			p {
				font-size:18px;
				margin-left:5% !important;
				margin-right:5% !important;
			}
		}
  </style>

	<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	<link href="https://www.pittnews.com/wp-content/themes/theburgh/includes/css/single.css" rel="stylesheet" />
	<script type="text/javascript" src="https://www.pittnews.com/wp-content/themes/theburgh/includes/js/single.js"></script>
</head>

<nav>
  <div class="nav-wrapper">
		<a href="https://pittnews.com">
			<img id="siteLogo" class="left" src="http://pittnews.com/wp-content/uploads/2018/03/TPN-VECTOR-BLUE-small.png">
		</a>
		<a class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" target="_blank">
			<img id="tweet" class="right" src="https://pittnews.com/wp-content/themes/theburgh/includes/img/backlog/tweet.png">
		</a>
	</div>
</nav>

<div class="row" style="margin-bottom:0px;">
	<?php
		$singleCategory = wp_get_post_categories($post->ID);
		global $post;
		$thePostID = $post->ID;
		if(have_posts()) {
			while(have_posts()) {
				the_post();
	?>
	<img style="width:100%;" src="<?php $thumb_id = get_post_thumbnail_id(); $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); echo $thumb_url_array[0]; ?>"></div>

	<title><?php the_title(); ?></title> <?php if ($thePostID == 117224) { echo "<script>window.location.href = 'https://www.pittnews.com/backlog/';</script>"; } ?>
	<h4 id="story-title"><?php the_title(); ?></h4>
	<div style="margin:auto; width: 150px; background-color:gray; height:2px; margin-top:25px; margin-bottom:25px;"></div>
	<p id="story-extra"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>

</div>
</div>

<div class="container">
<div class="row">
	<div class="col s12">

		<?php
			$URL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if (substr_count($URL, "/visual/") == 0) {
				if(has_post_thumbnail()) {
					echo "<div id='hideImage'>";
					the_post_thumbnail('large', array('class' => 'responsive-img'));
					echo "</div>";
					echo "<br/>";
					$imgdata = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
			  }
		  }
		?>
		<div class="hide-on-med-and-up"><br/><br/><br/></div>

		<span id="author-info" class="meta-info">
      <?php
      $combined_writer = $writer[0] . " " . $writer[1];
      echo "<p id='authorButton'>Written by <a style='color: inherit' href='https://pittnews.com/staff/?writer=" . urlencode($combined_writer) . "'>" . $combined_writer . "</a></p>";
      echo '<p id="photographer">Photos by ' . $photos[0] . " " . $photos[1] . "</p>";
			?>
		</span>
		<br/>
		<span id="date-info">
			<?php echo the_date(); ?>
		</span>
		<br/><br/>
		<div id="content-wrap" class="flow-text">
			<?php the_content(); ?>
		</div>
	</div>

	<?php
			}
		}
	?>
</div>
<?php
	//get_footer();
?>
</div>

<script>
$(document).ready(function() {
	$('nav').pushpin({ top: 0 });
	$('.parallax').parallax();

	//$("#fullWidthSide").prepend( "<h2>New heading</h2>" );
});
</script>
