<?php
/* Henter overskriften, som vises over merchkortene */
$title = get_sub_field('overskrift');
?>
<section class="component merchkort">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo esc_html($title); ?></h2>
                <div class="merchkort-wrapper">
                  
					<!-- Samler alle merchkort i et array, så data kan bruges til både knapper og billeder -->
                    <?php if (have_rows('kort')): ?>
                        <?php
                        $merch_items = [];
                        while (have_rows('kort')):
                            the_row();
                            $merch_items[] = [
                                'city' => get_sub_field('bynavn'),
                                'image' => get_sub_field('kort'),
                                'alt' => get_sub_field('overskrift') ?: get_sub_field('bynavn'),
                            ];
                        endwhile;
                        ?>
                        <!-- Knapper til at skifte mellem merchkortene -->
                        <div class="merchkort-navbar">
                            <?php foreach ($merch_items as $index => $item): ?>
                                <button
                                    class="merchkort-navbar-button"
                                    type="button"
                                    data-merch-index="<?php echo esc_attr($index); ?>"
                                >
                                    <?php echo esc_html($item['city']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <!-- Billederne vises/skjules med JavaScript -->
                        <div class="merchkort-images">
                            <?php foreach ($merch_items as $index => $item): ?>
                                <?php if ($item['image']): ?>
                                    <img
                                        src="<?php echo esc_url($item['image']); ?>"
                                        alt="<?php echo esc_attr($item['alt']); ?>"
                                        data-merch-image="<?php echo esc_attr($index); ?>"
                                    >
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
