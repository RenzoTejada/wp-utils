<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

function rt_utils_loaded()
{
    rt_utils_disable_rsd();
    rt_utils_remove_wp_ver();
    rt_utils_remove_wlwmanifest();
    rt_utils_remove_shortlink();
    rt_utils_disable_api();
    rt_utils_remove_discore_links();
}

add_action('admin_menu', 'rt_utils_register_admin_page');

function rt_utils_register_admin_page()
{
    add_menu_page('Utils', __('Utils', 'rt-wp-utils'), 'manage_options', 'page_utils', '', 'dashicons-admin-settings', 60);
    add_submenu_page('page_utils', __('Settings', 'rt-wp-utils'), __('Settings', 'rt-wp-utils'), 'manage_options', 'utils_settings', 'rt_utils_submenu_settings_callback');
    remove_submenu_page('page_utils', 'page_utils');
    add_action('admin_init', 'rt_utils_register_settings');
}

function rt_utils_register_settings()
{
    register_setting('utils_settings_group', 'utils_disable_rsd_checkbox');
    register_setting('utils_settings_group', 'utils_remove_wp_ver_checkbox');
    register_setting('utils_settings_group', 'utils_remove_wlwmanifest_checkbox');
    register_setting('utils_settings_group', 'utils_remove_shortlink_checkbox');
    register_setting('utils_settings_group', 'utils_disable_api_checkbox');
    register_setting('utils_settings_group', 'utils_remove_discore_links_checkbox');
}

function rt_utils_submenu_settings_callback()
{
    if (current_user_can('manage_options')) {
        ?>
        <div class="wrap woocommerce">
            <div style="background-color:#87b43e;">
            </div>
            <h1><?php _e('WP Utils', 'rt-wp-utils') ?></h1>
            <hr>
            <h2 class="nav-tab-wrapper">
                <a href="?page=utils_settings" class="nav-tab <?php
                if ((!isset($_REQUEST['tab']))) {
                    print " nav-tab-active";
                } ?>"><?php _e('Docs', 'rt-wp-utils') ?></a>
                <a href="?page=utils_settings&tab=settings" class="nav-tab <?php
                if ((isset($_REQUEST['tab']) == 'settings')) {
                    print " nav-tab-active";
                } ?>"><?php _e('Settings', 'rt-wp-utils') ?></a>

            </h2>
            <?php
            if ((!isset($_REQUEST['tab'])) || ($_REQUEST['tab'] == "home")) {
                rt_utils_submenu_settings_docs();
            }
            if (($_REQUEST['tab'] == "settings")) {
                rt_utils_submenu_settings_settings();
            }
            ?>
        </div>
        <?php
    }
}

