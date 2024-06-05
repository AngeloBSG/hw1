function CheckCampi(event){
    // Verifica se tutti i campi sono riempiti
    if(form.email.value.length == 0 ||
       form.password.value.length == 0){
        alert("Compilare i campi richiesti.");
        event.preventDefault();
    }  
}

const form = document.forms['nome_form'];
form.addEventListener('submit', validazione);