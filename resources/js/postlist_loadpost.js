import $ from 'jquery';
let postLoadOn = false;
let currPostLoad = null;

//image slider
let slideIndex = 0
let imgCounts = 0;



document.body.addEventListener("click",(e)=>{
	if($(e.target.closest('a')).attr('name')=="comment-button"){
		let postId = $(e.target).closest('.card.shadow-sm.post-card-content')[0];
		postId = postId.id.split('-')[1];
		// console.log(postId);
		// if($('#post-load-'+postId)[0]){
		// 	currPostLoad = $('#post-load-'+postId)[0];
		// 	$(currPostLoad).show();
		// 	postLoadOn = true;
		// }else{
		loadPost(postId);
		// }
		
	}else if($(e.target.closest('a')).attr('name')=="exit-btn"){
			$(currPostLoad).remove();
			$("body").css({"overflow":"visible"});
			currPostLoad = null;
			postLoadOn = false;
			slideIndex = 0;

	}else if($(e.target).attr('class') && 
    $(e.target).attr('class').match("^slideshow-btn")){
      let btnClass = $(e.target).attr('class');
      if(btnClass=="slideshow-btn slideshow-prev" 
          && slideIndex>0){
          slideIndex -= 1;
          showSlides(slideIndex);

      }else if(btnClass=="slideshow-btn slideshow-next" 
        && slideIndex<imgCounts-1){
          slideIndex += 1;
          showSlides(slideIndex);
      }

}
});
function showSlides(slideIndex) {
  console.log(slideIndex);console.log('slideIndex');
  let slides = $('.slides');
  $(slides).hide();
  $(slides[slideIndex]).show();

}
async function loadPost(postId){
	try{
		let url = "/blog/article/"+postId;
		// console.log(url)
		let response = await fetch(url, {
		      headers: {
		        "X-Requested-With": "XMLHttpRequest",},
		      method: "get",
		    })
		let data = await response.json();
		// console.log(data['view']);
		let contentDivElement = document.getElementById('post-content');
		// console.log(contentDivElement);
		// console.log($('contentDivElement'));
		console.log('sdfsdfsdff');
		console.log($('body')[0]);
		// $($('body')[0]).prepend(data['view']);
		// console.log();
		// $(data['view']).css()
		$(data['view']).insertAfter($($('nav')[0]));
		$('body').css({"overflow":"hidden"});
		// $(contentDivElement).append(data['view']);
		currPostLoad = $('#post-load-'+postId)[0];
		postLoadOn = true;
imgCounts = $($('.slideshow-container')[0]).data('image-count');
showSlides(slideIndex);
	}catch(e){
		console.error(e);
	}
}