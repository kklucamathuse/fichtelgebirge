<?php
    /** add actions + filter */
    add_action('admin_footer','posts_status_color');

    /** define functions */
    function posts_status_color(){
?>
    <style>
        .updates-table tbody td.check-column, 
        .widefat tbody th.check-column, 
        .widefat tfoot td.check-column, 
        .widefat thead td.check-column {
            padding-right: 3px !important;
            position: relative !important;
            padding-left: 16px !important;
        }

        #the-list tr th.check-column:before {
            content: ""; 
            position: absolute; 
            left: 0; 
            top: 2%; 
            width: 5px; 
            height: 96%;
        }

        .status-publish th.check-column:before {
            background: #388E3C !important; /* green */ 
        }

        .status-draft th.check-column:before {
            background: #0288D1 !important; /* blue */ 
        }

        .status-pending th.check-column:before {
            background: #E64A19 !important; /* orange */ 
        }

        .status-publish.post-password-required th.check-column:before {
            background: #7B1FA2 !important; /* purple */
        }

        .status-future th.check-column:before {
            background: #CDDC39 !important; /* lime */ 
        }

        .status-private th.check-column:before {
            background: #455A64 !important; /* dark */ 
        }
    </style>
<?php
}
