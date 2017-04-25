$(function(){
	 // alert('jsWorks');
	
	 var urlArray = [];

	$('#music-btn').click(function(e){
		e.preventDefault();
		var w = window.open("play_tunes.php", 'media', 'height=300,width=350', false);
		return !w;
	});

	// Set initail state of add_link form to hidden
	//$('#links_hidden_div').hide();	
	$('#open-link').click(function() {
		$('#links_hidden_div').toggle(400);		
	});

	//$('#delete_hidden_div').hide();	
	$('#open-delete').click(function() {
		$('#delete_hidden_div').toggle(400);		
	});

	$('#open-skill').click(function() {
		$('#skill_hidden_div').toggle(400);
	})

	// $('#link-list-drp').hide();
	
	// Get urls off of link list, and save for later use.
	
	
	load_random_vid();

	$('.tune-links').each(function(){
		
		$(this).click(function(){
			var i = $(this).attr('id');
			// alert(this.value);
			
			$('#vid-frame').hide(400, function(){
				$('#vid-frame').attr('src', i);	
			}).show(500);
				
			$('#vid-desc').html(this.innerHTML);
		})
	})
	/**
	 * Takes urls rom links, and adds them to an array.
	 * Selects a random numbered link to display on page load
	 */
	function load_random_vid(){

		$('.tune-links').each(function(){
			urlArray.push(this.id);
		});

		// Populate a random video into the player at page load
		var rndLinkNum = Math.floor(Math.random()*urlArray.length);
		$('#vid-frame').attr('src', urlArray[rndLinkNum]);
	}
});