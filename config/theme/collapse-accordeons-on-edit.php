<?php
    /** add actions + filter */
    add_action('acf/input/admin_head', 'collapse_accordions');

    /** define functions */
    function collapse_accordions() {
?>
    <script type="text/javascript">
        jQuery(document).ready(function(){

            setTimeout(function() { 
                jQuery( ".interface-interface-skeleton__content .acf-field-accordion" ).each(function() {
                    if (jQuery(this).hasClass("-open")) {
                        jQuery(this).removeClass("-open");
                        jQuery(this).find(".acf-accordion-content").hide();
                        jQuery(this).find("svg").css('transform', 'translateY(-50%) scaleY(-1)')
                    }
                });
            }, 200);
            

        });
    </script>
<?php
    }