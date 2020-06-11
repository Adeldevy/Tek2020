<?php

/**
 * Footer
 *
 * @package essential
 */

?>
        <!-- SOCIAL -->
        <div class="section social">
            <div class="section-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 text-center">
                            <?php
                            $footer_logo = essential_get_options('essential_footer_logo_text', esc_html__( 'ESSENTIAL', 'essential' ) );
                            if (!empty($footer_logo)) : ?>
                            <h4><?php echo esc_html( $footer_logo ); ?></h4>
                            <hr />
                            <?php endif ?>
                            <?php
                            $type_icons = essential_get_options('essential_type_icons', 'ionicons');
                            $icons = essential_get_options('essential_footer_socials_' . $type_icons,'essential_footer_socials_ionicons');
                            if (!empty($icons) && is_array($icons)) :
                                foreach ($icons as $item) :
                                    $item['link_icon'] = $item['link_icon'];
                                ?>
                                <a rel="nofollow" href="<?php echo esc_url( $item['link_url'] ); ?>"><i class="<?php echo esc_attr( $item['link_icon'] ); ?>"></i></a>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="section">
            <div class="section-content">
                <div class="container">
                    <div class="copyright">
                        <?php echo wpautop(wp_kses_post( essential_get_options('essential_copyright_text','&copy; ' . date('Y') . esc_html__( '. Essential. All Rights Reserved.', 'essential' ) ) )); ?>
                    </div>
                </div>
            </div>
        </footer>

        <?php

        $images = essential_get_options('essential_parallax_images');
        if (!empty($images) && is_array($images)):
            foreach ($images as $key => $image) {
                if (is_numeric($image['image'])) {
                    $images[$key]['image'] = wp_get_attachment_url( $image['image'] );
                }
            }
        ?>

        <div data-parallax-images="<?php echo esc_attr(json_encode($images)); ?>"></div>

        <?php endif; ?>

        <?php if (essential_get_options('essential_back_to_top')): ?>
        <div class="back-to-top">
            <a href="#top"><i class="ion-ios-arrow-up"></i></a>
        </div>
        <?php endif; ?>

        <?php wp_footer(); ?>
    </body>
</html>
