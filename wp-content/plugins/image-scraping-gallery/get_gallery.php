<?php
$url = $_POST['sit_urls'];
include_once($url . '/wp-load.php');
require_once($url . '/wp-admin/includes/media.php');
require_once($url . '/wp-admin/includes/file.php');
require_once($url . '/wp-admin/includes/image.php');
$columns_number = $_POST['columns_number'];
$post_id = $_POST['post_id'];
$gallary_ids = array();
$gallary_id_ist = array();
$post_data = json_decode(stripslashes($_POST['data']));
foreach ($post_data as $image_urls1) {
    $url = $image_urls1;
    $tmp = download_url($url);
    $file_array = array(
        'name' => basename($url),
        'tmp_name' => $tmp
    );
    $id = media_handle_sideload($file_array, $post_id);
    $gallary_id_ist[] = $id;
    $attachment_url = wp_get_attachment_url($id);
}
$gallary_ids['Gallery'] = $gallary_id_ist;
$all_ids = implode(",", $gallary_ids['Gallery']);
?>
[gallery columns="<?php echo $columns_number; ?>" ids="<?php echo $all_ids; ?>"]