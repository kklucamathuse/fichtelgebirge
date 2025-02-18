        </main>
        <footer id="footer" class="py-12 px-6 bg-primary md:px-9 lg:px-12">
            <div class="wrapper">
                <div class="flex flex-wrap space-y-12 -mx-6">
                    <?php /* CONTACT */ ?>
                    <div class="col contact w-full px-6 md:w-1/2 lg:w-1/4">
                        <h4 class="text-white mb-4 font-semibold">
                            <?php echo do_shortcode('[company]');?>
                        </h4>

                        <p class="text-white pb-0">
                            <?php echo do_shortcode('[street]');?>
                            <br />
                            <?php echo do_shortcode('[place]');?>
                        </p>

                        <div class="links pt-4">
                            <?php if(!empty(do_shortcode('[phone]'))) { ?>
                                <a class="phone text-white" href="tel:<?php echo do_shortcode('[phonelink]');?>">
                                    <span>
                                        <?php echo do_shortcode('[phone]');?>
                                    </span>
                                </a>
                            <?php } ?>
                            <?php if(!empty(do_shortcode('[email]'))) { ?>
                                <a class="mail text-white" href="mailto:<?php echo do_shortcode('[email]');?>">
                                    <span>
                                        <?php echo do_shortcode('[email]');?>
                                    </span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>

                    <?php /* OPENING HOURS */ ?>
                    <div class="col menu w-full px-6 md:w-1/2 lg:w-1/4">
                        <h4 class="text-white mb-4 font-semibold">Öffnungszeiten</h4>
                        <?php if(!empty(do_shortcode('[hours]'))) { ?>
                            <p class="text-white pb-0">
                                <?php echo do_shortcode('[hours]');?>
                            </p>
                        <?php } ?>
                    </div>

                    <?php /* MENU */ ?>
                    <div class="col menu w-full px-6 md:w-1/2 lg:w-1/4">
                        <h4 class="text-white">Rechtliches</h4>
                        <?php if (has_nav_menu('footer-menu')) {
                            $settings = array(
                                'container'       => 'false',
                                'theme_location'  => 'footer-menu',
                                'walker'          => new Clean_Walker_Nav()
                            );
                            wp_nav_menu($settings);
                        } ?>
                    </div>

                    <?php /* SOCIAL MEDIA */ ?>
                    <div class="col social-media w-full px-6 md:w-1/2 lg:w-1/4">
                        <h4 class="text-white mb-4 font-semibold">Folgen Sie uns</h4>
                        <ul class="space-y-2">
                            <?php if(!empty(do_shortcode('[facebook]'))) { ?>
                                <li>
                                    <a href="<?php echo do_shortcode('[facebook]');?>" class="text-white">Facebook</a>
                                </li>
                            <?php } ?>
                            <?php if(!empty(do_shortcode('[youtube]'))) { ?>
                                <li>
                                    <a href="<?php echo do_shortcode('[youtube]');?>" class="text-white">Youtube</a>
                                </li>
                            <?php } ?>
                            <?php if(!empty(do_shortcode('[instagram]'))) { ?>
                                <li>
                                    <a href="<?php echo do_shortcode('[instagram]');?>" class="text-white">Instagram</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>

        <div id="bg-layer" class="fixed top-0 left-0 w-full h-full bg-black opacity-0 transition ease-out duration-300 pointer-events-none z-10" :class="{ '!opacity-90 pointer-events-auto' : openMainNav }" @click="openMainNav = false"></div>
    </body>
</html>
<?php require_once __DIR__ . '/config/theme/minify-html-post.php'; ?>
