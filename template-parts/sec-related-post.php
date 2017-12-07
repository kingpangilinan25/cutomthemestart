<?php //$related = ci_get_related_posts( $post->ID, 3 ); var_dump($related); ?>
<h3 class="title-sec-rel-art">Other Related Articles</h3>
<div class="related-posts-cont row">
    <?php while ( $related->have_posts() ): $related->the_post(); ?>
        <div class="rpc-item">
            <div class="col-sm-6 col-md-4">
                <figure class="dtable-center featured-img-rpc-cont">
                    <?php //krgp_get_thumbnail($size='thumbnail', $class='post-cthumbnail', $placeHolder=false, $image_url_ph=""); ?>
                    <?php $img_catcher = get_template_directory_uri() . '/images/NoImageAvailable.png'; ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo krgp_get_thumbnail('medium', 'related-img', true, $img_catcher); ?>
                    </a>
                </figure>
                <h4 class="dtable title-rpc"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php //the_excerpt(); ?>
                <p class="rpc-rm-p"><a class="rpc-rm" href="<?php the_permalink(); ?>">Read</a></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>