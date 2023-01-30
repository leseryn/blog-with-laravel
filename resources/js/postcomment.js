// let lastReplyElement;
// document.getElementsByName('reply-comment').forEach(element=>{
// 	element.addEventListener('click',()=>{
// 
// 		let replyElementId = element.id.split("#")[1];
// 		console.log(replyElementId);
// 		replyElementId=replyElementId+'-reply';	
// 		if(lastReplyElement){
// 			lastReplyElement.style.display ='none';
// 		}
// 		let newReplyElement = document.getElementById(replyElementId);
// 		newReplyElement.style.display = 'block';
// 		lastReplyElement = newReplyElement;
// 	})
// 
// })

let lastReplyElement;
document.body.addEventListener("click",(e)=>{

	let btn = e.target.closest('.list-inline-item');

	if(btn && btn.querySelector('a')&& btn.querySelector('a').name=="reply-comment"){
		let commentId = e.target.closest('.comment').id.split("-")[1];
		let replyElementId = "comment-"+commentId+"-reply";

		if(lastReplyElement){
			lastReplyElement.style.display ='none';
		}
		
		let newReplyElement = document.getElementById(replyElementId);
		newReplyElement.style.display = 'block';
		lastReplyElement = newReplyElement;
	}

});
