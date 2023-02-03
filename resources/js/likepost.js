
// window.onclick = e => {
//     console.log(e.target.closest('.btn'));
//     console.log(e.target.closest('.card'));
//     let $btn = e.target.closest('.btn');
//     let $postIdCol = e.target.closest('.card');
// } 

document.body.addEventListener("click",(e)=>{
	// console.log(e.target.closest('.btn'));
	// console.log(e.target.closest('.card'));
	
	let btn = e.target.closest('.btn');
	// console.log(btn);
	if(btn && btn.name==="like-button"){
		let post = e.target.closest('.card');
		likePost(btn, post);
	}
	if(btn && btn.name==="like-button-cancel"){
		let post = e.target.closest('.card');
		cancelLikePost(btn, post);
	}


});


async function likePost(btn,post){
	try{
		let token = document.querySelector('input[name=_token]');
		if(!token){return;}
		let postId = post.id.split('-')[1];
		let url = "/blog/article/" + postId + "/like";
		let response = await fetch(url,{
			method:'post',
		    headers:{
		    	"X-CSRF-Token": token.value,},
		});
		// console.log(response.status);
		if(response.status=="200"){
			// btn.style="display:none";
			// post.querySelector('[name="like-button-cancel"]').style=null;
			btn.name="like-button-cancel";
			// console.log(btn.querySelector('use'));
			btn.querySelector('use').setAttribute("href","/sprite.svg#heart-fill-icon");
		}
	}catch(error){
		console.log(error);
	}
}

async function cancelLikePost(btn,post){
	try{
		let postId = post.id.split('-')[1];
		let url = "/blog/article/" + postId + "/cancel-like";
		let response = await fetch(url,{
			method:'post',
		    headers:{
		    	"X-CSRF-Token": document.querySelector('input[name=_token]').value,},
		});
		// console.log(response.status);
		if(response.status=="200"){
			// btn.style="display:none";
			// post.querySelector('[name="like-button"]').style=null;

			btn.name="like-button";
			btn.querySelector('use').setAttribute("href","/sprite.svg#heart-icon");

		}
	}catch(error){
		console.log(error);
	}
}


const channel_likepost = Echo.channel('public.likepost');
channel_likepost .subscribed(()=>{
	// console.log('likepost!!');
}).listen('.likepost',(event)=>{
	// console.log('postid-'+event['postId']);
	let postIdElement = document.getElementById('postid-'+event['postId']);
	postIdElement.querySelector('[name="like-button-count"]').innerHTML=event['likes'];

});
