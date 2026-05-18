<div class="component triple_sider child-theme">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <!-- Viser slideren, hvis der er oprettet slides -->
            <?php if(have_rows('slides')): ?>
                <!-- Wrapper til trippelsliderens billeder -->
                <div class="image-gallery-triple">
                    <!-- Looper gennem alle slides og viser hvert billede -->
                    <?php while(have_rows('slides')): the_row(); ?>
                        <div class="textimg__slideshow-item">
                            <img src="<?php echo get_sub_field('slide')['url']; ?>" alt="<?php echo get_sub_field('slide')['alt']; ?>">
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>

</div>
