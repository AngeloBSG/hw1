<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Blog</title>
    <link rel="Stylesheet" href="index.css">
    <meta name="viewport"content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="index.js" defer></script>

</head>

    <body class="Sfondo" id="ColoreSfondo">
        <nav>
            <div id="Main">
                <a href="https://www.foodblog.it/" target="_self"><img id="Logo", src="IMG\LogoFB.png"></a>
                <div id="Main1">
                    <a href="https://www.notizie.it/" target="_self"><img id="Notizie" src="IMG\Notizie.png"></a>

                    <?php
                        function getDataOdierna(){
                        date_default_timezone_set('Europe/Rome');
                        return date('d/m/Y');
                        }
                        $dataOdierna = getDataOdierna();
                    ?>
                    <h1 id="DataLocale"><?php echo $dataOdierna?></h1>
                </div>
            </div>

            <div id="AvvisoSessioneAttiva"><?php
                        session_start();
                        if(isset($_SESSION['email'])){
                            echo "<script>document.getElementById('AvvisoSessioneAttiva').innerHTML = '!Attenzione Sessione utente attiva!';</script>";
                        }
                    ?>
            </div>

            <!-- Menu gestione account -->
            <div id="SezioneGestione">
                <div class="Gestione">
                    <img id="GestioneImg" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1083533/forward-arrow.png"/>
                    <span id="GestioneText">Mostra [Gestione Account / Impostazioni]</span>
                </div>
            
                <div class="Dettagli Nascosti">
                   <ul>
                       <a href="ListaUtenti\LoginUtente.php" class="NoDecoration" id="SignIn"><li class="DetNas">Accedi</li></a>
                       <a href="ListaUtenti\RegistrazioneAccount.html" class="NoDecoration" id="SignIn"><li class="DetNas">Registrati</li></a>
                       <a href="#" class="NoDecoration"><li class="DetNas" id="ChangeBackground">[Black/White]</li></a>
                   </ul>
                </div>
            </div>
            
            <div id="Riga"></div>
            
        </nav>

        <header>
            <!-- Include le varie scritte e il menu mobile -->
            <div id="Top"> 
                <a href="https://www.foodblog.it/ricette/" class="NoDecoration Sottolinea Link"><span class="Elemento">Ricette</span></a>
                <a href="https://www.foodblog.it/ristoranti/" class="NoDecoration Sottolinea Link"><span class="Elemento">Ristoranti</span></a>
                <a href="https://www.foodblog.it/chef/" class="NoDecoration Sottolinea Link"><span class="Elemento">Chef</span></a>                    
                <a href="https://www.foodblog.it/consigli/" class="NoDecoration Sottolinea Link"><span class="Elemento">Consigli</span></a>
                <a href="https://www.foodblog.it/diete-benessere/" class="NoDecoration Sottolinea Link"><span class="Elemento">Diete e Benessere</span></a>
            </div>

            
            <!-- Menu Mobile -->
            <div id="SpazioMenu">
                <div class="Menu"></div>
                <div class="Menu"></div>
                <div class="Menu"></div>
                <div id="modal-view" class="hidden">
                  <div id="ListaOpzioni">
                        <a href="https://www.foodblog.it/ricette/" class="NoDecoration Sottolinea Link"><li class="ElementoMenu">Ricette</li></a>
                        <a href="https://www.foodblog.it/ristoranti/" class="NoDecoration Sottolinea Link"><li class="ElementoMenu">Ristoranti</li></a>
                        <a href="https://www.foodblog.it/chef/" class="NoDecoration Sottolinea Link"><li class="ElementoMenu">Chef</li></a>          
                        <a href="https://www.foodblog.it/consigli/" class="NoDecoration Sottolinea Link"><li class="ElementoMenu">Consigli</li></a>
                        <a href="https://www.foodblog.it/diete-benessere/" class="NoDecoration Sottolinea Link"><li class="ElementoMenu">Diete e Benessere</li></a>
                    </div>
                </div>
              </div>
            
            <!-- Sezione barra di ricerca -->
            <div id="Spazio_Ricerca">
                <div class="BackColor">
                    <input id="InputBar" type='text' placeholder='Inserire cocktail' value="">
                    <button id="SearchButton" type="Ricerca">Ricerca</button>
                </div>
                <div class="BackColor">
                    <input id="InputBar1" type='text' placeholder='Inserire ricetta' value="">
                    <button id="SearchButton1" type="Ricerca">Ricerca</button>
                </div>
            </div>

        </header>


       
        <section>
             <!-- include le immagini e le relative scritte -->
            <div id="Container">
                <div id="SpazioIMG1">
                    <a href="https://www.foodblog.it/crema-mascarpone-senza-uova/" target="_self">
                        <img  id="IMG1" src="IMG\mascarpone.png">
                            <a class="NoDecoration" href="https://www.foodblog.it/crema-mascarpone-senza-uova/">
                                <h2 id="Text1A">Crema al mascarpone senza uova: ideale per farcire dolci</h2>
                                <h4 id="Text1B">La ricetta facile e veloce della crema al mascarpone senza uova,
                                preparata con l'aggiunta di panna montata e aromatizzata alla vaniglia.</h4>
                            </a>
                    </a>
                 
                </div>
                <div id="Container2">
                    <div id="SpazioIMG2">
                        <a href="https://www.foodblog.it/rana-pescatrice-padella-bianco/" target="_self">
                            <img id="IMG2" src="IMG\cozze.png">
                            <a class="NoDecoration" href="https://www.foodblog.it/rana-pescatrice-padella-bianco/">
                                <h3 id="Text2">Rana pescatrice in padella in bianco: ricetta leggera e genuina</h3>
                            </a>
                        </a> 
                    </div>
                    <div id="Container3">
                        <div id="SpazioIMG3">
                            <a href="https://www.foodblog.it/giovanni-castaldi-intervista/" target="_self">
                                <img id="IMG3" src="IMG\Intervista.png">
                                <a class="NoDecoration" href="https://www.foodblog.it/giovanni-castaldi-intervista/">
                                    <h4 id="Text3">Giovanni Castaldi: "In cucina bisogna sperimentare e non avere limiti"</h4>
                                </a>
                            </a>
                        </div>

                        <div id="SpazioIMG4">
                            <a href="https://www.foodblog.it/migliori-ristoranti-indiani-milano/" target="_self">
                                <img id="IMG4" src="IMG\Spezie.png">
                                <a class="NoDecoration" href="https://www.foodblog.it/migliori-ristoranti-indiani-milano/">
                                    <h4 id="Text4">I migliori ristoranti indiani a Milano: la classifica</h4>
                                </a>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>

        <br>
        <footer>
            <div id="Drink-view">
                <div id="risultato">
                    
                </div>
            </div>


        </footer>


    </body>
</html>