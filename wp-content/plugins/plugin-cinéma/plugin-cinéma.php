<?php


/*
Plugin Name: Plugin Cinéma
Plugin URI: http://wordpress.org/plugins/plugin-test/
Description: affichage des fils e d'une manière aléatoire aprtir d'une d'une Url gérée par le site https://www.themoviedb.org/
Author: adel
Version: 1.0
Author URI: http://adel.fr
*/




function loadWidget(){
   
    register_widget('WidgetCinema');
}
 //déclaration de l'objet Widget cinéma qui hérite des finctionalités de l'objet de base "WP_Widget" fourni par WP
class WidgetCinema extends WP_Widget  
{
    public function __construct()
    {
        parent::__construct('plugincinema', 'Un peu de cinéma ', array('description' => 'affichage des fils e d\'une manière
         aléatoire a partir d\'une d\'une Url gérée par le site https://www.themoviedb.org/'));
       
    }
    //insertion de la partie HTML  en activant le fonction loadLib qui charge le bootsrap + le fichier JS
    public function widget($args, $instance)  
    { 
       $this->loadLib();
        echo '<div class="container">
        <h5>Un peu de cinéma !!</h5>
    
        <div class="card" style="width:300px">
            
                <img class="card-img-top" id="poster" src="" alt="Card image" ></img>
                <div class="card-body">
                    <p class="card-text" id="resume"></p>
                    
                    <label ><strong>Note :  </strong></label>
                      <meter  value="" min="0" max="10"></meter><span class="card-text" id="note"></span> <br>

                    <a href="https://www.themoviedb.org/discover/movie" target="blank" class="btn btn-primary btn-sm">voir plus !</a>
                </div>
        </div>
    </div>';
    }
//mise en place de cette fonction à l'intérieur de la class pour que WP ne fait appel à cette fonction en dehors de la class
    function loadLib(){  
        wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' );
        wp_enqueue_script('plugincinema',plugins_url('js/plugin.js', __FILE__ ),array('jquery'));
    
    }
}

// initialisation de widget  *****************////*/*/

add_action('widgets_init', 'loadWidget'); 











