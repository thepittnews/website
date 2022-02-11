<?php
/**
 * Plugin Name: TPN Extras Plugin
 * Version: 0.1
 * Author: Jon Moss
 */

function tpnextrasplugin_rest_get_custom_fields($object, $field_name, $request) {
  if ($field_name == "writer" || $field_name == "jobtitle") {
    return get_post_meta($object['id'])[$field_name];
  } else if ($field_name == "photographer") {
    return get_post_meta(get_post_thumbnail_id($post_id), 'photographer', true);
  }
}

function tpnextrasplugin_rest_update_custom_fields($value, $object, $field_name, $request) {
  if (! $value) {
    return;
  }

  if ($field_name == "writer") {
    delete_post_meta($object->ID, "writer");
    foreach ($request["writer"] as $writer) {
      add_post_meta($object->ID, "writer", $writer);
    }
  } else {
    return update_post_meta($object->ID, $field_name, $value);
  }
}

function tpnextrasplugin_rest_add_custom_fields() {
  register_rest_field(
  'post',
  'writer',
  array(
    'get_callback'    => 'tpnextrasplugin_rest_get_custom_fields',
    'update_callback' => 'tpnextrasplugin_rest_update_custom_fields',
    'schema'          => null,
     )
  );

  register_rest_field(
  'post',
  'jobtitle',
  array(
    'get_callback'    => 'tpnextrasplugin_rest_get_custom_fields',
    'update_callback' => 'tpnextrasplugin_rest_update_custom_fields',
    'schema'          => null,
     )
  );

  register_rest_field(
  'post',
  'photographer',
  array(
    'get_callback'    => 'tpnextrasplugin_rest_get_custom_fields',
    'update_callback' => 'tpnextrasplugin_rest_update_custom_fields',
    'schema'          => null,
     )
  );
}

add_action('rest_api_init', 'tpnextrasplugin_rest_add_custom_fields');

//[tpnextrasplugin_covid19_cases_chart]
function tpnextrasplugin_shortcode_covid19_cases_chart() {
  return '
<!-- START CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datasource@0.1.0"></script>
<!--<script src="http://pittnews.com/wp-content/plugins/tpn-extras-plugin/casecount-graph.js?ver=1.2"></script>-->
<canvas id="tpn-casecount-graph"></canvas>
<span style="font-weight: 400;"><i>Data collected by The Pitt News. Original data collection by Ryan Yang, Online Visual Editor. Archival data by Spotlight PA and the Philadelphia Inquirer.</i></span>
<span style="font-weight: 400;"><i>Graph by Jon Moss, Editor-in-Chief.</i></span>
<!-- END CHART -->
';
}

//[tpnextrasplugin_charlottechamps_teaser]
function tpnextrasplugin_shortcode_charlottechamps_teaser() {
  return '
<section>
  <div class="widget_text widgetwrap sno-animate already-visible come-in" style="visibility: visible;">
    <div class="textwidget custom-html-widget">
      <div class="sno-widget-style-4-wrap">
        <div class="widget4 widgettitle" role="heading" style="background: #003594;">
          <a href="https://pittnews.com/champs/" target="_blank" rel="noopener" style="text-transform: initial;">Road to ACC Champs: Complete coverage of the historic season</a>
        </div>
      </div>
    </div>
  </div>
</section>
';
}

