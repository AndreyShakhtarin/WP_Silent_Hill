<?php  $args = array(
    'public'=> true,
    '_builtin' => false
);
$post_types = get_post_types( $args, 'names', 'and' );
foreach ( $post_types as $post_type ) {
    echo '<p>' . $post_type . '</p>';
} ?>
			<?php echo 'The post type is: '.get_post_type( $post->ID ); ?>
			<?php if( post_type_exists( 'products' ) ) {
    echo '<br>The Products post type exists <br>';
} ?>
			<?php add_post_type_support( 'products', array( 'thumbnail', 'comments' ) ); ?>

    <h2><?php wp_tag_cloud( array( 'taxonomy' => 'type', 'number' => 5 ) ); ?><h2>

<?php $args = array(
    'post_type' => 'products',
    'tax_query' => array(
        'taxonomy' => 'type',
        'field' => 'slug',
        'terms' => 'weapon'
    )
);
			$products = new WP_Query( $args );
			while ( $products->have_posts() ) : $products->the_post();
                echo '<p>' .get_the_title(). '</p>';
            endwhile;
			wp_reset_postdata() ;
			?>
<?php echo get_the_term_list( $post->ID, 'type', 'Product Type: ', ' * ' ); ?>

					<?php
					$terms = get_terms( 'type' );
					foreach ( $terms as $term ) {
                        echo '<p>' . $term->name . '</p>';
                    }

echo "it's here welcome!!!";