<?php
// Template part for displaying sticky posts.

// Get the sticky posts
$post_type = get_post_type();
$sticky_posts = get_sticky_posts( $post_type );

$count = 0;
?>

<?php if ( $sticky_posts) :?>
    <section class="sticky-posts">
        <?php foreach ( $sticky_posts as $post_id ) : ?>
            <?php
                // Only display the first 3 sticky posts
                $count++;
                if ( $count > 1 ) {
                    break;
                }

                $post = get_post( $post_id );
                setup_postdata( $post );
            ?>

            <article class="sticky-post">
                <a href="<?php the_permalink(); ?>">
                    <div class="sticky-post-thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                </a>
                
                <div class="sticky-post-content">
                    <a href="<?php the_permalink(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                    
                    <p><?php the_excerpt(); ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
<?php endif; ?>