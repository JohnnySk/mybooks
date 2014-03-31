$(document).ready(function() {
    var startFrom = 3;
    $('button.dropdown-toggle').on('click', function(){
        $(this).dropdown();
    });

    $('div.genre-filter ul > li > a').on('click', function(){
        var url = $(this).attr('href');
        var genre = $(this).attr('data');
        $.ajax({
            method: 'POST',
            url: url,
            data: {genre: genre},
            success: function(data){
                var result = $(data).find('div.ajax').html();
                $('div.books-images').html(result);
            }
        });
        return false;
    });

    $(window).scroll(function(){
        if ($(window).scrollTop() + $(window).height() >= $(document).height()){
            $.ajax({
                method: 'POST',
                url: booksUrl,
                data: {start: startFrom},
                success: function(data){
                    var group = $(data).find('div.books-images').html();
                    $('div.books-images').append(group);
                    startFrom += 3;
                }
            });
        }
    });
});
