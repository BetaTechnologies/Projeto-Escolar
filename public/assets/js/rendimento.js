var abas = window.document.querySelectorAll('.aba');
for (i = 0; i < abas.length; i++) {
    abas[i].onclick = function() {
        for (n = 0; n < abas.length; n++) {
            abas[n].classList.remove('sel');
        }
        this.classList.add('sel');
        viewAba();
    }
}

var containers = window.document.querySelectorAll('.container-aba');
function viewAba() {
    for (i = 0; i < containers.length; i++) {
        containers[i].classList.add('hidden');
    }

    if (abas[0].classList.contains('sel')) {
        containers[0].classList.remove('hidden');
    } else if (abas[1].classList.contains('sel')) {
        containers[1].classList.remove('hidden');
    } else if (abas[2].classList.contains('sel')) {
        containers[2].classList.remove('hidden');
    } else {
        containers[3].classList.remove('hidden');
    }
}