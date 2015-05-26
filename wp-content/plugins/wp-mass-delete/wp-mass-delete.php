<?php
/*
  Plugin Name: WP Mass Delete
  Version: 1.8
  Author: CyberSEO.NET
  Author URI: http://www.cyberseo.net/
  Plugin URI: http://www.cyberseo.net/wp-mass-delete/
  Description: This plugin is intended to mass delete WordPress posts and pages. Please use it with caution!
 */

if (!function_exists("get_option") || !function_exists("add_filter")) {
    die();
}

function wpmd_show_menu() {
    global $wpdb, $wp_version;
    ?>
    <div class="wrap">
        <p><a href="http://www.cyberseo.net/" target="_blank"><img src="<?php echo WP_PLUGIN_URL; ?>/wp-mass-delete/images/468x60.jpg" style="float:right;" /></a></p>
        <h2>WP Mass Delete</h2>
        <p>This plugin is intended to mass delete WordPress posts and pages. Please use it with caution!</p>

        <div class="metabox-holder postbox-container">

            <form method="post">
                <table class="form-table">
                    <tr>
                        <th scope="row">Date interval</th>
                        <td align="left"><input type="text" name="start_date" value=""
                                                size="10"> - <input type="text" name="end_date" value=""
                                                size="10">
                            <p class="description">set the date interval, or leave these fields blank to select all posts. The dates must be specified in the following format: <strong>YYYY-MM-DD</strong></p>
                        </td>
                    </tr>
                    <?php
                    if (version_compare($wp_version, '2.1', '>=')) {
                        ?>
                        <tr valign="top">
                            <th scope="row">Type of items to delete</th>
                            <td align="left"><input type="checkbox" name="posts" checked> - posts
                                &nbsp;&nbsp; <input type="checkbox" name="pages"> - pages</td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <th scope="row">Post status</th>
                        <td align="left"><input type="checkbox" name="publish" checked> -
                            published &nbsp;&nbsp; <input type="checkbox" name="future"> -
                            scheduled &nbsp;&nbsp; <input type="checkbox" name="pending"> -
                            pending &nbsp;&nbsp; <input type="checkbox" name="draft"> -
                            draft &nbsp;&nbsp; <input type="checkbox" name="private"> -
                            private</td>
                    </tr>
                    <tr>
                        <th scope="row">If post contains</th>
                        <td align="left"><input type="text" name="content" value=""
                                                size="60"> then <select name="action">
                                <option selected value="delete">Delete it</option>
                                <option value="do_not_delete">Don't delete it</option>
                            </select> <br />
                        </td>
                    </tr>
                    <?php
                    if (version_compare($wp_version, '2.9', '>=')) {
                        ?>
                        <tr>
                            <th scope="row">Bypass trash</th>
                            <td align="left"><input type="checkbox" name="force_delete"> 
                                <p class="description">enable this option to completely delete the specified posts.</p>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <br />
                <input type="submit" name="delete" class="button-primary" value="Delete the posts" />&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" class="button" onclick="javascript:history.go(-1)" />
            </form>
            
        </div>
        
    </div>
    <?php
    if (isset($_POST ['delete'])) {
        $type = array();
        if (@$_POST ['posts'] == "on") {
            $type [] = "'post'";
        }
        if (@$_POST ['pages'] == "on") {
            $type [] = "'page'";
        }
        $status = array();
        if (@$_POST ['publish'] == "on") {
            $status [] = "'publish'";
        }
        if (@$_POST ['pending'] == "on") {
            $status [] = "'pending'";
        }
        if (@$_POST ['draft'] == "on") {
            $status [] = "'draft'";
        }
        if (@$_POST ['private'] == "on") {
            $status [] = "'private'";
        }
        if (@$_POST ['future'] == "on") {
            $status [] = "'future'";
        }
        if ((count($type) || version_compare($wp_version, '2.1', '<')) && count($status)) {
            @set_time_limit(60 * 30);
            $query = "SELECT ID FROM $wpdb->posts WHERE post_status IN (" . implode(",", $status) . ")";
            if (version_compare($wp_version, '2.1', '>=')) {
                $query .= " AND post_type IN (" . implode(",", $type) . ")";
            }
            if ($_POST ['start_date'] != "") {
                $query .= " AND post_date >= '" . $_POST ['start_date'] . " 00:00:00'";
            }
            if ($_POST ['end_date'] != "") {
                $query .= " AND post_date <= '" . $_POST ['end_date'] . " 23:59:59'";
            }
            if ($_POST ['content'] != "") {
                $content = $wpdb->escape($_POST ['content']);
                if ($_POST ['action'] == "delete") {
                    $query .= " AND post_content LIKE '%{$content}%'";
                } else {
                    $query .= " AND post_content NOT LIKE '%{$content}%'";
                }
            }
            $post_ids = $wpdb->get_col($query);
            $cnt = count($post_ids);
            if ($cnt) {
                echo "<br \><div id=\"message\" class=\"updated fade\">Deleting <strong>$cnt</strong> items...";
                foreach ($post_ids as $id) {
                    if (version_compare($wp_version, '2.9', '>=')) {
                        wp_delete_post($id, @$_POST ['force_delete'] == "on");
                    } else {
                        wp_delete_post($id);
                    }
                }
                echo "Done!</div><br \>";
                return;
            }
        }
        echo "<br \><div id=\"message\" class=\"updated fade\">Nothing to delete.</div><br \>";
    }
}

function wpmd_main_menu() {
    if (function_exists('add_options_page')) {
        add_options_page(__('WP Mass Delete'), __('WP Mass Delete'), 'manage_options', 'wp_mass_delete', 'wpmd_show_menu');
    }
}

if (is_admin()) {
    add_action('admin_menu', 'wpmd_main_menu');
}
?>