<?php
/* Uninstall File IT Popup */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
/* Deleting Options */
delete_option('lpl_LoginPageLogo_option_name');

?>