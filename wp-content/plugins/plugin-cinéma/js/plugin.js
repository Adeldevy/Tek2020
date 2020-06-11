function autoLoad(){   
    //  la récupération des données de l'URL ensuite leurs stochage avec la fonction data 
  jQuery.get("https://api.themoviedb.org/3/discover/movie?api_key=326e0fd03a6a16cd60cbc8cfb8a9a5cc",{include_adult:false, language:"fr-FR"}, function(data){

        var results = data.results;
        var id= Math.floor(Math.random()*results.length); // selection d'un id d'une maniére aléatoire tiré sur la langueur(numbre) de résutltat obtenu
        var movie= results[id]; //affichage des résulats sous forme d'un tableau
        // console.log(movie); affichage de résultat

        
        jQuery("#poster").attr("src","https://image.tmdb.org/t/p/w600_and_h900_bestv2"+movie.poster_path); //affichage de poster de film par insertion de  l'url dans l'attribut src="" 


        jQuery("#resume").html(movie.overview.split(".",1));  // affichage de résumé +controle de nombre de phrases affichées en s'arrêtant au point "."

        var note ="/10";
        jQuery("#note").html(movie.vote_average+note);  //affichage de la note des spectateurs .
        
        jQuery("meter").attr("value",movie.vote_average); // inqerer la note de vote dans l'attribut "value" en séléctionnant la balise <meter>
  });   



 }
        jQuery(document).ready(function(){


                autoLoad(); // aprés avoir charger le contenu 
                setInterval(autoLoad,9000); //actualisation de la page chaque 9000 millième de seconde 

        });
            