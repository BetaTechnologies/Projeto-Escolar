var links = window.document.querySelectorAll('aside li');

function OpenWindow(aux) {
    for (i = 0; i < links.length; i++) {
        links[i].classList.remove('sel');
    }
    
    switch (aux) {
        case 1:
            links[0].classList.add('sel');
            document.querySelector('.faltas').classList.remove('hidden');
            document.querySelector('.notas').classList.add('hidden');
            break;
            case 2:
                links[1].classList.add('sel');
                document.querySelector('.faltas').classList.add('hidden');
                document.querySelector('.notas').classList.remove('hidden');
        break;
    }
}