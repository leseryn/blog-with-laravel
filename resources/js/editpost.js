// import $ from 'jquery';
import { FileUploadWithPreview } from 'file-upload-with-preview';
import 'file-upload-with-preview/dist/file-upload-with-preview.min.css';


let upload = new FileUploadWithPreview('myUniqueUploadId',{
    multiple:true,
    // presetFiles:oldImagesArr,
    text: {
    browse: 'Choose',
    chooseFile: '...',
    label: 'Images Upload',}
  });

let oldImages = document.getElementsByName('oldImages');
let oldImagesArr = [];
for (let i = oldImages.length - 1; i >= 0; i--) {

  addPresetFiles(oldImages[i].dataset.filename,
    oldImages[i].dataset.imagepath);
}

async function addPresetFiles(filename,path) {
      try {
        let defaultType = 'image/jpeg';
        let response = await fetch(path, { mode: 'cors' });
        let blob = await response.blob();
        let file = new File([blob], filename+':preset-file', {
          type: blob.type || defaultType,
        });
        // this.addFiles([file]);
        upload.cachedFileArray.push(file);
        upload.addFileToPreviewPanel(file);
      } catch (error) {
        if (error instanceof Error) {
          console.warn(`${error.message.toString()}`);
        }
        console.warn('Image cannot be added to the cachedFileArray.');
      }
  }


let savepostbtn = document.getElementById('savepost');
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
        let blogpost = document.getElementById("blogpost");
        let msgContainer = document.createElement('div');
        for(let key in data){
          let msgDiv = document.createElement('div');
          msgDiv.className = "alert alert-danger";
          msgDiv.innerHTML = data[key][0];
          blogpost.insertBefore(msgDiv,null);
        }
      }
      // else{
          // window.location.replace("/blog");}
 
  }catch(error){
    console.error(error);
  }
}

savepostbtn.addEventListener('click', () => {
console.log(upload);
  let formElement = document.getElementById('blogpost');
  let formData = new FormData(formElement);
  for (let i = upload.cachedFileArray.length - 1; i >= 0; i--) {
    formData.append('images[]',upload.cachedFileArray[i]);
  }
 console.log(upload.cachedFileArray.length);
  console.log([...formData]);

  let url = formElement.action;
  console.log(url);

  sendDataForm(url, formData);
  
});

// 
