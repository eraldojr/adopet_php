function setFileName(){
  document.getElementById("uploadFileName").value = document.getElementById('photo').value;
}

function phoneField(){
  var phone = document.getElementById('phone').value;
  phone = phone.replace(/\D/g,"");
  var n = phone.length;
  if(n > 11){
    phone = phone.slice(0,11);
  }
  if(n>2){
    if(n>7){
      phone = "("+ phone.slice(0,2) + ")" + phone.slice(2,7) + "-" + phone.slice(7,11);
    }else{
      phone =  "("+ phone.slice(0,2) + ")"+phone.slice(2,11);
    }

    document.getElementById('phone').value = phone;
  }
}
