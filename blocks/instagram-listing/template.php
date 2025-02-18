<?php
    // Get name of the current element.
    $element = basename(__DIR__);

    // Get block ID.
    $id = $block['id'];

    // Path to Block-Element
    $blockPath = get_stylesheet_directory_uri() . "/blocks/" . $element;
    $path = "data-blockpath='$blockPath'";

    // ACF fields.
    $presentation = get_field('presentation');
    $headline = get_field('headline_clone');
    $numberPosts = get_field('number_of_posts');
    $hideBlockFrontend = get_field('hide_block_frontend');

    // Get Instagram Data.
    $json = file_get_contents(__DIR__ . '/instagram.json');
    $posts = json_decode($json, true);
    $posts = array_slice($posts, 0, $numberPosts);

    // Classes.
    $kkBlock = " block-" . $element;
    $classes = $kkBlock;

    if (isset($block['data']['block-preview'])) { ?>
        <img src="<?php echo $blockPath . str_replace("file:.","",$block['data']['block-preview']); ?>" />
    <?php } else {
?>
    <?php if (!$hideBlockFrontend) { ?>
        <?php if (count($posts)) { ?>
            <section id="instagram-<?php echo $presentation; ?>-section" class="block<?php echo $classes; ?> px-6 md:px-9 lg:px-12" <?php if (current_user_can('administrator')) { echo " " . $path; } ?>>
                <div class="wrapper">

                    <?php include dirname(dirname(__FILE__)) . "/_clone/headline/headline.php"; ?>

                    <div class="gallery-grid instagram-<?php echo $presentation; ?> <?php if ($presentation === 'slider') { ?> swiper-container relative overflow-hidden<?php } ?>">
                        <ul class="<?php if ($presentation === 'wall') { ?>flex flex-wrap -mx-4 <?php } elseif ($presentation === 'slider') { ?>swiper-wrapper flex relative w-full h-full transition-transform<?php } ?>">
                            <?php
                                $logoAt = 5;
                                $iL = 0;


                                foreach ($posts as $post) {
                                    $pieces = explode(" ", $post['caption']);
                                    $firstPart = implode(" ", array_splice($pieces, 0, 25));
                                    $iL++;
                            ?>
                                <li class="<?php if ($presentation === 'wall') { ?>w-full py-8 px-4 group md:w-1/2 lg:w-1/3 <?php } elseif ($presentation === 'slider') { ?>swiper-slide shrink-0 block relative !h-[auto] group !transition-bg-color !ease-out !duration-300<?php } ?>">
                                    <?php if ($post["media_type"] == "VIDEO") { ?>
                                        <?php /* REEL */ ?>
                                            <a class="block no-underline" href="<?php echo $post['permalink']; ?>" target="_blank">
                                                <?php
                                                    $figureClass = "gallery-frame";
                                                    $pictureClass = "relative block w-full pt-[100%]";
                                                    $imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                                                    include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                                                ?>

                                                <div class="caption text-black py-4">
                                                    <div class="text-container">
                                                        <p><?php echo $firstPart; ?>...</p>
                                                    </div>

                                                    <div class="btn-container">
                                                        <div class="btn btn-primary group-hover:bg-secondary">
                                                            <span>
                                                                Zum Instagrampost
                                                            </span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" id="svg10654" height="512" viewBox="0 0 6.3499999 6.3500002" width="512"><g id="layer1" transform="translate(0 -290.65)"><path id="path9413" d="m.53383012 294.09009h4.64777838l-.8707478.87075c-.250114.25011.1250569.62528.375171.37517l.7930187-.79426.529381-.53021c.1025988-.10321.1025988-.26989 0-.3731l-1.3223997-1.32395c-.050312-.0517-.1195649-.0807-.1917197-.0801-.2381777.00003-.3550648.29011-.1834513.45527l.8728149.87075h-4.66353979c-.36681596.0182-.33942735.54794.0136943.52968z" font-variant-ligatures="normal" font-variant-position="normal" font-variant-caps="normal" font-variant-numeric="normal" font-variant-alternates="normal" font-feature-settings="normal" text-indent="0" text-align="start" text-decoration-line="none" text-decoration-style="solid" text-decoration-color="rgb(0,0,0)" text-transform="none" text-orientation="mixed" white-space="normal" shape-padding="0" isolation="auto" mix-blend-mode="normal" solid-color="rgb(0,0,0)" solid-opacity="1" vector-effect="none"/></g></svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                    <?php } else { ?>
                                        <?php  if ($iL == $logoAt) { //platziere Logo an Stelle 5 ?>
                                            <?php /* Logo*/ ?>
                                            <?php if(!empty($socialMediaButton['url'])) { ?>
                                                <a class="img-link" href="<?php echo $socialMediaButton['url']; ?>" target="_blank">
                                            <?php } else { ?>
                                                <div>
                                            <?php } ?>
                                                <?php
                                                    $figureClass = "gallery-frame logo";
                                                    $pictureClass = "relative block w-full pt-[100%]";
                                                    $imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                                                    include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                                                ?>

                                                <div class="btn-container">
                                                    <span class="btn">
                                                        Jetzt folgen
                                                    </span>
                                                </div>

                                                <svg class="hidden" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.262 415.261" style="enable-background:new 0 0 415.262 415.261;" xml:space="preserve">
                                                    <g>
                                                        <path d="M414.937,374.984c-7.956-24.479-20.196-47.736-30.601-70.992c-1.224-3.06-6.12-3.06-7.956-1.224   c-10.403,11.016-22.031,22.032-28.764,35.496h-0.612c-74.664,5.508-146.88-58.141-198.288-104.652   c-59.364-53.244-113.22-118.116-134.64-195.84c-1.224-9.792-2.448-20.196-2.448-30.6c0-4.896-6.732-4.896-7.344,0   c0,1.836,0,3.672,0,5.508C1.836,12.68,0,14.516,0,17.576c0.612,6.732,2.448,13.464,3.672,20.196   C8.568,203.624,173.808,363.356,335.376,373.76c-5.508,9.792-10.403,20.195-16.523,29.988c-3.061,4.283,1.836,8.567,6.12,7.955   c30.6-4.283,58.14-18.972,86.292-29.987C413.712,381.104,416.16,378.656,414.937,374.984z M332.928,399.464   c3.673-7.956,6.12-15.912,10.404-23.868c1.225-3.061-0.612-5.508-2.448-6.12c0-1.836-1.224-3.061-3.06-3.672   c-146.268-24.48-264.996-124.236-309.06-259.489c28.764,53.244,72.828,99.756,116.28,138.924   c31.824,28.765,65.484,54.468,102.204,75.888c28.764,16.524,64.872,31.824,97.92,21.421l0,0c-1.836,4.896,5.508,7.344,7.956,3.672   c7.956-10.404,15.912-20.196,24.48-29.376c8.567,18.972,17.748,37.943,24.479,57.527   C379.44,382.94,356.796,393.956,332.928,399.464z"/>
                                                    </g>
                                                </svg>

                                            <?php if(!empty($socialMediaButton['url'])) { ?>
                                                </a>
                                            <?php } else { ?>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php /* image */ ?>
                                            <a class="panel block no-underline" href="<?php echo $post['permalink']; ?>" target="_blank">
                                                <?php
                                                    $figureClass = "gallery-frame";
                                                    $pictureClass = "relative block w-full pt-[100%]";
                                                    $imageClass = "absolute top-0 left-0 right-0 bottom-0 w-full h-full object-cover object-center";
                                                    include dirname(dirname(__FILE__)) . "/_clone/image/image.php";
                                                ?>

                                                <div class="caption text-black pt-4">
                                                    <p><?php echo $firstPart; ?>...</p>
                                                    <span class="btn btn-primary inline-block mt-6">Zum Instagrampost</span>
                                                </div>
                                            </a>
                                        <?php } ?>

                                    <?php } ?>
                                </li>

                            <?php } ?>
                        </ul>

                        <?php if ($presentation === 'slider') { ?>
                            <div class="swiper-btn-container flex mt-6 justify-between lg:absolute lg:top-1/2 lg:left-0 lg:w-full lg:px-4 lg:-translate-y-1/2">
                                <button class="swiper-btn-prev text-white bg-primary w-10 h-10 flex items-center justify-center rounded-full p-2" aria-label="Zurück" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                    </svg>
                                </button>

                                <button class="swiper-btn-next text-white bg-primary w-10 h-10 flex items-center justify-center rounded-full p-2" aria-label="Weiter" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>
<?php } ?>
