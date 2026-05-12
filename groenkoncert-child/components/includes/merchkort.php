<?php
// Henter komponentens overskrift.
$title = get_sub_field('overskrift');
?>
<section class="component merchkort child-theme">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?php echo esc_html($title); ?></h2>
                <div class="merchkort-wrapper">
                    <!-- Bygger et internt array af merch-data fra ACF-rækker -->
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
                        <!-- Alle billeder renderes én gang og styres via JS -->
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
                        <!-- Navigation med knapper til at skifte aktivt merchkort -->
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>