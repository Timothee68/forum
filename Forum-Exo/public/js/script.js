// fonction pour le login et register
function cambiar_login() {
    document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";  
  document.querySelector('.cont_form_login').style.display = "block";
  document.querySelector('.cont_form_sign_up').style.opacity = "0";               
  
  setTimeout(function(){  document.querySelector('.cont_form_login').style.opacity = "1"; },400);  
    
  setTimeout(function(){    
  document.querySelector('.cont_form_sign_up').style.display = "none";
  },200);  
    }
  
  function cambiar_sign_up(at) {
    document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
    document.querySelector('.cont_form_sign_up').style.display = "block";
  document.querySelector('.cont_form_login').style.opacity = "0";
    
  setTimeout(function(){  document.querySelector('.cont_form_sign_up').style.opacity = "1";
  },100);  
  
  setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
  },400);  
  
  
  }    
  
  function ocultar_login_sign_up() {
  
  document.querySelector('.cont_forms').className = "cont_forms";  
  document.querySelector('.cont_form_sign_up').style.opacity = "0";               
  document.querySelector('.cont_form_login').style.opacity = "0"; 
  
  setTimeout(function(){
  document.querySelector('.cont_form_sign_up').style.display = "none";
  document.querySelector('.cont_form_login').style.display = "none";
  },500);  
    
    }





            // récupération du token dans la balise méta : 

    // Récupération d'une collection d'éléments caractérisés par le TagName = "meta"
    const metaTab = document.getElementsByTagName("meta");
    // Déclaration de la variable csrfToken
    let csrfToken = null;
    // Boucle for pour parcourir la collection d'élément jusqu'à obtenir celui concernant le token csrf
    for(let i=0; i<metaTab.length; i++){
        if(metaTab[i].getAttribute('name') == 'csrf-token'){ // si le nom de l'élement courant est csrf-token
            csrfToken = metaTab[i].getAttribute('content'); // alors je récupère l'attribut associé à content dedans
            break; // je sors ensuite directement de la boucle car il n'y a plus besoin de chercher
        }
    }
    $( "form" ).on("submit", () => { // utilisation de la fonction anonyme suivante sur les submits de chaque formulaire
    // le .on("submit", execute la fonction associée juste avant de submit
    let count = 0; // initialisation et déclaration d'un compteur pour la boucle while
    while(document.forms.item(count)!= null){ // tant qu'il existe un élément associé au tableau de fomulaire de la page, à l'index de l'itérateur count
    const hiddenInput = document.createElement('input'); // création d'un élement Input pour chaque formulaire présent
    hiddenInput.type = 'hidden'; // Dissimulation de l'input 
    hiddenInput.value = csrfToken; // Initialisation de l'input 
    hiddenInput.name = "csrfToken"; // Nomination de l'input pour être récupérable dans le $_POST[]
    document.forms.item(count).appendChild(hiddenInput); // Ajout de chaque input crée dans chaque formulaire associé
    count++; // Incrémentation du compteur pour relancer la boucle si besoin
    }
    return true; // true = le submit se fait, false = le submit ne se fait pas
    });


