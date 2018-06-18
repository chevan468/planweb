function notifySuccess(message) {
  $.notify(message, {
    position: "bottom center",
    className: "success"
  });
}

function notifyError(message) {
  $.notify(message, {
    position: "bottom center",
    className: "error"
  });
}

function displayFieldError(key, message){

$(key).notify(message, { 
    position:"bottom left",
    className: "error"
  
  });
}


function blockPage(message) {
  $.blockUI({ message: '<h4><img src="../assets/images/loading.gif" /> Espere un momento.. </h4>' }); 
}