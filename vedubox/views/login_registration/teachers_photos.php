<?php 

function callAPI($method, $url, $data = false)
{
    if(empty($url)) throw new Exception('URL missing');	
    $curl = curl_init();

    switch ($method)
    {
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
$api_full_url = $api_url.'/api/veduApi/getTeachersPictures?token='.$token;
$response = callAPI('GET', $api_full_url);

//$response = callAPI('GET', 'http://demo.vedubox.net/api/veduApi/getTeachersPictures?token=3353143f92');

$response = json_decode($response);

$response_counter = count($response);

if($response_counter <= 1){
	?><div class="col-md-12 col-xs-12 back_">
 <div class="wrapper">
  <div class="wrapper_inner">
  <div class="t_list" ><h3> Teachers Photos</h3></div>
	</div>
	<center><h3><span>Not any data come from API.Please contact to admin or check API and Token.</span></h3></center>
	</div>
	<br/>
	<br/>
	<br/>
	</div><?php
	exit;
}
/* echo '<pre>';
print_r($response);
echo '</pre>'; */

$total_teachers = count($response);
$page = empty( $_REQUEST['set'] ) ? 1 : $_REQUEST['set'];
$limit = 8;
$offset = ($page - 1) * $limit;
?><?php $newArray = array_slice($response, $offset, $limit, true); ?>
<link rel='stylesheet' id='bootstrap-select-css'  href='<?php echo TSCORE_ASSETS_URL.'/css/plugin/style_teacher_photos.css'; ?>' type='text/css' media='all' />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="col-md-12 col-xs-12 back_">
 <div class="wrapper">
  <div class="wrapper_inner">
  <div class="t_list"><h3> Teachers Photos</h3></div>
    <!-- Gallery -->
    <section class="gallery">
      <!-- Gallery  item Start from here -->   
	  <?php $i=1; foreach($newArray as $result) {  ?>
	  <div class="gallery_item">
        <!-- Gallery  item preview -->
        <span class="gallery_item_preview">
          <a href="#" data-js="<?php echo $i; ?>">
            <?php if($result->pictureUrl == null){?>
			<img src="https://25.media.tumblr.com/1adc4029ef3a31124f222add70fa3553/tumblr_n2k1499dIp1st5lhmo1_1280.jpg" alt="" /><?php }else{?>
			<img src="<?php echo $result->pictureUrl; ?>" alt="" />
			<?php } ?>
			<span>
            <h3><?php echo $result->fullName; ?></h3>
            </span></a>

        </span>
        <!-- Gallery  item full -->
        <div data-lk="<?php echo $i; ?>" class="gallery_item_full">
          <div class="box">
            <?php if($result->pictureUrl == null){?>
			<img src="https://25.media.tumblr.com/1adc4029ef3a31124f222add70fa3553/tumblr_n2k1499dIp1st5lhmo1_1280.jpg" alt="" /><?php }else{?>
			<img src="<?php echo $result->pictureUrl; ?>" alt="" />
			<?php } ?>
            <h3><?php echo $result->fullName; ?></h3>
           
		  </div>
        </div>
      </div>
	   <?php $i++;} ?>
	   <!-- pagination -->
     	 <nav aria-label="Page navigation"> 
			<ul class="pagination">
					<?php echo backend_pagination($total_teachers, $limit, $page); ?>
		    </ul>
		  </nav>
	           <!-- End pagination -->
<!-- Gallery  item End from here -->
	</section>
  </div>
</div>
</div>
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/index_teachers_photos.js'; ?>"></script>
<?php
add_action('wp_footer','myscript_in_footer');
function myscript_in_footer(){
?>
<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/index_teachers_photos.js'; ?>"></script>
<?php
}
?>