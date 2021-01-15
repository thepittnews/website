<?php

$writer = get_post_meta($post->ID, 'writer', true);
$writer_position = get_post_meta($post->ID, 'jobtitle', true);
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
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	@import url('https://fonts.googleapis.com/css?family=EB+Garamond|Montserrat:300|Open+Sans');

	nav {
		background-color:#212121 !important;
		opacity:0.8;
		z-index:100000;
		height: 60px;
	}

	.story-title {
		font-size:64px;
		margin-top:40px;
		text-align:center !important;
		font-family:'EB Garamond', serif !important;
	}

	.story-extra {
		text-align:center;
		color:darkgray;
		font-family:'Open Sans', sans-serif;
		font-size:22px;
	}

	.writer {
		text-align: center;
		font-family: 'Montserrat', sans-serif;
		font-size: 18px;
		color: darkgray;
	}

	.date-info {
		text-align: center;
		font-family: 'Montserrat', sans-serif;
		font-size: 18px;
		color: lightgray;
	}

	img {
		height:auto !important;
	}

	#siteLogo {
		height: 100%;
		max-height:40px;
		margin-top:10px;
		margin-left:10px;
	}

	.content-container {
		width: 100%;
		margin: auto;
	}

	.content-container p {
		font-family: "Open Sans", sans-serif;
		font-size: 18px;
	}

	@media (min-width: 768px) {
		.content-container {
			width: 80%;
		}
	}

	.WD_Mobile_Leaderboard_Ad {
		display: none;
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



</style>

<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

<link href="https://www.pittnews.com/wp-content/themes/theburgh/includes/css/single.css" rel="stylesheet" />
<script type="text/javascript" src="https://www.pittnews.com/wp-content/themes/theburgh/includes/js/single.js"></script>
</head>
<body>
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
<div class="header-container">
	<div class="custom-header-container">
		<title><?php the_title(); ?></title>
		<h1 class="story-title"><?php the_title(); ?></h1>
		<p class="story-extra"><?php echo get_post_meta($post->ID, 'sno_teaser', true); ?></p>
		<p class="writer">Story by <a href="#"><?php echo $writer . ' | ' . $writer_position ?></a></p>
		<p class="date-info"><?php echo the_date(); ?></p>
	</div>
</div>

<div class="container">
	<div class="content-container">
		<?php the_content(); ?>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('nav').pushpin({
			top: 0
		});
		$('.parallax').parallax();
	});
</script>
