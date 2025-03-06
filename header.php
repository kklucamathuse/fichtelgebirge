<?php
require_once __DIR__ . "/config/theme/minify-html-pre.php";
session_start();
$title = get_field("seo_title");
$description = get_field("seo_dscr")
    ? get_field("seo_dscr")
    : get_bloginfo("description");
$img = get_field("seo_img");
$seoIndex = get_field("seo_index");
$seoFollow = get_field("seo_follow");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> :class="{ 'overflow-hidden' : openMainNav || modalBg }" x-data="{ openMainNav: false, scrollNav: false, modalBg: false }">
<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/layout/favicon.png"/>

    <?php if (!empty($title)) { ?>
        <title><?php echo $title; ?></title>
        <meta property="og:title" content="<?php echo $title; ?>" />
    <?php } else { ?>
        <title><?php
        wp_title("&raquo;", "true", "right");
        bloginfo("name");
        ?></title>
        <meta property="og:title" content="<?php
        wp_title("&raquo;", "true", "right");
        bloginfo("name");
        ?>" />
    <?php } ?>

    <?php if (!empty($description)) { ?>
        <meta name="description" content="<?php echo $description; ?>">
        <meta property="og:description" content="<?php echo $description; ?>" />
    <?php } ?>

    <?php if (!empty($img)) { ?>
        <meta property="og:image" content="<?php echo $img["sizes"][
            "og"
        ]; ?>" />
    <?php } ?>

    <meta property="og:url" content="<?php echo esc_url(
        wp_get_current_url()
    ); ?>" />

    <meta name="robots" content="noarchive, <?php echo !$seoIndex
        ? "index"
        : "noindex"; ?>, <?php echo !$seoFollow
    ? "follow"
    : "nofollow"; ?>, noodp"/>

    <?php $assets = json_decode(
        file_get_contents(
            get_template_directory() . "/assets/build/mix-manifest.json"
        ),
        true
    ); ?>
    <link rel="preload" href="/wp-content/themes/bergauf/assets/build<?php echo $assets[
        "/vendor.js"
    ]; ?>" as="script">
    <link rel="preload" href="/wp-content/themes/bergauf/assets/build<?php echo $assets[
        "/main.js"
    ]; ?>" as="script">
    <link rel="preload" href="/wp-content/themes/bergauf/assets/build<?php echo $assets[
        "/main.css"
    ]; ?>" as="style">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="skip-links">
    <a href="#main" class="sr-only text-center no-underline focus-visible:not-sr-only focus-visible:fixed focus-visible:w-full focus-visible:z-[100]">Springe zum Hauptinhalt</a>
</div>
<div id="header-top" class="hidden sm:flex fixed top-0 left-0 w-full bg-primary_light min-h-8 justify-between px-40  text-white py-1 text-open-sans z-50">
    <div class="flex items-center max-w-wrapper mx-auto"> <?php if (
        !empty(do_shortcode("[phone]"))
    ) { ?>
            <a class="phone text-white no-underline inline-flex items-center" href="tel:<?php echo do_shortcode(
                "[phonelink]"
            ); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span><?php echo do_shortcode("[phone]"); ?></span>
            </a>
        <?php } ?>
        <span>| </span>
        <a class="text-white no-underline" href=""><span>Sprechzeiten</span></a>
    </div>
    <div class="flex items-center">
    <?php if (!empty(do_shortcode("[email]"))) { ?>
        <a class="mail text-white no-underline inline-flex items-center" href="mailto:<?php echo do_shortcode(
            "[email]"
        ); ?>">
            <svg class="h-4 w-4 mr-1" id="Ebene_1" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.42 14.22">
              <defs>
                <style>
                  .cls-1 {
                    stroke-miterlimit: 4;
                    stroke-width: .25px;
                  }

                  .cls-1, .cls-2 {
                    fill: #f6f9eb;
                    stroke: #f1f8fe;
                  }

                  .cls-2 {
                    stroke-width: .25px;
                  }
                </style>
              </defs>
              <g id="email">
                <path id="Path_1233" data-name="Path 1233" class="cls-2" d="M18.31,14.1H2.11c-1.1,0-1.98-.89-1.99-1.99V2.11c0-1.1.89-1.98,1.99-1.99h16.2c1.1,0,1.98.89,1.99,1.99v10c0,1.1-.89,1.98-1.99,1.99ZM2.11.88c-.68,0-1.23.55-1.23,1.23v10c0,.68.55,1.23,1.23,1.23h16.2c.68,0,1.23-.55,1.23-1.23V2.11c0-.68-.55-1.23-1.23-1.23H2.11Z"/>
                <path id="Path_1234" data-name="Path 1234" class="cls-2" d="M10.21,9.34c-.09,0-.18-.03-.25-.1L.82,1.17l.5-.57,8.9,7.85L19.12.61l.5.57-9.15,8.07c-.07.06-.16.09-.25.09Z"/>
                <path id="Path_1235" data-name="Path 1235" class="cls-1" d="M.61,12.91l6.14-7,.57.5L1.18,13.41l-.57-.5Z"/>
                <path id="Path_1236" data-name="Path 1236" class="cls-1" d="M13.12,6.4l.57-.5,6.14,7-.57.5-6.14-7Z"/>
              </g>
            </svg>
            <span><?php echo do_shortcode("[email]"); ?></span>
        </a>
    <?php } ?>
    </div>
    <span>Kontakt & Anfahrt | IG FB</span>
