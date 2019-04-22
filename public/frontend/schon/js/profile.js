var previewNode = document.querySelector(".template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var uploadPicture = new Dropzone('#btn-browse', { 
  url: SITE_URL + '/user/profile/upload',
  thumbnailWidth: 400,
  thumbnailHeight: 400,
  parallelUploads: 1,
  maxFiles: 1,
  previewTemplate: previewTemplate,
  previewsContainer: '.preview',
  clickable: '#btn-browse, #btn-browse > i',
  acceptedFiles: '.jpg',
  params: { _token:  $('meta[name="csrf-token"]').attr('content')},

});

uploadPicture.on('addedfile', function(file) {

  if (file.type != 'image/jpeg'){
    show_notification('Kesalahan', 'error', 'Format tidak di dukung');
    uploadPicture.removeFile(file);
    console.log(file.type);
  }

  else if (file.size >= 1000000){
    show_notification('Kesalahan', 'error', 'Berkas terlalu besar');
    uploadPicture.removeFile(file);
    console.log(file.size);
  }
  else{
    $('#img-profile').hide();
    //on_upload();
    console.log(file);
  }

});

uploadPicture.on('success', function(file, response) {
  $('[name="old_pic"]').val(response);
  $('.progress-wrapper').hide();
});

uploadPicture.on('error', function(xhr, status, error) {
    if (error != undefined) {
      show_notification('Error', 'error', error.statusText);
      uploadPicture.removeAllFiles();
    }
});

uploadPicture.on('sending', function(file, xhr, formData) {
  formData.append('old_pic', $('[name="old_pic"]').val());
});

uploadPicture.on('success', function(file, response) {
  show_notification(response.title, response.type, response.message);
  uploadPicture.removeAllFiles();
  $('#img-profile').attr('src', SITE_URL + '/uploads/thumbs/' + response.avatar);
  $('[name="old_pic"]').val(response.old_pic);
  $('#img-profile').show();
});