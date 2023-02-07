import $ from "jquery";
import './likepost.js';
import './postlist_loadpost';
var nextUrl = '/';


$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {

        nextUrl = $('a[rel="next-page"]');
        if(nextUrl.length>0){
            nextUrl = nextUrl[0].href;
            console.log(nextUrl);
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
            // console.log(typeof(response));
            $('.auto-load').hide();
            $("#post-content").append(response);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occured');
        });
}