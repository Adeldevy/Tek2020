<?php 
get_header();

// Boucle principale
if( have_posts() ) : while( have_posts() ) : the_post(); 

    echo '<header class="entry-header has-text-align-center header-footer-group">
    <div class="entry-header-inner section-inner medium">';
    the_title('<h1 class="entry-title">', '</h1>'); // Titre de la page
    echo '</div><!-- .entry-header-inner -->
    </header><!-- .entry-header -->    ';

    echo '  <div class="post-inner thin ">
            <div class="entry-content">    ';
    the_content(); // Contenu de la page
    echo '  </div><!-- .entry-content -->
            </div><!-- .post-inner -->';
    	
	$my_query = new WP_Query( array('post_type' => 'f1618_evenements', 'posts_per_page' => 5 ) );
	
	// Boucle personnalisée
	if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : 
		$my_query->the_post();

        echo '  <div class="post-inner thin ">
                <div class="entry-content">    ';
        the_title('<h2>', '</h2>'); // Titre de chaque article
//		get_template_part( 'template-parts/featured-image' );

            // Affiche la date et l'heure de l'evenement à partir du custom field
            $sDateEvenement = get_post_meta($post->ID, 'date-evenement', true);
            if (!empty($sDateEvenement) ) {
                $sDateTemplate = '
                <div class="evenements-date">
                    <p>Cet événement aura lieu le : %s </p>
                </div>';
                printf( $sDateTemplate, $sDateEvenement);
            }

        if( function_exists('reservation_evenements_pluginactif')) {
            reservation_evenements_getform($post->ID);
        }

        the_content(); // Contenu de chaque article
        echo '  </div><!-- .entry-content -->
                </div><!-- .post-inner -->';
    

	endwhile; endif;
	wp_reset_postdata(); // On réinitialise les données


endwhile; endif;

get_footer();