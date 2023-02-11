var links = document.querySelectorAll('aside li');

function OpenWindow(aux, tela2) {
    document.querySelector('.escolas').classList.add('hidden');
    document.querySelector('.eventos-noticias').classList.add('hidden');
    document.querySelector('.alunos-docentes').classList.add('hidden');

    if (!tela2) {
        document.querySelector('.requisicoes').classList.add('hidden');
    }

    for (i = 0; i < links.length; i++) {
        links[i].classList.remove('sel');
    }

    switch (aux) {
        case 1:
            document.querySelector('.escolas').classList.remove('hidden');
            break;
        case 2:
            document.querySelector('.eventos-noticias').classList.remove('hidden');
        break;
        case 3:
            document.querySelector('.alunos-docentes').classList.remove('hidden');
        break;
        case 4:
            document.querySelector('.requisicoes').classList.remove('hidden');
        break;
    }

    links[aux-1].classList.add('sel');
}

function OpenAba(container, aux) {
    switch (container) {
        case 1:
            document.querySelector('.eventos-noticias .sel').classList.remove('sel');
            if (aux == 1) {
                document.querySelectorAll('.aba')[0].classList.add('sel');
                document.querySelector('.eventos').classList.remove('hidden');
                document.querySelector('.noticias').classList.add('hidden');
            } else {
                document.querySelectorAll('.aba')[1].classList.add('sel');
                document.querySelector('.eventos').classList.add('hidden');
                document.querySelector('.noticias').classList.remove('hidden');
            }
        break;
        case 2:
            document.querySelector('.alunos-docentes .sel').classList.remove('sel');
            if (aux == 1) {
                document.querySelectorAll('.aba')[2].classList.add('sel');
                document.querySelector('.alunos').classList.remove('hidden');
                document.querySelector('.docentes').classList.add('hidden');
            } else {
                document.querySelectorAll('.aba')[3].classList.add('sel');
                document.querySelector('.alunos').classList.add('hidden');
                document.querySelector('.docentes').classList.remove('hidden');
            }
        break;
    }
}