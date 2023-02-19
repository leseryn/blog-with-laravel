import $ from 'jquery';

$( "#search-form" ).hide();
$( "#search-icon" ).click(function() {
  $( "#search-form" ).toggle( "slow" );
});

let users = null;

document.getElementById('search-form').addEventListener('input', function(e){

  let inputVal = document.getElementById('search-form').getElementsByTagName('input')[0].value;
  searchMatch(inputVal);

});
document.body.addEventListener("click",(e)=>{
  
  if(!e.target.closest('.searchdrop')){
    $('.searchdrop-content').remove();
  }
  if(e.target.closest('.searchdrop-user')){
    let userName=$(e.target.closest('.searchdrop-user')).text().replace('@','').trimStart();
    window.location.replace("/"+userName);
  }
  
});

async function searchMatch(inputVal){
  if(!inputVal){
    $('.searchdrop-content').remove();
    return;
  }
  if(users==null){
    try{
      let url = "/blog/search/searchMatch";
      let response = await fetch(url,{
        method:'get',
      });

      if(response.status=="200"){
        let data = await response.json();
        users = data['data'];
        
      }

    }catch(e){
    console.error();
    }
  }

  // console.log(users);
  $('.searchdrop-content').empty();
  let regex = new RegExp("^.*" + inputVal + ".*$", "g");
  let count = 0;
  Object.keys(users).forEach(key => {
   
    let name = users[key].name;
    let found = name.match(regex);
    if(found && count<10){
      if($('.searchdrop-content').length==0){
      $('#search-form').append('<div class="searchdrop-content"></div>'); 
    }
      count += 1;
      $('.searchdrop-content').append('<div class="searchdrop-user p-1"> <img src="'+users[key].profile_image_path
+'" style="border-radius: 50%;width: 3em;">'+'@'+users[key].name+'</div>');        
    }
    
  })
  if(count==0){
    $('.searchdrop-content').remove();
  }
  


  


  
}