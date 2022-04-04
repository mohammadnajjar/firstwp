<?php
/**
 * Goto Top functions
 *
 * @since Promos 1.0.0
 *
 */

if (!function_exists('promos_go_to_top')) :
    function promos_go_to_top()
    {
    ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'promos'); ?>">
                <i class="fa fa-angle-double-up"></i>
            </a>
<?php
    } endif;
add_action('promos_go_to_top_hook', 'promos_go_to_top', 10, 1);