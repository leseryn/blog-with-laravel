
import $ from'jquery';


let lastReplyElement;
let commentTextTemplateElement = $('div.comment-text')[0].cloneNode(true);
commentTextTemplateElement.id='curr';
// console.log(commentTextTemplateElement);
document.body.addEventListener("keypress",(e)=>{
	if (e.code === 'Enter'&& !e.shiftKey){
		let btnElement = $(e.target).parents('.comment-text')[0];
		btnElement = $(btnElement).find('.btn.m-1')[0];
		// console.log(btnElement);
		submitComment(btnElement);
	}
});


document.body.addEventListener("click",(e)=>{
	// console.log(e.target.className);

	if(e.target.className==="comment-load"){

		let loadLinkElement = e.target;
		let commentDivElement = $(loadLinkElement).parents('.comment-div')[0];
		let lastLoadCommentId = $(commentDivElement).find('.comment')[0];
		let parentCommentId = $(commentDivElement).parents()[0].id.split('-')[1];
		if(!lastLoadCommentId){
			lastLoadCommentId='none';		
		}else{
			lastLoadCommentId=lastLoadCommentId.id.split('-')[1];
		}
		if(!parentCommentId){parentCommentId='none';}
		// console.log(parentCommentId);
		// console.log(lastLoadCommentId);
		let commentType = $(e.target).parents()[0].className;
		loadComment(loadLinkElement,commentType,lastLoadCommentId,parentCommentId);

	}else if(e.target.className==="comment-hide"){
		let hideLinkElement = e.target;
		let hideElement = $(hideLinkElement).parent()[0];
		hideElement = $(hideElement).siblings();
		// console.log($(hideLinkElement).attr('name'));
		if($(hideLinkElement).attr('name')=="hide"){
			$(hideElement).hide();
			$(hideLinkElement).attr('name','show');
			hideLinkElement.innerHTML="show";
		}else{
			$(hideElement).show();
			$(hideLinkElement).attr('name','hide');
			hideLinkElement.innerHTML="hide";
		}
		

	}else if($(e.target.closest('li')).attr('name')=="reply-icon"){

		//if click on reply button, show comment textarea

		let commentDivElement = e.target.closest('.comment');
		$(lastReplyElement).remove();
		location.hash='';
		lastReplyElement = commentTextTemplateElement.cloneNode(true);
		commentDivElement.append(lastReplyElement);
		location.hash='curr';

	}else if($(e.target).attr('name')=="submit-comment"){
		
		submitComment(e.target);

	}else if($(e.target).attr('name')=="delete-comment"){
		
		deleteComment(e.target);

	}

});

async function deleteComment(btnElement){

	let confirmResult = confirm('want to delete comment?');
	if(!confirmResult){
		return;
	}
	let commentElement = $(btnElement).parents('.comment')[0];
	// console.log(commentElement);
	let commentId = commentElement.id.split('-')[1];
	// console.log(commentId);
	let url = '/blog/article/comment-delete/'+commentId;
	try{
		let response = await fetch(url,{
			method:'post',
			headers:{
        		"X-CSRF-Token": document.querySelector('input[name=_token]').value,},
		});
		if(response.ok && response.status=="200"){

			let data = await response.json();
			alert(data);
			commentElement.remove();

		}

	}catch(e){
		console.error();
	}
}

async function submitComment(btnElement){

	// console.log();
	let authcheck = $(btnElement).siblings('[name="authcheck"]')[0];
	if(!authcheck){
		window.location.href = '/login';
		return;
	}

	let parentCommentElement = $(btnElement).parents('.comment');
	let parentCommentDivElement; 
	let parentCommentId = '';

	// no reply to parent comment
	if(parentCommentElement.length==0){
		parentCommentDivElement = $('div.comment-div.main-comment')[0];

	// reply to main-comment
	}else if(parentCommentElement.length==1){
		parentCommentId = $(parentCommentElement[0]).attr('id').split('-')[1];
		parentCommentDivElement = $(parentCommentElement[0]).find('.comment-div')[0];
	
	// reply to reply-comment (actually reply to the parent (main-comment))
	}else{
		parentCommentId = $(parentCommentElement[1]).attr('id').split('-')[1];
		parentCommentDivElement = $(parentCommentElement[1]).find('.comment-div')[0];
	}
	// console.log(parentCommentId);
	// console.log(parentCommentDivElement);

	let postId = $($(btnElement).closest('form')[0]).attr('action').split('/')[3];
	// console.log(postId);

	try{
		let formData = new FormData($(btnElement).parent('form')[0]);
		// console.log([...formData]);
		let url = '/blog/article/'+postId+'/comment/'+parentCommentId;
		// console.log(url);
		let response = await fetch(url,{
			method:'post',
			headers:{
        		"X-CSRF-Token": document.querySelector('input[name=_token]').value,
        		"X-Requested-With": "XMLHttpRequest",},
        	body:formData
		});
		// console.log(response.status);
		if(response.ok){
		// if(response.status==="200"){

			let data = await response.json();
			let currCommentTextElement = $(btnElement).parents('div.comment-text')[0];
			let textarea = $(currCommentTextElement).find('textarea')[0];
			$(textarea).val('');
			$(parentCommentDivElement).append(data['view']);
			// console.log(parentCommentDivElement)
			location.hash = 'comment-'+data['commentId'];
		}else{
			let err = await response.json();
			console.log(err);
		}

		
	}catch(e){
		console.error();
	}
	

}

async function loadComment(loadLinkElement,commentType,lastLoadCommentId,parentCommentId){
	try{
		// console.log(loadLinkElement);
		// console.log(parentCommentId);
		// console.log(lastLoadCommentId);
		let url = "/blog/article/commentload/" + parentCommentId + "/"+lastLoadCommentId;
		// console.log(url);
		let response = await fetch(url,{
			method:'get',
		});
		// console.log(response.status);
		if(response.status=="200"){
			let data = await response.json();
			// console.log(data);
			const parser = new DOMParser();
			$($(loadLinkElement).parent()[0]).after(data['view']);

			// check more page, create new link
			if (!data['hasMorePages']) {
				$(loadLinkElement).hide();
				let hideLinkElement=$(loadLinkElement).siblings()[0];
				$(hideLinkElement).show();
			}
		}



	}catch(e){
		console.error();
	}
}
