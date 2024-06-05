  /*sezione menu Gestione*/
  const FrecciaDs = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/1083533/forward-arrow.png';
  const FrecciaGiu = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/1083533/down-arrow.png';
  
  function toggle(event) {
    const det = document.querySelector('.Dettagli');
    const imgF = event.currentTarget.querySelector('#GestioneImg');
    const text = event.currentTarget.querySelector('#GestioneText');
    
    isVisible = !isVisible;
    if (isVisible) {
      det.classList.remove('Nascosti');
      imgF.src = FrecciaGiu;
      text.textContent = 'Nascondi Gestione Account / Impostazioni';
  
    } else {
      det.classList.add('Nascosti');
      imgF.src = FrecciaDs;
      text.textContent = 'Mostra Gestione Account / Impostazioni';
  
    }
  }
  let isVisible = false;
  
  const DetToggle = document.querySelector('.Gestione');
  DetToggle.addEventListener('click', toggle);
  
  
  /*Funzione per cambiare il colore del background della pagina*/
  function ChangeBackground(event){
    const body = document.querySelector('.Sfondo');
    isWhite = !isWhite;
    if(isWhite){
      body.classList.remove('ColoreSfondo');
    }else{
      body.classList.add('ColoreSfondo');
    }
  }
  let isWhite = false;
  
  const Change = document.querySelector('#ChangeBackground');
  Change.addEventListener('click',ChangeBackground);
  
  
  
  /*sezione menu mobile*/
  function ApriChiudiMenu(){
    isVisible1 = !isVisible1;
  
    if(isVisible1){
      modalView.classList.remove('hidden');
    }else{
      modalView.classList.add('hidden');
    }
  }
  
  let isVisible1 = false;
  const opzioni = document.querySelector("#SpazioMenu");
  const modalView = document.querySelector('#modal-view');
  opzioni.addEventListener("click", ApriChiudiMenu);
  
  
  /*funzione API*/
  let SearchBtn = document.getElementById("SearchButton");

  SearchBtn.addEventListener("click", function() {
    let result = document.getElementById("risultato");
    let url = "https://thecocktaildb.com/api/json/v1/1/search.php?s=";
    let input = document.getElementById("InputBar").value;
  
    if(input.length == 0){
      result.innerHTML = '<h3 class="msg">Il campo di ricerca è vuoto</h3>';
    } else {
      fetch (url + input)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        console.log(data.drinks[0]);
        let myDrink = data.drinks[0];
        console.log(myDrink.strDrink);
        console.log(myDrink.strDrinkThumb);
        console.log(myDrink.strInstructionsIT);
        let count = 1;
        let ingredienti = [];
        for(let i in myDrink){ 
          let ingrediente = "";
          let dosi = "";
          if(i.startsWith("strIngredient") && myDrink[i]){
            ingrediente = myDrink[i];
            if(myDrink['strMeasure'+count]){
              dosi = myDrink['strMeasure'+count];
            } else {
              dosi = "";
            }
            count += 1;
            ingredienti.push(`${dosi} ${ingrediente}`); 
          }
        }
        console.log(ingredienti);
  
        result.innerHTML = `
          <div id="SpazioThumb">
            <img src="${myDrink.strDrinkThumb}">
            <div id="SpazioTitle">
              <h2 id="nomedrink">${myDrink.strDrink}</h2>
              <h2 id="Ingredienti">Ingredienti:</h2>
              <ul class="Ingredienti"></ul>
            </div>
          </div>
          <div id=SpazioPrep">
            <h1 id="Preparazione">Preparazione:</h1>
            <h3 id="Descrizione">${myDrink.strInstructionsIT}</h3>
          </div>
        `;
  
        let listaIngredienti = document.querySelector(".Ingredienti"); // Corretto il selettore
        ingredienti.forEach(item => {
          let listaItem = document.createElement("li");
          listaItem.innerText = item;
          listaIngredienti.appendChild(listaItem);
        });
      })
      .catch(() => {
        result.innerHTML = '<h3 class="msg">Inserisci un input valido</h3>';
      });
    }
  });
  
  
  /*richiesta API con OAuth2.0*/
  document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('SearchButton1');
    const searchInput = document.getElementById('InputBar1');
    const risultato = document.getElementById('risultato');
    
    searchButton.addEventListener('click', function() {
      const query = searchInput.value.trim();
      if (query !== '') {
        fetchRecipes(query);
      }
    });
    
    searchInput.addEventListener('keypress', function(event) {
      const query = searchInput.value.trim();
      if (event.key === 'Enter' && query !== '') {
        fetchRecipes(query);
      }
    });
  
    function fetchRecipes(query) {
      const apiKey = '405396bc723c40b5aa13fc40149faa9d';
      const apiUrl = `https://api.spoonacular.com/recipes/complexSearch?apiKey=${apiKey}&query=${query}`;
      
      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          console.log(data);
          displayResults(data.results);
        })
        .catch(error => console.error('Errore durante la ricerca delle ricette:', error));
    }
  
    function displayResults(results) {
      risultato.innerHTML = '';
      if (results.length === 0) {
        risultato.innerHTML = 'Nessuna ricetta trovata.';
      } else {
        results.forEach(recipe => {
          const recipeElement = document.createElement('div');
          recipeElement.innerHTML = `
            <h3>${recipe.title}</h3>
            <button class="details-button" data-recipe-id="${recipe.id}">Mostra Dettagli</button>
          `;
          risultato.appendChild(recipeElement);
        });
        
        document.querySelectorAll('.details-button').forEach(button => {
          button.addEventListener('click', function() {
            const recipeId = this.getAttribute('data-recipe-id');
            fetchRecipeInformation(recipeId);
          });
        });
      }
    }
  });
  
  
  function fetchRecipeInformation(recipeId) {
    const apiKey = '405396bc723c40b5aa13fc40149faa9d';
    const apiUrl = `https://api.spoonacular.com/recipes/${recipeId}/information?apiKey=${apiKey}`;
    
    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        displayRecipeInformation(data);
      })
      .catch(error => console.error('Errore durante la ricerca delle informazioni sulla ricetta:', error));
  }
  
  function displayRecipeInformation(recipeInfo) {
    const risultato = document.getElementById('risultato');
    risultato.innerHTML = `
      <h3>${recipeInfo.title}</h3>
      <p>Tempo di preparazione: ${recipeInfo.readyInMinutes} minuti</p>
      <p>Serve: ${recipeInfo.servings}</p>
      <h4>Ingredienti:</h4>
      <ul>
        ${recipeInfo.extendedIngredients.map(ingredient => `<li>${ingredient.original}</li>`).join('')}
      </ul>
      <h4>Procedura:</h4>
      <ol>
        ${recipeInfo.analyzedInstructions.length > 0 ? recipeInfo.analyzedInstructions[0].steps.map(step => `<li>${step.step}</li>`).join('') : '<li>Procedura non disponibile</li>'}
      </ol>
    `;
  }
  
  