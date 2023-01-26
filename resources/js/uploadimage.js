
// 
// import { FileUploadWithPreview } from 'file-upload-with-preview';
// import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';
// let upload = new FileUploadWithPreview('myUniqueUploadId',{multiple:true});
// 
// let savepostbtn = document.getElementById('btn');
// 
// let result;
// savepostbtn.addEventListener('click', () => {
//   let formElement = document.getElementById('blogpost');
//   let formData = new FormData(formElement);
//   for (var i = upload.cachedFileArray.length - 1; i >= 0; i--) {
//     formData.append('images[]',upload.cachedFileArray[i]);
//   }
// 
//   console.log([...formData]);
//   console.log([formData]);
//   let url = formElement.action;
//   console.log(url);
//       
//   fetch('http://localhost:8000/blog/edit/3/submit', { 
//     method: 'POST',
//     headers: {
//       // "X-Requested-With": "XMLHttpRequest",
//       // "X-CSRF-Token":"{{csrf_token()}}",
//       "X-CSRF-Token": document.querySelector('input[name=_token]').value,
//     },
//     body:formData
//     
//   })
//   .then(response => {
//             return response.json();
//             if(response.status === 422) {
//               return response.json();
//               
//                 
//                 return response.json();
//             }
//             return response.status;
//         }).then(rsp => {
//             console.log(rsp);
//             console.log(rsp.length);
//             for(var key in rsp) {
//               document.getElementById("blogpost").innerHTML = rsp[key][0];
//               console.log(rsp[key][0]);
//             }
// 
//         }).catch(error=>{
//           console.log(error);
//         });
//   
// });




// import $ from 'jquery';
import { FileUploadWithPreview } from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';
let upload = new FileUploadWithPreview('myUniqueUploadId',{
    multiple:true,
    text: {
    browse: 'Choose',
    chooseFile: '...',
    label: 'Images Upload',}
  });

let savepostbtn = document.getElementById('btn');


async function sendDataForm(url, formData){
  try{
      let response = await fetch(url,{
      method:'POST',
      headers:{
        "X-CSRF-Token": document.querySelector('input[name=_token]').value,},
      body:formData,});

      if(response.status === 422) {
        let data = await response.json();
        console.log(data);

        // remove inserted alert
        document.querySelectorAll("[class*=alert]").forEach(el => el.remove());


        let blogpost = document.getElementById("blogpost");
        let msgContainer = document.createElement('div');
        for(let key in data){
          let msgDiv = document.createElement('div');
          msgDiv.className = "alert alert-danger";
          msgDiv.innerHTML = data[key][0];
          blogpost.insertBefore(msgDiv,null);
        }

      }
 

  }catch(error){
    console.error(error);
  }
}


savepostbtn.addEventListener('click', () => {
  let formElement = document.getElementById('blogpost');
  let formData = new FormData(formElement);
  for (let i = upload.cachedFileArray.length - 1; i >= 0; i--) {
    formData.append('images[]',upload.cachedFileArray[i]);
  }
 
  // console.log([...formData]);
  let url = formElement.action;
  // console.log(url);
  sendDataForm(url, formData);
  
});

  
