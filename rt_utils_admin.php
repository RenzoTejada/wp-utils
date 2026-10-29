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
    if (!current_user_can('manage_options')) { return; }
    $tab = isset($_GET['tab']) ? sanitize_key(wp_unslash($_GET['tab'])) : 'settings';
    if (!in_array($tab, array('settings', 'docs', 'contact'), true)) { $tab = 'settings'; }
    $base = admin_url('admin.php?page=utils_settings');
    ?>
    <div class="wrap rt-utils-wrap">
        <div class="rt-utils-heading"><div><h1><?php esc_html_e('Utils para WooCommerce y WordPress', 'rt-wp-utils'); ?></h1><p><?php esc_html_e('Configura pequeñas utilidades y consulta las funciones disponibles.', 'rt-wp-utils'); ?></p></div><span class="rt-utils-version">v<?php echo esc_html(Version_RT_WP_Utils); ?></span></div>
        <nav class="nav-tab-wrapper rt-utils-tabs" aria-label="<?php esc_attr_e('Secciones', 'rt-wp-utils'); ?>">
            <a class="nav-tab <?php echo $tab === 'settings' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url(add_query_arg('tab','settings',$base)); ?>"><?php esc_html_e('Configuración','rt-wp-utils'); ?></a>
            <a class="nav-tab <?php echo $tab === 'docs' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url(add_query_arg('tab','docs',$base)); ?>"><?php esc_html_e('Documentación','rt-wp-utils'); ?></a>
            <a class="nav-tab <?php echo $tab === 'contact' ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url(add_query_arg('tab','contact',$base)); ?>"><?php esc_html_e('Contacto','rt-wp-utils'); ?></a>
        </nav>
        <div class="rt-utils-content">
            <?php
            if ($tab === 'docs') { rt_utils_submenu_settings_docs(); }
            elseif ($tab === 'contact') { ?>
              <div class="rt-utils-card"><h2><?php esc_html_e('Ayuda y soporte','rt-wp-utils'); ?></h2><p><?php esc_html_e('Si necesitas una integración o soporte técnico, puedes comunicarte con el desarrollador.', 'rt-wp-utils'); ?></p><a class="button button-primary" href="https://renzotejada.com/contacto/" target="_blank" rel="noopener noreferrer"><?php esc_html_e('Contactar a Renzo Tejada','rt-wp-utils'); ?></a></div>
            <?php } else { rt_utils_submenu_settings_settings(); }
            ?>
        </div>
    </div>
    <?php
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
    <div class="rt-utils-card"><h2><?php esc_html_e('Configuración general', 'rt-wp-utils'); ?></h2><p><?php esc_html_e('Activa solo las opciones que necesitas. Los cambios se aplican al guardar.', 'rt-wp-utils'); ?></p>
    <?php settings_errors(); ?>
    <form method="post" action="options.php">
        <?php settings_fields('utils_settings_group'); ?>
        <?php do_settings_sections('utils_settings_group'); ?>

        <table class="form-table" aria-describedby="titledesc">
            <tbody>
            <tr valign="top">
                <th scope="row" class="titledesc">
                    <label><?php esc_html_e('Desactivar enlace RSD de XML-RPC', 'rt-wp-utils'); ?></label>
                </th>
                <td class="forminp forminp-checkbox">
                    <input type="checkbox" name="utils_disable_rsd_checkbox" id="utils_disable_rsd_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_disable_rsd_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php esc_html_e('Ocultar la versión de WordPress', 'rt-wp-utils'); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_wp_ver_checkbox" id="utils_remove_wp_ver_checkbox"
                           value="on"
                        <?php if (esc_attr(get_option('utils_remove_wp_ver_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php esc_html_e('Eliminar enlace WLW Manifest', 'rt-wp-utils'); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_wlwmanifest_checkbox"
                           id="utils_remove_wlwmanifest_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_remove_wlwmanifest_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php esc_html_e('Eliminar enlace corto (shortlink)', 'rt-wp-utils'); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_remove_shortlink_checkbox" id="utils_remove_shortlink_checkbox"
                           value="on"
                        <?php if (esc_attr(get_option('utils_remove_shortlink_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php esc_html_e('Eliminar enlace de la API REST en el encabezado', 'rt-wp-utils'); ?></label>
                </th>
                <td>
                    <input type="checkbox" name="utils_disable_api_checkbox" id="utils_disable_api_checkbox" value="on"
                        <?php if (esc_attr(get_option('utils_disable_api_checkbox')) == "on") echo "checked"; ?> />
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label><?php esc_html_e('Eliminar enlaces de descubrimiento oEmbed', 'rt-wp-utils'); ?></label>
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
            <?php submit_button(__('Guardar cambios', 'rt-wp-utils')); ?>

        </p>
    </form></div>
    <?php
}