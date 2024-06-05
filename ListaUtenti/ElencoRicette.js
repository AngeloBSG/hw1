function cercaRicetta() {
    var input = document.getElementById("InputBar").value.toLowerCase();
    var elementiRicetta = document.getElementsByClassName("Elemento");
    for (var i = 0; i < elementiRicetta.length; i++) {
        var nomeRicetta = elementiRicetta[i].innerText.toLowerCase();
        if (nomeRicetta.includes(input) || input === "") {
            elementiRicetta[i].style.display = "block";
        } else {
            elementiRicetta[i].style.display = "none";
        }
    }
}

function mettiLike(link) {
    var emailUtente = "<?php echo $emailUtente; ?>";
    var codiceRicetta = link.getAttribute('data-codice-ricetta');
    
    var formData = new FormData();
    formData.append("emailUtente", emailUtente);
    formData.append("codiceRicetta", codiceRicetta);
    
    var req = new XMLHttpRequest();
    req.open("POST", "AggiungiMiPiace.php", true);
    req.onreadystatechange = function(){
        if(req.readyState == 4 && req.status == 200){
            var response = req.responseText;
            var contaLike = document.getElementById("likeCount_" + codiceRicetta);
            if (response.trim() === "Like aggiunto con successo.") {
                contaLike.textContent = parseInt(contaLike.textContent) + 1; // Incrementa il conteggio dei "Mi Piace"
            } else if (response.trim() === "Unlike eseguito con successo.") {
                contaLike.textContent = parseInt(contaLike.textContent) - 1; // Decrementa il conteggio dei "Mi Piace"
            }
        }
    }
    req.send(formData);
}