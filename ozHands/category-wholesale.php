<?php
/**
 * A Simple Category Template
 */

get_header(); ?>

    <section id=”primary” class=”site-content”>
        <div id=”content” role=”main”>
            <?php
            // Check if there are any posts to display
            if ( have_posts() ) : ?>

            <header class=”archive-header”>
            <?php
            // Since this template will only be used for your selected category
            // we can add it’s category title and description manually.
            // or even add images or change the layout
            ?>

            <h1 class=”archive-title”>Dogs Articles</h1>
            <div class=”archive-meta”>
            Content about dogs for dog enthusists.
            </div>
            </header>

            <?php

            // The Loop
            while ( have_posts() ) : the_post();
            <h2><a href=”<?php echo "http://wholesale.luckysite.com.au/wholesale/". the_title(); ?>” rel=”bookmark” title=”Permanent Link to <?php the_title_attribute(); ?>”><?php the_title(); ?></a></h2>
            <small><?php the_time(‘F jS, Y’) ?> by <?php the_author_posts_link() ?></small>

            <div class=”entry”>
            <?php the_excerpt(); ?>

            <p class=”postmetadata”><?php
            comments_popup_link( ‘No comments yet’, ‘1 comment’, ‘% comments’, ‘comments-link’, ‘Comments closed’);
            ?></p>
            </div>

            <?php endwhile; // End Loop

            else: ?>
            <p>Sorry, no posts matched your criteria.</p>
            <?php endif; ?>
        </div>
    </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>