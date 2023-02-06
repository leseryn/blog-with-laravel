import $ from 'jquery';
let slideIndex = 0
let imgCounts = $($('.slideshow-container')[0]).data('image-count');
showSlides(slideIndex);

document.body.addEventListener("click",(e)=>{

  if($(e.target).attr('class') && 
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


export function showSlides(slideIndex) {
  console.log(slideIndex);console.log('slideIndex');
  let slides = $('.slides');
  $(slides).hide();
  $(slides[slideIndex]).show();

}
