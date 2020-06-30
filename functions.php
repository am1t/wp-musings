<?php

/* THEME SETUP
------------------------------------------------ */

if ( ! function_exists( 'musings_setup' ) ) :
	function musings_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Set content-width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 620;
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 620, 9999 );
		
		// Title tag
		add_theme_support( 'title-tag' );
		
		// Post formats
		add_theme_support( 'post-formats', array( 'aside', 'link', 'quote' ) );
		
		// Register nav menu
		register_nav_menu( 'primary-menu', __( 'Primary Menu', 'musings' ) );
		
		// Make the theme translation ready
		load_theme_textdomain( 'musings', get_template_directory() . '/languages' );
		
	}
	add_action( 'after_setup_theme', 'musings_setup' );
endif;


/* ENQUEUE STYLES
------------------------------------------------ */

if ( ! function_exists( 'musings_load_style' ) ) :
	function musings_load_style() {

		$theme_version = wp_get_theme( 'musings' )->get( 'Version' );

		wp_register_style( 'musings_fonts', '//fonts.googleapis.com/css?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700' );
		wp_register_style( 'musings_heading_fonts', '//fonts.googleapis.com/css?family=Playfair+Display:wght@500' );
		wp_enqueue_style( 'musings_style', get_stylesheet_uri(), array( 'musings_fonts', 'musings_heading_fonts') );

	}
	add_action( 'wp_enqueue_scripts', 'musings_load_style' );
endif;


/* ENQUEUE COMMENT-REPLY.JS
------------------------------------------------ */

if ( ! function_exists( 'musings_load_scripts' ) ) :
	function musings_load_scripts() {

		$theme_version = wp_get_theme( 'musings' )->get( 'Version' );

		wp_enqueue_script( 'musings_construct', get_template_directory_uri() . '/assets/js/construct.js', array( 'jquery' ), $theme_version, true );

		if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'musings_load_scripts' );
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY GUTENBERG SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'musings_add_block_editor_features' ) ) :
	function musings_add_block_editor_features() {

		/* Gutenberg Palette --------------------------------------- */

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> __( 'Black', 'musings' ),
				'slug' 	=> 'black',
				'color' => '#000',
			),
			array(
				'name' 	=> __( 'White', 'musings' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

	}
	add_action( 'after_setup_theme', 'musings_add_block_editor_features' );
endif;