function tpnextrasplugin_shortcode_newsletterform() {
  return '
<style>
  @media (max-width: 768px) {
    .tpn-newsletter-widget-container {
      margin: auto;
      width: 75vw;
    }

    #tpn-newsletter-widget-cta2 {
      font-size: 1.2em;
    }
  }

  @media (min-width: 768px) {
    .tpn-newsletter-widget-container {
      width: 40%;
      float: right;
    }
  }

  #tpn-newsletter-widget {
    background: #ececec;
    line-height: 30px;
    text-transform: initial;
    color: black;
    font-family: Roboto !important;
    font-weight: 400;
    font-size: 1em;
    line-height: 1.5em;
  }

  #tpn-newsletter-widget .adredux {
    display: none;
  }

  .tpn-newsletter-widget-formwrap {
    display: inline-table;
    vertical-align: middle;
    font-size: 14px;
    font-weight: normal;
    font-family: inherit;
  }

  .tpn-newsletter-widget-cta1 {
    padding-top: 5px !important;
    padding-bottom: 10px;
  }

  .tpn-newsletter-widget-emailinput {
    border: 1px solid #CCC;
    color: rgba(0,0,0,0.75);
    padding: 8px;
    margin-bottom: 15px;
    display: table-cell;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    width: auto;
    position: relative;
    z-index: 2;
    float: left;
    vertical-align: middle;
  }

  .tpn-newsletter-widget-submitwrap {
    width: auto;
    position: relative;
    font-size: 0;
    white-space: nowrap;
    vertical-align: middle;
    display: table-cell;
  }

  .tpn-newsletter-widget-submit {
    z-index: 2;
    margin-left: -1px;
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
    position: relative;
    padding: 8px;
    color: #fff;
    background-color: rgb(31, 132, 200);
    border-color: black;
  }
</style>

<script>
  jQuery(document).on("ready", function() {
    jQuery("#tpn-newsletter-widget-form").submit(function(e) {
      var $form = jQuery("#tpn-newsletter-widget-form");
      e.preventDefault();

      jQuery.ajax({
        type: "POST",
        url: $form.attr("action"),
        data: $form.serialize(),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
          if (data.result != "success") {
            var message = data.msg || "Sorry, unable to subscribe. Please try again later!";
            if (data.msg && data.msg.indexOf("already subscribed") >= 0) {
              message = "You`re already subscribed. Thank you!";
            }
            alert(message);
          } else {
            alert("Thanks for subcribing!");
          }

          jQuery(".tpn-newsletter-widget-emailinput").val("");
        }
      });
    });
  });
</script>

<section class="tpn-newsletter-widget-container">
  <div class="widget_text widgetwrap sno-animate already-visible come-in" style="visibility: visible;">
    <div class="textwidget custom-html-widget">
      <div class="sno-widget-style-4-wrap" style="padding-top: 0px !important;">
        <div class="widget4" id="tpn-newsletter-widget">
          <p class="tpn-newsletter-widget-cta1"><b>Join our newsletter</b></p>
          <div style="padding-bottom: 0px;">
            <p id="tpn-newsletter-widget-cta2">Get Pitt and Oakland news in your inbox, three times a week.</p>
            <div class="tpn-newsletter-widget-formwrap">
              <form id="tpn-newsletter-widget-form" action="https://pittnews.us11.list-manage.com/subscribe/post-json?c=?">
                <input type="hidden" name="u" value="c0117f421e52dd3dc7645e204">
                <input type="hidden" name="id" value="773522d448">
                <input class="tpn-newsletter-widget-emailinput" type="email" name="MERGE0" id="MERGE0" placeholder="Email" autocomplete="email">
                <span class="tpn-newsletter-widget-submitwrap">
                  <input class="tpn-newsletter-widget-submit" type="submit" id="" name="submit" value="Subscribe">
                </span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
';
}

function tpnextrasplugin_shortcode_newsletterform_insert($content) {
  $post_id = get_the_ID();

  if (is_single() && ! is_admin() && get_post_meta($post_id, 'sno_format', true) != 'Long-Form') {
    $newsletter_form = tpnextrasplugin_shortcode_newsletterform();
    $closing_p = '</p>';

    $paragraphs = explode($closing_p, $content);
    $paragraph_id = 4;

    if (count($paragraphs) - 1 > $paragraph_id) {
      if (str_contains($paragraphs[$paragraph_id], 'img')) {
        $paragraph_id = 6;
      }

      foreach ($paragraphs as $index => $paragraph) {
        if (trim($paragraph)) {
          $paragraphs[$index] .= $closing_p;
        }

        if ($index + 1 == $paragraph_id) {
          $paragraphs[$index] .= $newsletter_form;
        }
      }
    }

    return implode('', $paragraphs);
  }

  return $content;
}

