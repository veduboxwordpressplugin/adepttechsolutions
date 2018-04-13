<link rel='stylesheet' id='bootstrap-select-css'  href='<?php echo TSCORE_ASSETS_URL.'/css/plugin_style.css'; ?>' type='text/css' media='all' />
<?php
global $wpdb;
$execute1 = $wpdb->get_results("select * from lms_setting");
$login_button  = $execute1[0]->login_button ;
?>
 <a href="http://demo.vedubox.net/pages/login" target="_blank" class="btn btn-info btn-sm"><?php if(isset($login_button)){echo $login_button;}else{ echo "Login";}?></a>