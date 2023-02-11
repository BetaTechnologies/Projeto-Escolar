var images = document.querySelectorAll('.carrousel-image');
var atual = 1;
var percent = 0;

for (i = 0; i < images.length; i++) {
    document.querySelector('.bolls').innerHTML += `<div class="boll"></div>`;
}

var bolls = document.querySelectorAll('.boll');
bolls[0].classList.add('active');

var loop = window.setTimeout(function() {
    next(1);
}, 8000);

function next(n) {
    if (n == 1) {
        if (atual == images.length) {
            percent = 0;
            atual = 1;
        } else {
            percent -= 100;
            atual++;
        }
    } else if (n == -1) {
        if (atual == 1) {
            percent += (images.length - 1) * -100;
            atual = images.length;
        } else {
            percent += 100;   
            atual--;    
        }
    }

    for (i = 0; i < images.length; i++) {
        images[i].style.marginLeft = `${percent}%`;
        bolls[i].classList.remove('active');
    }

    bolls[atual - 1].classList.add('active');

    window.clearTimeout(loop);
    loop = window.setTimeout(function() {
        next(1);
    }, 8000);
}

for (i = 0; i < bolls.length; i++) {
    bolls[i].onclick = function() {
        var aux;
        for (n = 0; n < bolls.length; n++) {
            bolls[n].classList.remove('sel');
        }
        this.classList.add('sel');
        for (n = 0; n < bolls.length; n++) {
            if (bolls[n].classList.contains('sel')) {
                atual = n+1;
                aux = n;
            }
        }
        percent = aux * -100;
        next();
    }
}