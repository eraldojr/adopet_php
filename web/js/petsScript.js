function logout(){
  if(isset($_POST['logout']));
}

function setChangePass(){
  document.getElementById('changePass').value = "true";
}

function petDetail(id){
  window.location = "/pet/" + id + "/detalhes";
}
function petShow(id){
  window.location = "/pet/" + id + "/mostrar";
}

function deletePet(id){
  window.location('/pet/' + id + '/excluir');
}

function setFileName(id){
  elem = document.getElementById(id);
  document.getElementById("uploadFileName").value = elem.value;
}

function setFileNameCreate(id){
  elem = document.getElementById(id);
  var _id;
  if(id == "photo1"){
    _id = "uploadFileName1";
  }else if(id == "photo2"){
    _id = "uploadFileName2";
  }else if(id == "photo3"){
    _id = "uploadFileName3";
  }
  document.getElementById(_id).value = elem.value;
}
