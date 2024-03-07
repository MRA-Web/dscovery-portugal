function menuShow() {
    let menuMobile = document.querySelector('.mobile-menu');
    if (menuMobile.classList.contains('open')) {
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "/site/assets/mobile-icons/menu_white_36dp.svg";
    } else {
        menuMobile.classList.add('open');
        document.querySelector('.icon').src = "/site/assets/mobile-icons/close_white_36dp.svg";
    }
}

function jogar_texto(doc_origem, id_destino) {
    // fetch para buscar o conteúdo do header.html
    fetch(doc_origem)
        .then(response => response.text())
        .then(data => {
            // Colocando o conteúdo dentro do elemento com id de destino
            document.getElementById(id_destino).innerHTML = data;
        });
}

function teste(){
    console.log("apenas um teste");
}