(function() {
  tinymce.PluginManager.add('tpnextrasplugin_storylink', function(editor) {
    // Add button to toolbar
    editor.addButton('tpnextrasplugin_storylink', {
      cmd: 'tpnextrasplugin_storylink',
      image: 'https://pittnews.com/wp-content/uploads/2019/04/O_Senior-Editors_via.jpg',
      title: 'Insert TPN storylink'
    });

    // Add shortcode to story
    editor.addCommand('tpnextrasplugin_storylink', function() {
      var result = prompt('Enter the story URL');
      if (!result) return;
      if (result.length === 0) return;

      var match = result.match(/https:\/\/pittnews.com\/article\/(\d+)\/*/);

      if (match === null) {
        alert('Invalid story URL: ' + result);
      } else {
        var storyId = match[1];
        editor.execCommand('mceInsertContent', false, '\n[tpnextrasplugin_storylink id="' + storyId + '"]');
      }
    });
  });
})();
