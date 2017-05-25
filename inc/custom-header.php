<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>  

 *	<?php if ( get_header_image() ) : ?>
    <div id="site-header">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
        </a>
    </div>
<?php endif; ?> //Esta parte del código no venía yo la agregué par poder imagenes en el header. 



 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package UNAM
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses unam_fes_a_header_style()
 */
function unam_fes_a_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'unam_fes_a_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'fffffff',
		'width'                  => 1600, /* Regresalos a los valores originales para que veas el cambio */
		'height'                 => 420,
		'flex-height'            => true,
		'wp-head-callback'       => 'unam_fes_a_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'unam_fes_a_custom_header_setup' );

if ( ! function_exists( 'unam_fes_a_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see unam_fes_a_custom_header_setup().
 */
function unam_fes_a_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
