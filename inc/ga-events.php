<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-11127289-27', 'auto');
    ga('create', 'UA-73797442-3', 'auto', 'kingTracker');

	function createFunctionWithTimeout(callback, opt_timeout) {
	  var called = false;
	  function fn() {
		if (!called) {
		  called = true;
		  callback();
		}
	  }
	  setTimeout(fn, opt_timeout || 1000);
	  return fn;
	}


jQuery(document).ready(function(e) {
    var $ = jQuery;

    ga('kingTracker.send', 'pageview');
    ga('send', 'pageview');

    // Sched Button GAE
    $('.sched-link-gae').bind('click', function(event) {
        //console.log("GA EVT Click");
        event.preventDefault();
        
        var target = $( event.target );
        var linkUrl = $(target).attr("href");

        
        ga('kingTracker.send', 'event', { 
            eventCategory: 'Schedule Button', 
            eventAction: 'Click', 
            eventLabel: 'Click Lead', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                //This will make sure that the GA info is sent before going to other page
                //console.log("Redirected to: " + linkUrl);
                window.location.href = linkUrl;
            }) 
        });
        
        ga('send', 'event', { 
            eventCategory: 'Schedule Button', 
            eventAction: 'Click', 
            eventLabel: 'Click Lead', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                window.location.href = linkUrl;
            }) 
        });

    });
    
    $form_schedule_service = $('#gform_6');
    $form_schedule_service.bind('submit', function(event) {
        var formId = this.id,
            form = this;
        event.preventDefault();

        
        ga('kingTracker.send', 'event', { 
            eventCategory: 'Schedule Service Form Submit', 
            eventAction: 'Click Submit', 
            eventLabel: 'Submit', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                form.submit();
            }) 
        });
        ga('send', 'event', { 
            eventCategory: 'Schedule Service Form Submit', 
            eventAction: 'Click Submit', 
            eventLabel: 'Submit', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                form.submit();
            }) 
        });
        
    });
    
    
    

    // Free Estimate Button GAE
    $('.free-estimate-link-gae').bind('click', function(event) {
        //console.log("GA EVT Click");
        event.preventDefault();
        
        var target = $( event.target );
        var linkUrl = $(target).attr("href");

        
        ga('kingTracker.send', 'event', { 
            eventCategory: 'Free Estimate Button', 
            eventAction: 'Click', 
            eventLabel: 'Click Lead', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                window.location.href = linkUrl;
            }) 
        });
        
        ga('send', 'event', { 
            eventCategory: 'Free Estimate Button', 
            eventAction: 'Click', 
            eventLabel: 'Click Lead', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                window.location.href = linkUrl;
            }) 
        });

    });
    
    
    
    $form_free_estimate = $('#gform_7');
    $form_free_estimate.bind('submit', function(event) {
        var formId = this.id,
            form = this;
        event.preventDefault();

        
        ga('kingTracker.send', 'event', { 
            eventCategory: 'Send - Free Estimate Form', 
            eventAction: 'Click Send', 
            eventLabel: 'Send', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                form.submit();
            }) 
        });
        ga('send', 'event', { 
            eventCategory: 'Send - Free Estimate Form', 
            eventAction: 'Click Send', 
            eventLabel: 'Send', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
                form.submit();
            }) 
        });
        
    });
    
    
    /* Contact Form GAE */
    
    $contact_form = $('#gform_1');
    $contact_form.bind('submit', function(event) {
        var formId = this.id,
            form = this;
        event.preventDefault();
        
        ga('send', 'event', { 
            eventCategory: 'Contact Page Submit', 
            eventAction: 'Click Submit', 
            eventLabel: 'Submit', 
            eventValue: 1, 
            hitCallback: createFunctionWithTimeout(function () {
        
                ga('kingTracker.send', 'event', { 
                    eventCategory: 'Contact Page Submit', 
                    eventAction: 'Click Submit', 
                    eventLabel: 'Submit', 
                    eventValue: 1
                });
                form.submit();
            }) 
        });
        
    });
    
    
    
    
    $('.video-play-gae').bind('click', function() {
        ga('kingTracker.send', 'event', 'Videos', 'play', 'Air Purification Video');
    });
    
    $('.why-ss-video-gae').bind('click', function() {
        ga('kingTracker.send', 'event', 'Video', 'play', 'Why SS Video');
    });

});

</script>