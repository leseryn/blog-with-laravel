// source code from codepen.io
// Copyright (c) 2023 by ferhado (https://codepen.io/ferhado/pen/mdPavvO)

export function createImage(file, previewId,cacheFile) {
  
  let image = document.getElementById(previewId);
  image2base64(file, function (base46) {
    cropImage({
      dataURI: base46,
      type: file.type,
      width: 300,
      height: 300
    }).then(function (response) {
      image.src = response.base46;
      console.log(file.name);
      console.log(response.blob.type);
      cacheFile.file = new File([response.blob],'resize'+file.name,{type:response.blob.type});
    });
  });

}

function cropImage(options) {
  let defaultOptions = {
    dataURI: "",
    width: null,
    height: null,
    startX: null,
    startY: null,
    type: "image/jpeg",
    quality: 0.77
  };

  options = Object.assign(defaultOptions, options);

  return new Promise((resolve) => {
    let { dataURI, width, height, startX, startY, type, quality } = options;
    let image,
      org_w,
      org_h,
      new_w,
      new_h,
      context,
      result,
      canvas = document.createElement("canvas");

    image = new Image();
    image.src = dataURI;

    image.onload = () => {
      org_w = image.naturalWidth;
      org_h = image.naturalHeight;

      if (width && !height) {
        height = (org_h * width) / org_w;
      } else if (height && !width) {
        width = (org_w * height) / org_h;
      } else if (!width && !height) {
        width = org_w;
        height = (org_h * width) / org_w;
      }

      new_w = org_w;
      new_h = height * (new_w / width);

      if (new_h > org_h) {
        let old_h = new_h;
        new_h = org_h;
        new_w = new_w * (new_h / old_h);
      }

      if (startX == null) {
        startX = (org_w - new_w) / 2;
      } else if (startX > org_w - new_w) {
        startX = org_w - new_w;
      } else if (startX < 0) {
        startX = 0;
      }

      if (startY == null) {
        startY = (org_h - new_h) / 2;
      } else if (startY > org_h - new_h) {
        startY = org_h - new_h;
      } else if (startY < 0) {
        startY = 0;
      }

      canvas.width = width;
      canvas.height = height;

      context = canvas.getContext("2d");
      context.drawImage(
        image,
        startX,
        startY,
        new_w,
        new_h,
        0,
        0,
        width,
        height
      );
      result = canvas.toDataURL(type, 0.77);

      resolve({
        base46: result,
        blob: b64toBlob(result, type)
      });
    };
  });
}

function image2base64(file, callback) {
  if (!/image\/(png|jpg|jpeg|gif)/.test(file.type)) throw "Not Valid Image";
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => {
    callback(reader.result);
  };
}

function b64toBlob(dataURI, type) {
  let byteString = atob(dataURI.split(",").pop());
  let ab = new ArrayBuffer(byteString.length);
  let ia = new Uint8Array(ab);
  for (let i = 0; i < byteString.length; i++) {
    ia[i] = byteString.charCodeAt(i);
  }
  return new Blob([ab], { type });
}
