$(document).ready(function(){
    var colRows = 3;
    var urlBooks = 'books/print';
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            $.ajax({
                url: urlBooks,
                method: 'POST',
                data: {'colRows': colRows},
				success: function(data) {
                var img = $('.books-images img').last();
                $(data).insertAfter(img);
                colRows +=3;
				}
			});
		};
	});
});
