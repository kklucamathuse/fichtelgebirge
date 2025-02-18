<div class="video-container <?php if(!empty($containerClass)) { echo $containerClass; } ?>" x-data="{ playVideo: false }" x-init="$watch('playVideo', function(value) {
    if (value) {
        setTimeout(function() {
            $refs.video.play();
        }, 450);
    } else {
        $refs.video.pause();
    }
})">
    <div class="video-inner">
        <div class="play-button-container absolute top-0 left-0 right-0 bottom-0 w-16 h-16 m-auto bg-white rounded-full z-20 lg:w-20 lg:h-20" x-show="!playVideo" x-transition:leave="transition ease-in duration-450" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <button class="play-button w-full h-full flex items-center justify-center" type="button" aria-label="Video abspielen" @click="playVideo = !playVideo">
                <span class="w-0 h-0 border-solid border-y-8 border-l-8 border-t-transparent border-r-transparent border-b-transparent border-l-primary"></span>
            </button>
        </div>

        <?php if ($videoType === "youtube") { ?>
            <div class="video-poster <?php if(!empty($videoPosterContainerClass)) { echo $videoPosterContainerClass; } ?>" @click="playVideo = !playVideo" x-show="!playVideo" x-transition:leave="transition ease-in duration-450" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <img class="lazy <?php if(!empty($videoPosterClass)) { echo $videoPosterClass; } ?>" alt="YouTube video player" data-src="https://img.youtube.com/vi/<?php echo $videoYtUri; ?>/maxresdefault.jpg" src="https://img.youtube.com/vi/<?php echo $videoYtUri; ?>/hqdefault.jpg">
            </div>

            <iframe class="youtube-video <?php if(!empty($iframeContainerClass)) { echo $iframeContainerClass; } ?>" src="https://www.youtube-nocookie.com/embed/<?php echo $videoYtUri; ?>?showinfo=0&rel=0" title="Youtube Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <?php } elseif ($videoType === "video") { ?>

            <?php if (!empty($videoPoster)) { ?>
                <div class="video-poster <?php if(!empty($videoPosterContainerClass)) { echo $videoPosterContainerClass; } ?>" @click="playVideo = !playVideo" x-show="!playVideo" x-transition:leave="transition ease-in duration-450" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    <?php 
                        $image = $videoPoster;
                        $imageClass = $videoPosterClass;
                        include dirname(dirname(__FILE__)) . "/image/image.php";
                    ?>
                </div>
            <?php } ?>

            <video class="video <?php if(!empty($videoClass)) { echo $videoClass; } ?>" width="300" height="200" x-bind:controls="playVideo" <?php if (!empty($videoPoster)) { ?> poster="<?php echo $videoPoster['sizes']["small"]; ?>" <?php } else { ?> preload="metadata" <?php } ?> x-ref="video">
                <source src="<?php echo $videoUri; if (empty($videoPoster)) { ?>#t=0.1<?php } ?>" type="<?php echo $videoMimeType; ?>" />
            </video>

        <?php } ?>
    </div>
</div>