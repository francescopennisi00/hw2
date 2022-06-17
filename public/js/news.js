function onNotiziaJson(json) {

    //stampo il json ricevuto in console
    console.log(json);

    //salvo i dati del json in delle variabili
    const data_pubblicazione = json.data_pubblicazione;
    const fonte = json.fonte;
    const immagine = json.immagine;
    const informazione = json.informazione;
    const ora_pubblicazione = json.ora_pubblicazione;
    const titolo = json.titolo;

    //modifico il titolo della pagina
    const title = document.querySelector("title");
    title.textContent = titolo;

    //mostro i contenuti nella pagina

    const h1_titolo = document.createElement("h1");
    h1_titolo.id = "titolo";
    h1_titolo.textContent = titolo;

    const sezionePrincipale = document.querySelector("#main");
    sezionePrincipale.appendChild(h1_titolo);

    const blocco_img = document.createElement("div");
    blocco_img.id = "blocco_img";

    const img = document.createElement("img");
    img.src = immagine;
    blocco_img.appendChild(img);

    const p = document.createElement('p');

    const em_data = document.createElement("em");
    em_data.textContent = data_pubblicazione + ", " + ora_pubblicazione;
    p.appendChild(em_data);

    const em_autore = document.createElement("em");
    em_autore.textContent = "di ";

    const autore = document.createElement("strong");
    autore.textContent = fonte;
    em_autore.appendChild(autore);

    p.appendChild(em_autore);

    blocco_img.appendChild(em_autore);

    sezionePrincipale.appendChild(blocco_img);

    const testo = document.createElement("div");
    testo.id = "text";
    testo.textContent = informazione;
    sezionePrincipale.appendChild(testo);

}

function onResponse(response) {
    return response.json();
}

function mostraNotizia() {
    const sezione = document.querySelector("#main");
    const id_notizia = sezione.dataset.idNotizia;

    fetch(BASE_URL + "/news/show/"+encodeURIComponent(id_notizia)).then(onResponse).then(onNotiziaJson); 
}

//mostro la notizia all'apertura della pagina (cambiando anche il titolo della web page)
mostraNotizia();