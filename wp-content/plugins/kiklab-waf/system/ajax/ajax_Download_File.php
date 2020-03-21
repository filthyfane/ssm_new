<?php


##### DOWNLOAD: a specified file
add_action('wp_ajax_KIK_ACTION_Download_File', 'KIK_ACTION_Download_File_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Download_File', 'KIK_ACTION_Download_File_FUNC');
function KIK_ACTION_Download_File_FUNC() {
	
	global $wpdb;
	
	//echo DrawObject($_POST);
	
	$filename = KIK_PLUGIN_ABSPATH . 'docs/' . $_POST['identifier'];
	if (file_exists($filename)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($filename));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		readfile($filename);
		exit;
	}
	wp_die();
}










/**/

?>