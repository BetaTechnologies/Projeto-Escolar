var image = document.querySelector('#image');
var inputPass = document.querySelector('#pass');

image.onclick = function() {
    if (inputPass.type == 'password') {
        inputPass.type = 'text';
        image.src = 'assets/images/hide.png';
    } else {
        inputPass.type = 'password';
        image.src = 'assets/images/show.png';
    }
}

var image1 = document.querySelector('#image1');
var inputPass1 = document.querySelector('#pass1');

image1.onclick = function() {
    if (inputPass1.type == 'password') {
        inputPass1.type = 'text';
        image1.src = 'assets/images/hide.png';
    } else {
        inputPass1.type = 'password';
        image1.src = 'assets/images/show.png';
    }
}