<script>
// Function to load and initiate the Analytics tracker
function gaTracker(id){
  $.getScript('//www.google-analytics.com/analytics.js'); // jQuery shortcut
  window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
  ga('create', id, 'auto');
  ga('send', 'pageview');
}
<?php /*
// If you are not using jQuery, replace $.getScript() line above with the following:
var script = document.createElement('script');
script.src = '//www.google-analytics.com/ga.js';
document.getElementsByTagName('head')[0].appendChild(script);
*/ ?>

// Function to track a virtual page view
function gaTrack(path, title) {
  ga('set', { page: path, title: title });
  ga('send', 'pageview');
}

// Initiate the tracker after app has loaded
gaTracker('UA-XXXX-Y');

<?php /*
// Track a virtual page
gaTrack('/silence/golden/', 'Silence is Golden');

// If you don't need to set page path and title, skip the _gaTracker function, and use the native analytics page tracker instead:
ga('send', 'pageview')

// Track an image click event
ga('send', 'event', 'image', 'click', 'image click', 'filename.jpg');
// ga('send', 'event', 'category', 'action', 'label', 'value');

*/ ?>

function gaEventTrack(eventCat, eventAction, eventLabel, eventVal ) {
	ga('send', 'event', eventCat, eventAction, eventLabel, eventVal);
	//ga('send', 'event', 'category', 'action', 'label', 'value');
}

jQuery('a').bind('click', function () {
	var url = jQuery(this).attr('href');
	var fileName= url.split('/').pop();
	gaEventTrack('link', 'click', 'link click', fileName);
});

//gaEventTrack('type-image', 'click', 'image click', 'filename.jpg');

</script>