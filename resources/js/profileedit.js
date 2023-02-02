import $ from 'jquery';


console.log($("#edit-profile"));
$("#edit-profile").click(function(){
 		console.log($(this).attr('name'));

 		// showEditProfile($(this).href);
});


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
		$('#edit-profile-div').toggle("slide");
		// $('#edit-profile-div').remove();
	}

});

async function showEditProfile(){
	try{
		let url="/user/edit";
		let response = await fetch(url,{
			method:'GET'
		});
		console.log(response.status);
		if(response.status=='200'){
			let data = await response.text();
			
			$('#user-profile-content').append(data);
			$("#edit-profile-div").toggle("normal");
// 
//             $( "#search-form" ).hide();
// 			$( "#search-icon" ).click(function() {
// 			  $( "#search-form" ).toggle( "slow" );
// 			});

		}

	}catch($error){
		console.log($error);
	}
}