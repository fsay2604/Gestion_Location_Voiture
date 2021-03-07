/*
// Author: Francois Charles Hebert
// Date: 3 Novembre 2020
// Script permettant de switche entre deux classes qui affecte le theme d'une page web.
*/

/*********************************************************************************************/ 
/*  Ensemble des EventListener                                                               */
/*********************************************************************************************/ 
document.getElementById("btn_theme").addEventListener("click", switch_theme);

let tbl_annulation = document.getElementsByClassName("deleteReservation");
for(var i=0; i<tbl_annulation.length; i++)
    tbl_annulation[i].addEventListener("click", confimationDelete);

let tbl_description = document.getElementsByClassName("description");
for(let i=0; i < tbl_description.length; i++)
    tbl_description[i].addEventListener("click", function(){hide_Description(i);} );

/*********************************************************************************************/ 
/*  Ensemble des fonctions                                                                   */
/*********************************************************************************************/ 

//  Fonction qui change le theme sur la page web
function switch_theme()
{
    // Gestion de la classe contenant les variables de couleurs
    let htmltag = document.getElementsByTagName("body");
    htmltag[0].classList.toggle("dark-theme");

    //Changement du nom du bouton
    let  btnThemetag = document.getElementById("btn_theme");
    if(btnThemetag.value == "Claire")
    {
        btnThemetag.value = "Sombre";
        document.cookie['theme'] = 'dark-theme';
    }
    else
    {
        btnThemetag.value = "Claire";
        document.cookie['theme'] = '';
    }

}

// Fonction qui demande une confirmation a l'utilisateur
function confimationDelete(event){
    if(confirm("Etes-vous certain de vouloir supprimer cette réservation?") != true)
        event.preventDefault();
}

// Fonction qui fait apparaitre une div contenant la description
function hide_Description(index)
{
    // Faire apparaitre / disparaitre la div contenant la description.
    let  description = document.getElementsByClassName("descriptionContainer");
    description[index].classList.toggle("hide");

    // Change le nom du bouton.
    let BTNvalue = document.getElementsByClassName("btn_desc_value");
    if(BTNvalue[index].innerHTML == "Voir la description")
        BTNvalue[index].innerHTML = "Cacher la description";
    else
        BTNvalue[index].innerHTML = "Voir la description";

}
