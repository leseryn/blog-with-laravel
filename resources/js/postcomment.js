let lastReplyElement;
document.getElementsByName('reply-comment').forEach(element=>{
	element.addEventListener('click',()=>{

		let replyElementId = element.href.split("#")[1];
		// console.log(replyElementId);

		if(lastReplyElement){
			lastReplyElement.style.display ='none';
		}
		let newReplyElement = document.getElementById(replyElementId);
		newReplyElement.style.display = 'block';
		lastReplyElement = newReplyElement;
	})

})



