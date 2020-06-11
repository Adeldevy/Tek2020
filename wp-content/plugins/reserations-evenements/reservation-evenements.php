<?php
/**
 * Plugin Name: reservation-evenements
 * Description: Reservation aux evenements pour les abonnés
 */
defined( 'ABSPATH' ) or die( 'No direct access' );

// Recuperation du code HTML du formaulaire de reservation
function reservation_evenements_getform( $postId ) {

    if (is_user_logged_in()) {
        echo '<p>Vous etes connectes</p>';
    } else {
        echo '<p>Connectez-vous pour pouvoir réserver</p>';
    }
}

// Pour verifier si le plugin est activé
function reservation_evenements_pluginactif( $post_object ) {
}