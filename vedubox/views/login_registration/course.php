<link rel='stylesheet' id='bootstrap-select-css'  href='<?php echo TSCORE_ASSETS_URL.'/css/plugin_style.css'; ?>' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-select-css'  href='<?php echo TSCORE_ASSETS_URL.'/css/plugin/style.css'; ?>' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-select-css'  href='<?php echo TSCORE_ASSETS_URL.'/css/plugin/bootstrap.css'; ?>' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-select-css'  href='<?php echo TSCORE_ASSETS_URL.'/css/plugin/style_teachers.css'; ?>' type='text/css' media='all' />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php 
session_start();
$qs = http_build_query($_GET);
if($qs == ''){
	unset($_SESSION['Search_C_response']);
	$Search_C_response = array();
}
function callAPI($method, $url, $data = false)
{
    if(empty($url)) throw new Exception('URL missing');	
    $curl = curl_init();
    switch ($method)    {
        case 'POST':
		curl_setopt($curl, CURLOPT_POST, 1);
            if (!empty($data))
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT'); 		
            if (!empty($data))
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));		
			break;
        case 'GET':
            if (!empty($data))
                $url = sprintf('%s?%s', $url, http_build_query($data));
	    break;
        default: throw new Exception('Unsupported method: ' . $method); 
    }
  
    // Exchange format - JSON
    $headers = array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, 'username:password');

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    return curl_exec($curl);
}
global $wpdb;
$execute1 = $wpdb->get_results("select * from lms_setting");
$api_url = $execute1[0]->url;
$token = $execute1[0]->token;
//http://demo.vedubox.net/api/veduApi/getPackagesByTags?token=b4a7dd1f90&tags=&packageType=1
//http://demo.vedubox.net/API/api/packageDetail/getPackageDetailsForPackageDetailList?url=http://demo.vedubox.net
//http://demo.vedubox.net/api/veduApi/getPackagesByTags?token=b4a7dd1f90&tags=&packageType=1
$api_full_url = $api_url.'/api/veduApi/getPackagesByTags?token=b4a7dd1f90&tags=&packageType=1';
//$api_full_url = $api_url.'/API/api/packageDetail/getPackageDetailsForPackageDetailList?url=http://demo.vedubox.net';
$response = callAPI('GET', $api_full_url);


$response1 = json_decode($response);

$response1_count = count($response1);

/* 
for($i = 0;$i<=$response1_count;$i++){
	$packageDetails_count = count($response1[$i]->packageDetails);
		if($packageDetails_count > 0){
			echo '<pre>';
			echo $response1[$i]->description;	
			print_r($response1[$i]->packageDetails);	
			echo $response1[$i]->packageDetails[0]->id;
			echo '</pre>';
		}
}


exit; */

if($response1_count <= 0){
	?>
	<div class="col-md-12 col-xs-12 back_">
 <div class="wrapper">
  <div class="wrapper_inner">
  <div class="t_list" style="margin-bottom: 30px;
    color: #fff;"><h3>Course List</h3></div>
	</div>
	<center><h3><span>Not any data come from API.Please contact to admin or check API and Token.</span></h3></center>
	</div>
	<br/>
	<br/>
	<br/>
	</div>
	<?php
	exit;
}



