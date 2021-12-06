<?php
/**
 * Plugin Name: TPN Extras Plugin
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
          <a href="https://pittnews.com/champs/" target="_blank" rel="noopener">Road to ACC Champs: Complete coverage from Charlotte</a>
        </div>
      </div>
    </div>
  </div>
</section>
';
}

/**
 * Activate the plugin.
 */
//function tpnextrasplugin_activate() {
tpnextrasplugin_rest_add_custom_fields();

wp_enqueue_script('casecount-graph', plugin_dir_url( __FILE__ ) . 'casecount-graph.js', array(), 1.2, false);
add_shortcode('tpnextrasplugin_covid19_cases_chart', 'tpnextrasplugin_shortcode_covid19_cases_chart');

wp_enqueue_script('election2020-maps', plugin_dir_url( __FILE__ ) . 'election2020-maps.js', array(), 1.3, false);

add_shortcode('tpnextrasplugin_charlottechamps_teaser', 'tpnextrasplugin_shortcode_charlottechamps_teaser');
//}
//register_activation_hook( __FILE__, 'tpnextrasplugin_activate' );
?>
