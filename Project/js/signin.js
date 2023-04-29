var regexusename =  /^[a-zA-Z0-9]+$/;

var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;

var regexemail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

var inputTK=document.querySelector("#taikhoan");
console.log(inputTK);
inputTK.onblur=function(){
    if(regexusename.test(inputTK.value)){
        loiTK=document.querySelector("#loi");
        loiTK.innerText="";
    }
    else{
        loiTK=document.querySelector("#loi");
        loiTK.innerText="Cần ít nhất 8 kí tự gồm chữ và số";
    }
}

var inputMK=document.querySelector("#matkhau");

inputMK.onblur=function(){
    if(regexpass.test(inputMK.value)){
        loiMK=document.querySelector("#loimk");
        loiMK.innerText="";
    }
    else{
        loiMK=document.querySelector("#loimk");
        loiMK.innerText="sai định dạng mật khảu";
    }
}

var inputemail=document.querySelector("#email");

inputemail.onblur=function(){
    if(regexemail.test(inputemail.value)){
        loiemail=document.querySelector("#loiemail");
        loiemail.innerText="";
    }
    else{
        loiemail=document.querySelector("#loiemail");
        loiemail.innerText="sai định dạng email";
    }
}


var inputname = document.querySelector("#ten");
inputname.onblur = function(){
    if(inputname.value.length ==""){
        loiten = document.querySelector("#loiten");
        loiten.innerText="không được để trống";
    }
    else {
        loiten = document.querySelector("#loiten");
        loiten.innerText="";
    }
}







