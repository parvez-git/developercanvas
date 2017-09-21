jQuery(document).ready(function($){
    
	// THEATERJS
	var theater = theaterJS();

  theater
    .on('type:start, erase:start', function () {
      var actor = theater.getCurrentActor();
      actor.$element.classList.add('is-typing');
    })
    .on('type:end, erase:end', function () {
      var actor = theater.getCurrentActor();
      actor.$element.classList.remove('is-typing');
    });

  theater
    .addActor('planguage');

  theater
	.addScene('planguage:in ')
	.addScene('WordPress.')
	.addScene(1800)
	.addScene(-10)
	.addScene(1800)
	.addScene('Laravel.')
	.addScene(1800)
	.addScene(theater.replay);
		
});