function tpnextrasplugin_shortcode_storylink($attrs = [], $content = null, $tag = '') {
  $attrs = array_change_key_case((array) $attrs, CASE_LOWER);

  $post_url = get_permalink($attrs['id']);
  $image_url = get_the_post_thumbnail_url($attrs['id'], 'post-thumbnail');
  $image_caption = get_the_post_thumbnail_caption($attrs['id']);
  $title = get_the_title($attrs['id']);
  $jobtitle = get_post_meta($attrs['id'])['jobtitle'][0];

  $formatted_byline = '';
  $byline = get_post_meta($attrs['id'])['writer'];
  if (count($byline) >= 1) {
    $formatted_byline = $byline[0];
  }

  if (count($byline) == 2) {
    $formatted_byline .= ' and' . $byline[1];
  } else if (count($byline) > 2) {
    for ($i = 1; $i < count($byline) - 1; $i++) {
      $formatted_byline .= ', ' . $byline[$i];
    }

    $formatted_byline .= ' and ' . $byline[count($byline) - 1];
  }

  return '
<style>
  .jm-outer-wrap { margin-left: 5vw; }

  .jm-inner-wrap {
    width: 85%;
    border-radius: 10px;
    background: #f7f7f7;
    margin-bottom: 15px;
    border: 1px solid #f7f7f7;
  }

  .jm-text-wrap {
    margin-top: 10px;
    padding-right: 0px;
    padding-left: 15px;
    padding-bottom: 5px;
  }

  .jm-text-headline {
    font-size: 20px;
    line-height: 24px;
  }

  .jm-text-byline {
    padding-top: 20px;
    padding-bottom: 5px;
    font-weight: 400;
    font-size: 14px;
  }

  .jm-photo-wrap {
    height: auto;
    width: calc(30% - 15px);
    float: left;
    margin-top: 10px;
    margin-left: 15px;
    padding-bottom: 10px;
  }

  .jm-text-wrap-outer {
    color: #000000;
    width: calc(70% - 15px);
    float: left;
    /* height: unset !important; */
  }

  @media (max-width: 768px) {
    .jm-outer-wrap { margin-left: 0; }
    .jm-inner-wrap { width: 100%; }
    .jm-text-wrap { padding-top: 0px; }
    .jm-text-headline { font-size: 18px; }
    .jm-text-byline { display: none; }
  }
</style>

<div class="jm-outer-wrap">
  <a href="' . $post_url . '">
    <div class="sno-story-card fw1-panel jm-inner-wrap">
      <div class="sno-story-card-photo-wrap jm-photo-wrap">
        <img src="' . $image_url . '" alt="' . $image_caption . '">
      </div>
      <div class="sno-story-card-text-wrap jm-text-wrap-outer">
        <div class="sno-story-card-text-area jm-text-wrap">
          <div class="sno-story-card-link jm-text-headline"><span>' . $title . '</span></div>
          <div class="jm-text-byline"><span>By ' . $formatted_byline . ', ' . $jobtitle . '</span></div>
        </div>
      </div>
    </div>
  </a>
</div>
';
}

/**
 * Activate the plugin.
 */
//function tpnextrasplugin_activate() {
tpnextrasplugin_rest_add_custom_fields();

add_shortcode('tpnextrasplugin_covid19_cases_chart', 'tpnextrasplugin_shortcode_covid19_cases_chart');

add_shortcode('tpnextrasplugin_charlottechamps_teaser', 'tpnextrasplugin_shortcode_charlottechamps_teaser');

add_shortcode('tpnextrasplugin_newsletterform', 'tpnextrasplugin_shortcode_newsletterform');
add_filter('the_content', 'tpnextrasplugin_shortcode_newsletterform_insert');

add_shortcode('tpnextrasplugin_storylink', 'tpnextrasplugin_shortcode_storylink');

//}
//register_activation_hook( __FILE__, 'tpnextrasplugin_activate' );
?>