function rt_utils_submenu_settings_docs()
{
    ?>
    <h1 class="hndle ui-sortable-handle"><?php _e('Docs Utils', 'rt-wp-utils'); ?></h1>
    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
        <br>
        <div id="dashboard_right_now" class="postbox">
            <div class="inside">
                <h3 class="main"><?php _e('Functions rt_utils_limit_words', 'rt-wp-utils'); ?> </h3>
                <div class="main">
                    <ul>
                        <li><?php _e('rt_utils_limit_words', 'rt-wp-utils'); ?>
                            : <?php _e('Cuts a text string into a certain number of words number of words', 'rt-wp-utils'); ?>
                        </li>
                        <li>Ej: <code> esc_html(rt_utils_limit_words($string, $int))</code>
                        </li>
                        <li>$string : <?php _e('text string ', 'rt-wp-utils'); ?>(ej: get_the_content())</li>
                        <li>$int :<?php _e('number of words to be displayed (whole number)', 'rt-wp-utils'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="dashboard_right_now" class="postbox">
            <div class="inside">
                <h3 class="main"><?php _e('Functions rt_utils_getNameDaySpanish', 'rt-wp-utils'); ?> </h3>
                <div class="main">
                    <ul>
                        <li><?php _e('rt_utils_getNameDaySpanish', 'rt-wp-utils'); ?>
                            : <?php _e('Returns the name of the day in Spanish', 'rt-wp-utils'); ?> </li>
                        <li>Ej: <code> esc_html(rt_utils_getNameDaySpanish(date('d'))); </code></li>
                        <li>$d : <?php _e('DATE OF DAY', 'rt-wp-utils'); ?> => date('d')</li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="dashboard_right_now" class="postbox">
            <div class="inside">
                <h3 class="main"><?php _e('Functions rt_utils_getNameMonthSpanish', 'rt-wp-utils'); ?> </h3>
                <div class="main">
                    <ul>
                        <li><?php _e('rt_utils_getNameMonthSpanish', 'rt-wp-utils'); ?>
                            : <?php _e('Returns the name of the month in Spanish', 'rt-wp-utils'); ?> </li>
                        <li>Ej: <code> esc_html(rt_utils_getNameMonthSpanish(date('m')));</code></li>
                        <li>$m : <?php _e('number of the month', 'rt-wp-utils'); ?> => date('m')</li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="dashboard_right_now" class="postbox">
            <div class="inside">
                <h3 class="main"><?php _e('Functions rt_utils_addHttp', 'rt-wp-utils'); ?></h3>
                <div class="main">
                    <ul>
                        <li><?php _e('rt_utils_addHttp', 'rt-wp-utils'); ?>
                            : <?php _e('Add http to domains or urls', 'rt-wp-utils'); ?></li>
                        <li>Ej: <code> esc_html(rt_utils_addHttp($url)); </code></li>
                        <li>$url : <?php _e('url without protocol (http)', 'rt-wp-utils'); ?> </li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="dashboard_right_now" class="postbox">
            <div class="inside">
                <h3 class="main"><?php _e('Functions rt_utils_addHttps', 'rt-wp-utils'); ?> </h3>
                <div class="main">
                    <ul>
                        <li><?php _e('rt_utils_addHttps', 'rt-wp-utils'); ?>
                            : <?php _e('Adding https to domains or urls', 'rt-wp-utils'); ?> </li>
                        <li>Ej: <code> esc_html(rt_utils_addHttps(url)); </code></li>
                        <li>$url : <?php _e('url with protocol (https)', 'rt-wp-utils'); ?> </li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
}

function rt_utils_submenu_settings_settings()
{

    ?>
    <h2><?php _e('Setting', 'rt-wp-utils') ?></h2>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields('utils_settings_group'); ?>
        <?php do_settings_sections('utils_settings_group'); ?>

        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label><?php _e('Disable  XML-RPC RSD', 'link-bio') ?></label>
                </th>
                <td class="forminp forminp-checkbox">
                    <input type="checkbox" name="utils_disable_rsd_checkbox" id="utils_disable_rsd_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_disable_rsd_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Remove WordPress version number', 'link-bio') ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_wp_ver_checkbox" id="utils_remove_wp_ver_checkbox"
                           value="on"
                        <?php if (esc_attr(get_option('utils_remove_wp_ver_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Remove wlwmanifest link', 'link-bio') ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_wlwmanifest_checkbox"
                           id="utils_remove_wlwmanifest_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_remove_wlwmanifest_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Remove shortlink', 'link-bio') ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_shortlink_checkbox" id="utils_remove_shortlink_checkbox"
                           value="on"
                        <?php if (esc_attr(get_option('utils_remove_shortlink_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Disable Link header for the REST API', 'link-bio') ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_disable_api_checkbox" id="utils_disable_api_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_disable_api_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php _e('Remove oEmbed discovery links', 'link-bio') ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_discore_links_checkbox"
                           id="utils_remove_discore_links_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_remove_discore_links_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit">
            <?php submit_button(__('Save Changes', 'rt-wp-utils')); ?>

        </p>
    </form>
    <?php
}