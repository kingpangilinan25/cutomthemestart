<div class="category-cont text-center">
    <span class="links-wrap">
		<?php
            $categories = get_the_category();
            $separator = ',';
            $output = '';
            if ( ! empty( $categories ) ) {
                foreach( $categories as $category ) {
                    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                }
                echo trim( $output, $separator );
            }
        ?>
    	<span class="lw-left-clef"></span>
    	<span class="lw-right-clef"></span>
    </span>
</div>