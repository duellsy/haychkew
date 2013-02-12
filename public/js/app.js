$( document ).ready( function() {
	
	$( document ).on('click', "a.archive-link", function( event ) {
		
		event.preventDefault();
		$id = $( this ).attr('data-id');
		$bm = $( this ).closest('.bookmark-block');
		$.ajax({
			url: "/pocket/action/archive/" + $id,
			success: function( data ) {
				$bm.remove();
				$( '#hr-' + $id ).remove();
			}
		});
	
	});


	$( document ).on('click', "a.delete-link", function( event ) {
		
		event.preventDefault();
		$id = $( this ).attr('data-id');
		$bm = $( this ).closest('.bookmark-block');

		$.ajax({
			url: "/pocket/action/delete/" + $id,
			success: function( data ) {
				$bm.remove();
				$( '#hr-' + $id ).remove();
			}
		});
	
	});

		

	$( document ).on('click', "a.favorite-link", function( event ) {
		
		event.preventDefault();
		$id = $( this ).attr('data-id');
		$bm = $( this ).closest('.bookmark-block');
		$.ajax({
			url: "/pocket/action/favorite/" + $id,
			success: function( data ) {
				$bm.removeClass('not-favorite').addClass('favorite');
			}
		});
	
	});

	
	$( document ).on('click', "a.unfavorite-link", function( event ) {
		
		event.preventDefault();
		$id = $( this ).attr('data-id');
		$bm = $( this ).closest('.bookmark-block');
		$.ajax({
			url: "/pocket/action/unfavorite/" + $id,
			success: function( data ) {
				$bm.removeClass('favorite').addClass('not-favorite');
			}
		});
	
	});

});