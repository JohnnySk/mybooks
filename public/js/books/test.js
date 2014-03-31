$(document).ready(function () {
    $('button').bind('click', function() {
        var lastLi = $('ul.test li').last().clone();
        $('ul.test').append(lastLi);
    });
});