</div>
<header id="header" class="fixed top-0 sm:top-8 left-0 w-full h-14 bg-white z-50 transition-all duration-300 shadow-none min-h-8" :class="{ '!shadow-header' : scrollNav }" @scroll.window="scrollNav = (window.pageYOffset > 10) ? true : false">
    <div id="header-inner" class="relative flex items-center justify-between w-full h-full max-w-wrapper mx-auto md:px-9 lg:px-40">
        <div id="header-logo-container" class="py-2">
            <a id="logo" href="/" role="navigation" aria-label="Startseite">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/layout/logo.svg" alt="Logo des Unternehmens" class="w-full max-w-[14rem] md:max-w-[17rem]">
            </a>
        </div>
        <div id="header-main-nav-container" class="hidden md:flex items-center"> <nav id="header-main-nav" class="flex space-x-6"> <?php if (
            has_nav_menu("main-menu")
        ) {
            $settings = [
                "container" => "false",
                "menu_id" => "main-menu",
                "theme_location" => "main-menu",
                "walker" => new Clean_Walker_Nav(),
            ];
            wp_nav_menu($settings);
        } ?>
            </nav>
        </div>

        <div id="header-main-nav-toggler-container" class="relative z-50 md:hidden">
            <button id="header-main-nav-toggler" class="relative flex items-center w-3.5 h-5 md:w-7 md:h-10 group mr-2 md:mr-0" @click="openMainNav = ! openMainNav" x-bind:aria-expanded="openMainNav.toString()" aria-controls="header-main-nav-container" aria-label="Navigation">
                <span class="line absolute top-1.5 right-0 md:top-3 inline-block w-3.5 md:w-7 h-0.5 bg-primary transition ease-out duration-300" :class="{ 'rotate-45 origin-[3.5px_3.5px] md:origin-[7px_7px]' : openMainNav }"></span>
                <span class="line absolute top-1/2 -translate-y-1/2 right-0 inline-block w-3.5 md:w-7 h-0.5 bg-primary transition ease-out duration-300" :class="{ 'opacity-0' : openMainNav }"></span>
                <span class="line absolute bottom-1.5 right-0 md:bottom-3 inline-block w-3.5 md:w-7 h-0.5 bg-primary transition ease-out duration-300" :class="{ '-rotate-45 origin-[3px_-2px] md:origin-[6px_-4px]' : openMainNav }"></span>
            </button>
        </div>

        <div id="header-main-nav-container" class="fixed top-12 sm:top-16 left-0 w-screen h-lvh max-w-md bg-white z-40 -translate-x-full transition transition-translate ease-out duration-300 overflow-y-auto md:hidden" :class="{ '!translate-x-0' : openMainNav }"> <nav id="header-main-nav" class="mt-6 md:mt-12 px-6 md:px-9 lg:px-12">
                <?php if (has_nav_menu("main-menu")) {
                    $settings = [
                        "container" => "false",
                        "menu_id" => "main-menu",
                        "theme_location" => "main-menu",
                        "walker" => new Clean_Walker_Nav(),
                    ];
                    wp_nav_menu($settings);
                } ?>
            </nav>
        </div>
    </div>
</header>
<main id="main">
