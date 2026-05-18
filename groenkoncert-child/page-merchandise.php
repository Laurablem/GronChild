<?php
/*
Template Name: Merchandise
Text Domain: gk
*/

get_header();

/* Indlæser de scripts, som siden bruger */
wp_enqueue_script( 'main' ); 
wp_enqueue_script( 'bootstrap' );

/* Henter hero-video og dens beskrivelse */
$headervideo = get_field('topvideo');
$headervideo_desc = get_field('topvideo_beskrivelse');


?>
<!-- Wrapper omkring hele merchsiden -->
<div class="page-merchandise-wrapper">
  
<!-- Hero-sektion øverst på merchandise-siden -->
<section class="gk-frontpage-banner" style="background-image:url('<?php echo get_field('topbillede')['url']; ?>');">
<div class="gk-infowrap y" >
        <div class="wrap">
            <div class="headline">
                <div class="container">
                    <!-- Sidens hovedoverskrift i hero-sektionen -->
                    <h1 class="">
                        <?php if(get_field('overskrift')): echo get_field('overskrift'); else: echo get_the_title(); endif; ?>
                    </h1>
                </div>
            </div>
            <!-- Sidens underoverskrift i hero-sektionen -->
            <?php if(get_field('underoverskrift')): ?>
                <h4 class="date"><?php echo get_field('underoverskrift'); ?></h4>
            <?php endif; ?>
        </div>
    </div>
    <!-- Hero-video som baggrund -->
    <?php if($headervideo): ?>
        <video src="<?php echo get_field('topvideo')['url']; ?>" title="<?php echo $headervideo_desc; ?>" autoplay playsinline muted loop></video>
    <?php endif; ?>
</section>

<!-- Indlæser sidens komponenter -->
<?php get_template_part( '/components/component_loop' ); ?>
</div>
<?php get_footer(); ?>