//http://demo.vedubox.net/API/api/packageDetail/getPackageDetailsForPackageDetailList?url=http://demo.vedubox.net
//$response_count = count($response_counter);
//print_r($response);
/* if($response_counter > 0){
$response = json_decode($response);
$arrays1 = $response->packageDetails;
$category = array();
$i = 0;
foreach($arrays1 as $result){
	foreach($result->categoriesList as $cat ){
		$category[$i++] = $cat;
	}
}
$category = array_unique($category);
$category = array_values($category);
$cat_count = count($category);
} */
$Search_course_count = 0;
$Search_C_response = array();
$newArray = array();
if (isset($_POST['submit'])) {    
	$C_name = $_POST['S_course'];
	
	$execute1 = $wpdb->get_results("select * from lms_setting");
	$api_url_search = $execute1[0]->url;
	$token = $execute1[0]->token;
	$api_full_url = $api_url_search.'/api/veduApi/searchCourse?token='.$token.'&str='.$C_name;
	$Search_C_response = callAPI('GET', $api_full_url);
		
	$Search_C_response = json_decode($Search_C_response);
	
	
	
	if(array_key_exists("message",$Search_C_response)){		
		
	}else{
	if($Search_C_response > 0){	 
	$_SESSION['Search_C_response'] = $Search_C_response;	
	$Search_course_count = 0;
	$Search_course_count = count($Search_C_response);
	}else{
		$Search_C_response = array();
	}
	}
}
$total_items = $response1_count;
?>
<section class="pen">
	<div class="panel top">
	  <!--search start here-->
	<div class="search">
		<i> </i>
		<div class="s-bar">
		  <!-- <form>
			<input type="text" value="What do you want to learn?" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'What do you want to learn?';}">
			<input type="submit"  value="Search"/>
		  </form> -->
		  <form class="form-wrapper12" action="" method="post" >
			<div class="search-box">
				<input type="text" autocomplete="off" name="S_course" id="search"  />
				<input type="submit" name="submit" value="Search" id="submit">
				<div class="result"></div>
			</div>
			<!--<input type="text" id="search" name="S_course" placeholder="Search for..." required>-->
			
		</form>
		</div>
		
	</div>
		<!--search end here-->	
	</div>

</section><br/>
<div class="container">
	<div class="row login_btn">
		<?php echo do_shortcode( '[L_BUTTON]' ); ?>
	</div>
</div>

