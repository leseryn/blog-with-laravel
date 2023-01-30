import $ from "jquery";
import './likepost.js';

var nextUrl = '/';
// console.log($('a[rel="next"]')[0].href);

$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        nextUrl = $('a[rel="next"]');
        // console.log(nextUrl);
        if(nextUrl[0]){
            nextUrl = nextUrl[0].href;
            infinteLoadMore(nextUrl);
        }
        $('nav[aria-label="Pagination Navigation"]').remove();

    }
});
function infinteLoadMore(url) {
    $.ajax({
            url: url,
            datatype: "html",
            type: "get",
            beforeSend: function () {
                $('.auto-load').show();
                
            }
        })
        .done(function (response) {
            // if (response.length == 0) {
            //     $('.auto-load').html("We don't have more data to display :(");
            //     return;
            // }
            $('.auto-load').hide();
            $("#post-content").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
}