<?php
    /* Layout styrer om billede står til venstre eller højre på desktop */
    $layout = get_sub_field('layout');
    
    /* Henter tekstindhold og knapdata */
    $title = get_sub_field('overskrift');
    $text = get_sub_field('tekst');
    $btn = get_sub_field('knap_button');

    /* Indlæser Flickity-biblioteket, så slideshowet kan fungere som en slider */
    wp_enqueue_script( 'flickity' );

?>
<section class="component textimg textslideshow child-theme">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 <?php if($layout=="left"): echo 'order-lg-1';endif; ?>">
                <div class="textimg__slideshow">
                    <!-- Billedslider til print-slideshowet -->
                    <?php if(have_rows('slideshow')): ?>
                        <div class="image-gallery-child">
                            <!-- Looper gennem alle slideshow-billeder -->
                            <?php while(have_rows('slideshow')): the_row(); ?>
                                <div class="textimg__slideshow-item">
                                    <img src="<?php echo get_sub_field('billede')['url']; ?>" alt="<?php echo get_sub_field('billede')['alt']; ?>">
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 <?php if($layout=="left"): echo 'order-lg-0';endif; ?>">
                <div class="textimg-wrap">
                    <!-- Tekstindhold til print-slideshowet -->
                    <?php if($title): ?>
                        <h2 class="textimg__title"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if($text): ?>
                        <div class="textimg__text"><?php echo $text; ?></div>
                    <?php endif; ?>
                    <?php if( $btn['link']):?>
                        <!-- Mulighed for ekstra link-knap i modulet -->
                        <a href="<?php echo $btn['link']['url']; ?>" <?php echo !empty($btn['link']['target']) ? 'target="' . $btn['link']['target']. '"' : ''; ?>  class="btn btn-<?php echo $btn['farve']?> btn-<?php echo $btn['storrelse']; ?>"><span><?php echo $btn['link_label']; ?></span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