<?php 
if(isset($_SESSION['Search_C_response'])){
$Search_C_response = $_SESSION['Search_C_response'];
$total_teachers = count($Search_C_response);
$page = empty( $_REQUEST['set'] ) ? 1 : $_REQUEST['set'];
$limit = 5;
$offset = ($page - 1) * $limit;

$newArray = array_slice($Search_C_response, $offset, $limit, true);

}
$newArray_count = count($newArray);
if(($Search_course_count > 0) || ($newArray_count > 0)){				
?>
<?php
$execute1 = $wpdb->get_results("select * from lms_setting");
$course_search  = $execute1[0]->course_search ;
?>
<div class="col-md-12 col-xs-12">
<div class="col-md-9 col-xs-12">
<div class"t_list" style="margin-bottom: 30px;
    color: #4CAF50;margin-top:10%"><h3><?php if(isset($course_search)){echo $course_search;}else{ echo "Search Result";}?></h3></div>
  <!-- Start from here -->
 <?php foreach($newArray as $result){ ?>
  <div class="well">
      <div class="media">
      	<a class="pull-left" href="http://demo.vedubox.net/public/packageDetails/<?php echo $result->courseId; ?>"target="_blank" style="    width: 30%;    height: 180px;">
    		<img class="media-object" src="<?php echo TSCORE_ASSETS_URL.'/images_111.jpg'; ?>"  style="width:100%">
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading">Course Name : <span style="color:#4CAF50"><?php echo $result->name; ?></span><span> | Category Name : <span style="color:#4CAF50"><?php echo ' '.$result->categoryName; ?></span></span></h4>
              
          <p><?php if($result->description == ''){ echo "Description not available here..."; }else{ echo $result->description; } ?></p><br/>
		  <ul class="list-inline list-unstyled">
  			<li><span class="user-info"><i class="glyphicon glyphicon-envelope"></i> &nbsp; xyz@gmail.com </span></li>
            <li>|</li>
            <span class="user-info"><i class="glyphicon glyphicon-phone"></i> &nbsp; +919632587412</span>
           
			</ul>
		  <input type="hidden" value="<?php echo $result->categoryId; ?>" name="C_id" >
          <!--<ul class="list-inline list-unstyled">
  			<li><span class="user-info"><i class="glyphicon glyphicon-envelope"></i> &nbsp; <?php //echo $result->email; ?> </span></li>
            <li>|</li>
            <span class="user-info"><i class="glyphicon glyphicon-phone"></i> &nbsp; <?php //if($result->phoneNumber == ''){ echo "Phone Number not available here..."; }else{ echo $result->phoneNumber; } ?></span>
           
			</ul>-->
       </div>
    </div>
  </div> 
   <?php } ?>
   </div>
<div class="col-md-3 col-xs-12"></div>

   <!-- pagination -->
     	 <nav aria-label="Page navigation"> 
			<ul class="pagination">
					<?php echo backend_pagination($total_teachers, $limit, $page); ?>
		    </ul>
		  </nav>
	           <!-- End pagination -->
  <!-- End from here -->
</div>
<?php }else{?>
<?php
$execute1 = $wpdb->get_results("select * from lms_setting");
$course_list  = $execute1[0]->course_list ;
?>
    <!-- slider -->
    <div class="carousel-reviews broun-block">
        <div class="container">
		<div class"t_list" style="margin-bottom: 30px;
    color: #4CAF50;margin-top:10%"><h3><?php if(isset($course_list)){echo $course_list;}else{ echo "Course List";}?></h3></div>
		
					<div class="row<?php echo $a; ?>">                
						<br>
                
					   <?php 
					   
							for($i = 0;$i<$response1_count;$i++){
								$packageDetails_count = count($response1[$i]->packageDetails);
								if($packageDetails_count > 0){
								/* echo '<pre>';
								echo $response1[$i]->description;
								print_r($response1[$i]->packageDetails);
								echo $response1[$i]->packageDetails[0]->id;
								echo '</pre>'; */
							
					   
					   ?>
                        
						<!-- do daynimic from here start -->
                            <div class="col-md-3 col-xs-12">
                                <div class="example-1 card">
                                    <div class="wrapper">
                                        <div class="date">
                                            <span class="day"><?php echo $response1[$i]->description.'    '; echo $response1[$i]->packageDetails[0]->id; ?></span>
                                        </div>
										<?php if($response1[$i]->packageDetails[0]->imgUrl == null){?>
										<a href="http://demo.vedubox.net/public/packageDetails/<?php echo $response1[$i]->packageDetails[0]->id; ?>" target="_blank"><img class="media-object" src="<?php echo TSCORE_ASSETS_URL.'/images_111.jpg'; ?>" style="width:100%"></a>
										<?php }else{?>
										<a href="http://demo.vedubox.net/public/packageDetails/<?php echo $response1[$i]->packageDetails[0]->id; ?>"><img class="media-object" src="<?php echo $response1[$i]->packageDetails[0]->imgUrl; ?>"></a>
										<?php } ?>
                                        <div class="data">
										  <div class="content">
										<span class="btn btn-info btn-sm c_price"><?php echo '$'.$response1[$i]->packageDetails[0]->amount; ?></span>
											<span class="author"><?php echo $response1[$i]->packageDetails[0]->description; ?></span>			<center><a href="http://demo.vedubox.net/public/packageDetails/<?php echo $response1[$i]->packageDetails[0]->id; ?>" target="_blank"><button type="button" class="btn btn-info btn-sm">Get this course</button></a></center>									
										 </div>
									 </div>
                                    </div>
                                </div>
                            </div>	
								<?php }} ?>
						</div>	
				</div>
		</div>
	<?php } ?>
    <!-- slider -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?php
add_action('wp_footer','myscript_in_footer');
function myscript_in_footer(){
?>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
		var url = "<?php echo TSCORE_ASSETS_URL.'/backend-search.php';?>";
        if(inputVal.length){
			
            $.get(url, {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
<?php } ?>
