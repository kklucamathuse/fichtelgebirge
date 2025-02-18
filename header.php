<?php 
    require_once __DIR__ . '/config/theme/minify-html-pre.php';
    session_start();

    $title = get_field('seo_title');
    $description = (get_field('seo_dscr')) ? get_field('seo_dscr') : get_bloginfo('description');
    $img = get_field('seo_img');
    $seoIndex = get_field('seo_index');
    $seoFollow = get_field('seo_follow');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> 
    :class="{ 'overflow-hidden' : openMainNav || modalBg }"  x-data="{ openMainNav: false, scrollNav: false, modalBg: false }">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/layout/favicon.png"/>

        <?php if (!empty($title)) { ?>
            <title><?php echo $title; ?></title>
            <meta property="og:title" content="<?php echo $title; ?>" />
        <?php } else { ?>
            <title><?php wp_title('&raquo;', 'true', 'right'); ?><?php bloginfo('name'); ?></title>
            <meta property="og:title" content="<?php wp_title('&raquo;', 'true', 'right'); ?><?php bloginfo('name'); ?>" />
        <?php } ?>

        <?php if (!empty($description)) { ?>
            <meta name="description" content="<?php echo $description; ?>">
            <meta property="og:description" content="<?php echo $description; ?>" />
        <?php } ?>

        <?php if (!empty($img)) { ?>
            <meta property="og:image" content="<?php echo $img['sizes']['og'] ?>" />
        <?php } ?>

        <meta property="og:url" content="<?php echo esc_url(wp_get_current_url()); ?>" />

        <meta name="robots" content="noarchive, <?php echo !$seoIndex ? 'index' : 'noindex'; ?>, <?php echo !$seoFollow ? 'follow' : 'nofollow'; ?>, noodp"/>

        <?php $assets = json_decode( file_get_contents( get_template_directory() . '/assets/build/mix-manifest.json' ), true ); ?>
        <link rel="preload" href="/wp-content/themes/bergauf/assets/build<?php echo $assets['/vendor.js'] ?>" as="script">
        <link rel="preload" href="/wp-content/themes/bergauf/assets/build<?php echo $assets['/main.js'] ?>" as="script">
        <link rel="preload" href="/wp-content/themes/bergauf/assets/build<?php echo $assets['/main.css'] ?>" as="style">
        <?php 
        /* 
            <link rel="preload" href="<?php echo $assets['wp-content/themes/bergauf/assets/build/fonts/quicksand-v24-latin-300.woff2'] ?>" as="font" crossorigin />
            <link rel="preload" href="<?php echo $assets['wp-content/themes/bergauf/assets/build/fonts/quicksand-v24-latin-400.woff2'] ?>" as="font" crossorigin />
            <link rel="preload" href="<?php echo $assets['wp-content/themes/bergauf/assets/build/fonts/quicksand-v24-latin-500.woff2'] ?>" as="font" crossorigin />
            <link rel="preload" href="<?php echo $assets['wp-content/themes/bergauf/assets/build/fonts/quicksand-v24-latin-600.woff2'] ?>" as="font" crossorigin />
            <link rel="preload" href="<?php echo $assets['wp-content/themes/bergauf/assets/build/fonts/quicksand-v24-latin-700.woff2'] ?>" as="font" crossorigin />
        */ ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <div id="skip-links">
        <a href="#main" class="sr-only text-center no-underline focus-visible:not-sr-only focus-visible:fixed focus-visible:w-full focus-visible:z-[100]">Springe zum Hauptinhalt</a> 
    </div>

    <header 
        id="header" 
        class="fixed top-0 left-0 w-full h-16 bg-white px-6 z-50 transition-all duration-300 shadow-none md:px-9 lg:px-12"
        :class="{ '!shadow-header' : scrollNav }"
        @scroll.window="scrollNav = (window.pageYOffset > 10) ? true : false"
    >
        <div id="header-inner" class="relative flex items-center justify-between w-full h-full max-w-wrapper mx-auto">
            <div id="header-logo-container" class="py-2">
                <a id="logo" href="/" role="navigation" aria-label="Startseite">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/layout/logo.svg" alt="Logo des Unternehmens" class="w-full max-w-48">
                </a>
            </div>

           <div 
                id="header-main-nav-container" 
                class="fixed top-16 left-0 w-screen h-lvh max-w-md bg-white z-40 -translate-x-full transition transition-translate ease-out duration-300 overflow-y-auto"
                :class="{ '!translate-x-0' : openMainNav }">
                <nav id="header-main-nav" class="mt-12 px-6 md:px-9 lg:px-12">
                    <?php if (has_nav_menu('main-menu')) {
                        $settings = array(
                        'container'       => 'false',
                        'menu_id'         => 'main-menu',
                        'theme_location'  => 'main-menu',
                        'walker'          => new Clean_Walker_Nav()
                        );
                        wp_nav_menu($settings);
                    } ?>
                </nav>
            </div>

            <div id="header-main-nav-toggler-container" class="relative z-50">
                <button 
                    id="header-main-nav-toggler" 
                    class="relative flex items-center w-7 h-10 group"
                    @click="openMainNav = ! openMainNav"
                    x-bind:aria-expanded="openMainNav.toString()"
                    aria-controls="header-main-nav-container" 
                    aria-label="Navigation"
                >

                    <span 
                        class="line absolute top-3 right-0 inline-block h-0.5 w-7 bg-primary transition ease-out duration-300"
                        :class="{ 'rotate-45 origin-[7px_7px]' : openMainNav }">
                    </span>
                    <span 
                        class="line absolute top-1/2 -translate-y-1/2 right-0 inline-block h-0.5 w-7 bg-primary transition ease-out duration-300"
                        :class="{ 'opacity-0' : openMainNav }">
                    </span>
                    <span 
                        class="line absolute bottom-3 right-0 inline-block h-0.5 w-7 bg-primary transition ease-out duration-300"
                        :class="{ '-rotate-45 origin-[6px_-4px]' : openMainNav }">
                    </span>
                </button>
            </div>
        </div>
    </header>
    <main id="main">
