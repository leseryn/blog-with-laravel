import $ from 'jquery';
import {createImage} from './resizeimage.js';

let cacheFile ={file:null};
$("body").on("change","input",function(){
	let target = $(this)[0];
	let targetId = target.id;
	// console.log(target);
	// console.log(target.files[0].type);
	if(targetId=="profile-image-upload"){
		
		try{
			document.querySelectorAll("[class*=alert]").forEach(el => el.remove());
  		createImage(target.files[0],'profile-edit-image-preview',cacheFile);
		}catch(error){
			 if(error=="Not Valid Image"){
		  // insert alert
		  let editProfileDiv = document.getElementById("edit-profile-indiv");
		  let msgContainer = document.createElement('div');
		  let msgDiv = document.createElement('div');
		  msgDiv.className = "alert alert-danger";
		  msgDiv.innerHTML = error;
		  editProfileDiv.insertBefore(msgDiv,null);
	    }
		}

	}
});


$("body").on("click","a", function(){
	// console.log( $( this ).attr('id') );
	let targetId = $( this ).attr('id');


	if(targetId=="edit-profile"){
		if($('#edit-profile-div').length){
			// console.log($('#edit-profile-div'));
			$('#edit-profile-div').toggle("normal");
		}else{
			showEditProfile();
		}


	}else if(targetId=="exit-edit"){
		// console.log($("#profile-image-upload"));
		$('#edit-profile-div').toggle("slide");
		// $('#edit-profile-div').remove();


	}else if(targetId=="save-profile" ){
		// console.log(cacheFile);
		let formElement = document.getElementById("profile-edit-form");
		let formData = new FormData(formElement);
		formData.delete('image');
		if(cacheFile.file){
			formData.append('image',cacheFile.file);
		}
		// console.log([...formData]);
		sendDataForm('/user/edit/submit',formData);


	}else if(targetId=="following" ){
		// console.log($(this)[0].name);
		let target =$(this)[0].querySelector('use');
		// console.log(target.href.baseVal);
		let targetStatus =target.href.baseVal;
		// console.log($targetStatus);
		targetStatus=targetStatus.split('#')[1];
		// console.log(targetStatus);
		if(targetStatus=="follow"){
			follow('follow','unfollow',target);
		}else{
			follow('unfollow','follow',target);
		}
		

	}
});

const channel_userfollow = Echo.channel('public.userfollow');
channel_userfollow .subscribed(()=>{
	// console.log('likepost!!');
}).listen('.userfollow',(event)=>{
	// console.log('postid-'+event['postId']);
	let postIdElement = document.getElementById('following');
	postIdElement.querySelector('[name="following-count"]').innerHTML=event['followByCount'];

});

async function follow(status, nextstatus,target){

	try{
		let token = document.querySelector('input[name=_token]');
		if(!token){return;}
		let url = window.location.href + '/' + status;
		// console.log(url)
		let response = await fetch(url,{
			method:'post',
		    headers:{
		    	"X-CSRF-Token": token.value,},
		});
		// console.log(response.status);
		if(response.status=="200"){
			// btn.style="display:none";
			// post.querySelector('[name="like-button-cancel"]').style=null;
			// btn.name="like-button-cancel";
			// console.log(btn.querySelector('use'));
			target.setAttribute("href","/sprite.svg#"+nextstatus);
		}
	}catch(error){
		console.log(error);
	}

}


async function sendDataForm(url, formData){
  try{

      let response = await fetch(url,{
      method:'POST',
      headers:{
        "X-CSRF-Token": document.querySelector('input[name=_token]').value,},
      body:formData,});
// console.log(response.status);
      if(response.status === 200) {
        let data = await response.json();
        // console.log(data);
        location.assign(data);
        // location.assign(document.getElementById('exit').href);
      }
      

      if(response.status === 422) {
        let data = await response.json();
        // console.log(data);

        // remove inserted alert
        document.querySelectorAll("[class*=alert]").forEach(el => el.remove());

        // insert alert
        let editProfileDiv = document.getElementById("edit-profile-indiv");
        let msgContainer = document.createElement('div');
        
        for(let key in data){
        	// console.log(data[key]);
          let msgDiv = document.createElement('div');
          msgDiv.className = "alert alert-danger";
          msgDiv.innerHTML = data[key][0];

          editProfileDiv.insertBefore(msgDiv,null);
        }
      }
      // else{
          // window.location.replace("/blog");}
 
  }catch(error){
    console.error(error);

  }
}

async function showEditProfile(){
	try{
		let url="/user/edit";
		let response = await fetch(url,{
			method:'GET',
			'X-Requested-With': 'XMLHttpRequest'
		});
		// console.log(response.status);
		if(response.status=='200'){
			let data = await response.text();
			$('#user-profile-content').append(data);
			$("#edit-profile-div").toggle("normal");
		}

	}catch($error){
		console.log($error);
	}
}