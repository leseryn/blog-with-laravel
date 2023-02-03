import $ from 'jquery';
import {createImage} from './resizeimage.js';

let cacheFile ={file:null};

$("body").on("click","a", function(){
	console.log( $( this ).attr('id') );
	let $targetId = $( this ).attr('id');
	if($targetId=="edit-profile"){
		if($('#edit-profile-div').length){
			console.log($('#edit-profile-div'));
			$('#edit-profile-div').toggle("normal");
		}else{
			showEditProfile();
		}
	}else if($targetId=="exit-edit"){
		console.log($("#profile-image-upload"));
		$('#edit-profile-div').toggle("slide");
		// $('#edit-profile-div').remove();
	}else if($targetId=="save-profile" ){
		console.log(cacheFile);
		let formElement = document.getElementById("profile-edit-form");
		let formData = new FormData(formElement);
		formData.delete('image');
		if(cacheFile.file){
			formData.append('image',cacheFile.file);
		}
		console.log([...formData]);
		sendDataForm('/user/edit/submit',formData);
	}
});

$("body").on("change","input",function(){
	let target = $(this)[0];
	let targetId = target.id;
	console.log(target);
	console.log(target.files[0].type);
	if(targetId=="profile-image-upload"){
		
  		createImage(target.files[0],'profile-edit-image-preview',cacheFile);

	}
});

async function sendDataForm(url, formData){
  try{

      let response = await fetch(url,{
      method:'POST',
      headers:{
        "X-CSRF-Token": document.querySelector('input[name=_token]').value,},
      body:formData,});

      if(response.status === 200) {
        let data = await response.json();
        location.assign(data);
        // location.assign(document.getElementById('exit').href);
      }
      

      if(response.status === 422) {
        let data = await response.json();
        // console.log(data);

        // remove inserted alert
        document.querySelectorAll("[class*=alert]").forEach(el => el.remove());

        // insert alert
        let editProfileDiv = document.getElementById("edit-profile-div");
        let msgContainer = document.createElement('div');
        for(let key in data){
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
		console.log(response.status);
		if(response.status=='200'){
			let data = await response.text();
			$('#user-profile-content').append(data);
			$("#edit-profile-div").toggle("normal");
		}

	}catch($error){
		console.log($error);
	}
}