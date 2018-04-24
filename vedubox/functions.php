

<?php

/** Register the admin menu **/ 
 add_action('admin_menu', 'tscore2');
	function tscore2() {
		add_menu_page('TSCORE', 'Vedubox Info ', 'moderate_comments', 'tscore', 'landlord_fun', plugins_url('assets/iconplugin.png', __FILE__) , 30);
	}
//add_action('admin_menu','tscore_submenu_add_landlord');

function tscore1(){
	add_submenu_page('Vedubox','Vedubox','Vedubox Info','manage_options','Vedubox','landlord_info');
}
	
 function landlord_fun(){
	include_once(TSCORE_PLUGIN_PATH.'/admin/veduboxInfo.php');
} 

/**
VeduBox Setting Menu
*/
add_action('admin_menu','tscore_submenu_add_tenant');
 function tscore_submenu_add_tenant(){
	add_submenu_page('tscore','Tenant','Settings','manage_options','tenant','tenant_fun');
	}
function tenant_fun(){
	include_once(TSCORE_PLUGIN_PATH.'/admin/setting.php');
}

/**
VeduBox Plugin User Guide
*/
add_action('admin_menu','userGuide');
 function userGuide(){
	add_submenu_page('tscore','Tenant','User Guide','manage_options','guide','User_Guide');
	}
function User_Guide(){
	include_once(TSCORE_PLUGIN_PATH.'/admin/vedubox_user_guide.php');
}

 
/* LMS Learning Course ShortCode Start Here */

/**
 Course List Shortcode ---  Its come using api
*/
add_shortcode('COURSE','course_list');
	function course_list(){

		include_once(TSCORE_PLUGIN_PATH.'/views/login_registration/course.php');	
 }
 
/**
 Login Button ---  Its action go to client site.
*/
add_shortcode('L_BUTTON','l_Button');
	function l_Button(){

		include_once(TSCORE_PLUGIN_PATH.'/views/login_registration/login_button.php');	
 }

/**
 Teachers List ---  It will display list of teachers come from API .
*/
add_shortcode('TEACHER_LIST','teacher_list');
	function teacher_list(){

		include_once(TSCORE_PLUGIN_PATH.'/views/login_registration/teachers.php');	
 }
 
/**
 Teachers Photos ---  It will display list of teachers and photos come from API .
*/
add_shortcode('TEACHER_PTOTOS','teacher_photos');
	function teacher_photos(){

		include_once(TSCORE_PLUGIN_PATH.'/views/login_registration/teachers_photos.php');	
 }
 
/**
 Contract  Pagination Shortcode
*/
function backend_pagination($total_records, $limit, $set){
    global $wp_roles;
    $cur_role= array_shift(wp_get_current_user()->roles);
	$qs = http_build_query($_GET);
	$qs = str_replace('?set='.$set, '', $qs);
	$qs = str_replace('&set='.$set, '', $qs);
	$qs = str_replace('set='.$set, '', $qs);
	$identifier = (empty($qs)) ? '?' : '&';
	$identifier2 = (empty($qs)) ? '' : '?' ;
	
	$adjacents = 3;

	$total_sets = $total_records;
	
	 //$targetset = get_site_url()."/sample-page/".$identifier2.$qs; 	

	 

			//$action = $_GET['action'];
			$name = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
			if($name== 'teachers'){
				 $targetset = get_site_url()."/teachers/".$identifier2.$qs; 	
			}else if($name== 'teachers-photos'){
				$targetset = get_site_url()."/teachers-photos/".$identifier2.$qs; 	
			}else if($name== 'course-list-2'){
				$targetset = get_site_url()."/course-list-2/".$identifier2.$qs; 	
			}
		  	
		
  

	if ($set == 0) $set = 1;					//if no set var is given, default to 1.
	$prev = $set - 1;							//previous set is set - 1
	$next = $set + 1;	

	$lastset = ceil($total_sets/$limit);		//lastset is = total sets / items per set, rounded up.
	$lpm1 = $lastset - 1;						//last set minus 1

	$pagination = "";
	if($lastset > 1)
	{	
		$pagination .= "<div class=\"col-md-2 col-xs-12\"></div><div class=\"pagination\"><ul class=\"pagination modal-3\">";
		//previous button
		if ($set > 1) 
			$pagination.= "<li><a class=\"prev\" href=\"$targetset".$identifier."set=$prev\">&laquo; </a></li>";
		else
			$pagination.= "<li><a href=\"#\"><span class=\"disabled\">&laquo; </span></a></li>";	
		
		//sets	
		if ($lastset < 7 + ($adjacents * 2))	//not enough sets to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastset; $counter++)
			{
				if ($counter == $set)
					$pagination.= "<li class='active'><a href=\"#\" class=\"current\"><span>$counter</span></a></li>";
				else
					$pagination.= "<li><a href=\"$targetset".$identifier."set=$counter\">$counter</a></li>";					
			}
		}
		elseif($lastset > 5 + ($adjacents * 2))	//enough sets to hide some
		{
			//close to beginning; only hide later sets
			if($set < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $set)
						$pagination.= "<li class='active'><a href=\"#\" class=\"current\"><span>$counter</span></a></li>";
					else
						$pagination.= "<li><a href=\"$targetset".$identifier."set=$counter\">$counter</a></li>";					
				}
				$pagination.= "<li><a href=\"#\">...</a></li>";
				$pagination.= "<li><a href=\"$targetset".$identifier."set=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetset".$identifier."set=$lastset\">$lastset</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastset - ($adjacents * 2) > $set && $set > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$targetset".$identifier."set=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetset".$identifier."set=2\">2</a></li>";
				$pagination.= "<li><a href=\"#\">...</a></li>";
				for ($counter = $set - $adjacents; $counter <= $set + $adjacents; $counter++)
				{
					if ($counter == $set)
						$pagination.= "<li class='active'><a href=\"#\" class=\"current\"><span>$counter</span></a></li>";
					else
						$pagination.= "<li><a href=\"$targetset".$identifier."set=$counter\">$counter</a></li>";					
				}
				$pagination.= "<li><a href=\"#\">...</a></li>";
				$pagination.= "<li><a href=\"$targetset".$identifier."set=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$targetset".$identifier."set=$lastset\">$lastset</a></li>";		
			}
			//close to end; only hide early sets
			else
			{
				$pagination.= "<li><a href=\"$targetset".$identifier."set=1\">1</a></li>";
				$pagination.= "<li><a href=\"$targetset".$identifier."set=2\">2</a></li>";
				$pagination.= "<li><a href=\"#\">...</a></li>";
				for ($counter = $lastset - (2 + ($adjacents * 2)); $counter <= $lastset; $counter++)
				{
					if ($counter == $set)
						$pagination.= "<li class='active'><a href=\"#\" class=\"current\"><span>$counter</span></a></li>";
					else
						$pagination.= "<li><a href=\"$targetset".$identifier."set=$counter\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($set < $counter - 1) 
			$pagination.= "<li><a href=\"$targetset".$identifier."set=$next\"> &raquo;</a></li>";
		else
			$pagination.= "<li><a href=\"#\"><span class=\"disabled\"> &raquo;</span></a></li>";
		$pagination.= "</ul></div><div class=\"col-md-2 col-xs-12\"></div>\n";		
	}
		echo $pagination;
}
/**
  End Pagination
*/
?>