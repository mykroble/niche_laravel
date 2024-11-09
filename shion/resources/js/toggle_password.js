function toggleEye(x){
    // alert("clicked" + x);
    if(x == 1){
        eye = document.getElementById("pword");
        eyeImg = document.getElementById("eye_toggle_1");
    } else if(x == 2){
        eye = document.getElementById("re_pword");
        eyeImg = document.getElementById("eye_toggle_2");
    }
    // alert(eye.type);
    if(eye.type == "text"){
        eye.type = "password";
        eyeImg.src = "css/registration_pics/eye_closed.svg";
    } else if(eye.type == "password"){
        eye.type = "text";
        eyeImg.src = "css/registration_pics/eye_open.svg";
    }
}