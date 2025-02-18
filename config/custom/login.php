<?php
    /** add actions + filter */
    add_action( 'login_enqueue_scripts', 'my_login_logo' );

    /** define functions */
    function my_login_logo() { ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php bloginfo('template_directory')?>/assets/img/backend/login.png);
                width: 300px;
                height: 28px;
                background-size: 300px 28px;
            }
        </style>
    <?php }

