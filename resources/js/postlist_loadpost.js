import $ from 'jquery';
let postLoadOn = false;
let currPostLoad = null;
document.body.addEventListener("click",(e)=>{
	if($(e.target.closest('a')).attr('name')=="comment-button"){
		let postId = $(e.target).closest('.card.shadow-sm.post-card-content')[0];
		postId = postId.id.split('-')[1];
		// console.log(postId);
		if($('#post-load-'+postId)[0]){
			currPostLoad = $('#post-load-'+postId)[0];
			$(currPostLoad).show();
			postLoadOn = true;
		}else{
			loadPost(postId);
		}
		
	}else if(postLoadOn && !$(e.target).closest('.post-load')[0]
		){
			$(currPostLoad).hide();
			currPostLoad = null;
			postLoadOn = false;
	}
});

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
		$(contentDivElement).append(data['view']);
		currPostLoad = $('#post-load-'+postId)[0];
		postLoadOn = true;
		// console.log($('#post-load-'+postId)[0]);
		// $(contentDivElement).prepend('<h1>wwww</h1>')
		// $(data['view']).insertBefore(contentDivElement);
	}catch(e){
		console.error(e);
	}
}