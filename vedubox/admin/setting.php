<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
global $wpdb;
$table_name = 'lms_setting';
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

		$wpdb->get_results("CREATE TABLE lms_setting(
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		url VARCHAR(250),
		token VARCHAR(50),
		course_list VARCHAR(30),
		course_search VARCHAR(30),
		teacher_list VARCHAR(30),
		teacher_photos VARCHAR(30),		
		login_button VARCHAR(30)		
		)");
	}
if (isset($_POST['submit'])) { 
//print_r($_POST);
//Array ( [url] => dfdfd [course_list] => fdf [course_search] => dfdf [teacher_list] => dfdf [teacher_photos] => dfdf [login_button] => dfdfdf [submit] => )
	
	
	$url = $_POST['url'];
	$token = $_POST['token'];
	$course_list = $_POST['course_list'];
	$course_search = $_POST['course_search'];
	$teacher_list = $_POST['teacher_list'];
	$teacher_photos = $_POST['teacher_photos'];
	$login_button = $_POST['login_button'];
	
	$query_setting = "SELECT * FROM lms_setting";
	$result = $wpdb->get_results($query_setting);
	$result_count = count($result);
	if($result_count > 0){
		$query_update = "update lms_setting set url = '$url' , token = '$token' , course_list = '$course_list' , course_search = '$course_search' , teacher_list = '$teacher_list' , teacher_photos = '$teacher_photos' , login_button = '$login_button' ";
		$result = $wpdb->query($query_update);
	}else{
		$query_insert = "insert into lms_setting (url,token,course_list,course_search,teacher_list,teacher_photos,login_button) values('$url','$token','$course_list','$course_search','$teacher_list','$teacher_photos','$login_button')";
		$result = $wpdb->query($query_insert);
	}
	//print_r($result);
	

}
	$query_setting = "SELECT * FROM lms_setting";
	$result = $wpdb->get_results($query_setting);
	$result_count = count($result);
	/* echo '<pre>';
	print_r($result);
	echo $result[0]->id;
	echo '</pre>'; */
?>
<section class="col-lg-12 col-md-12">
   <br>   
   <div class="row">
      <div class="col-md-12">
         <h2>Vedubox LMS - Settings</h2>
      </div>
   </div>
   <br><br>
   <div class="row">
      <div class="col-lg-2 col-md-2"></div>
	  <div class="col-lg-8 col-md-8">
         	 <form id="form-signin_v1" name="form-signin_v1" method="POST">
			  <div class="form-group">
				<label for="exampleInputEmail1">Enter API Url</label>
				<input type="text" value="<?php if(isset($result[0]->url))echo $result[0]->url;?>" class="form-control" name="url" id="url" aria-describedby="emailHelp" placeholder="Ex:http://demo.vedubox.net">
				
				<!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Enter API Token</label>
				<input type="text" value="<?php if(isset($result[0]->url))echo $result[0]->token;?>" class="form-control" name="token" id="token" aria-describedby="emailHelp" placeholder="Enter Token">
				
				<!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Enter Title For Course List In Your Language</label>
				<input type="text" value="<?php if(isset($result[0]->course_list)){ echo $result[0]->course_list;}?>" class="form-control" id="course_list" name="course_list" placeholder="Title For Course List">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Enter Title For Course Search In Your Language</label>
				<input type="text" value="<?php if(isset($result[0]->course_search)){echo $result[0]->course_search;}?>" class="form-control" id="course_search" name="course_search" placeholder="Title For Course List">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Enter Title For Teacher List In Your Language</label>
				<input type="text" value="<?php if(isset($result[0]->teacher_list)){echo $result[0]->teacher_list; }?>" class="form-control" id="teacher_list" name="teacher_list" placeholder="Title For Teacher List">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Enter Title For Teacher Photos List In Your Language</label>
				<input type="text" value="<?php if(isset($result[0]->teacher_photos)){echo $result[0]->teacher_photos; }?>" class="form-control" name="teacher_photos" id="teacher_photos" placeholder="Title For Teacher Photos List">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Enter Title For Login Button In Your Language</label>
				<input type="text" value="<?php if(isset($result[0]->login_button)){echo $result[0]->login_button;}?>" class="form-control" id="login_button" name="login_button" placeholder="Title For Login Button">
			  </div>
			  <!--<div class="form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1">
				<label class="form-check-label" for="exampleCheck1">Check me out</label>
			  </div>-->
			  <button type="submit" id="submit" name="submit"  class="btn btn-primary submit">Submit</button>
			</form>
      </div>	 
	  <div class="col-lg-2 col-md-2"></div>
     </div>
</section>
<?php
add_action('wp_footer','myscript_in_footer');
function myscript_in_footer(){
?>
<?php } ?><?php
add_action('admin_footer', 'custom_admin_js');
function custom_admin_js() { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" ></script>
	<script type="text/javascript">
		
		jQuery(document).ready(function ($) {
			$("#form-signin_v1").validate({
				rules: {
					url: "required",
					token: "required",
					course_list: "required",
					course_search: "required",
					teacher_list: "required",
					teacher_photos: "required",
					login_button: "required"
				},
				messages: {
					url: "<span style='color:red'>Please specify url</span>",
					token: "<span style='color:red'>Please specify Token</span>",
					course_list: "<span style='color:red'>Please specify Course List</span>",
					course_search: "<span style='color:red'>Please specify Course Search</span>",
					teacher_list: "<span style='color:red'>Please specify Teachers List</span>",
					teacher_photos: "<span style='color:red'>Please specify Teachers Photos</span>",
					login_button: "<span style='color:red'>Please specify Login Button Title</span>"

				}
			})
		
		jQuery(document).ready(function ($){
			$("#submit").click(function(){
				//alert("Form submitted");
				$("#form-signin_v1").valid();
			});
		});
	});
		
	</script>
	
	<script>
			/* jQuery(document).ready(function ($) {
			$("#form1").validate({
				rules: {
					field1: "required"
				},
				messages: {
					field1: "Please specify your name"

				}
			})

			$('#btn').click(function() {				
				$("#form1").valid();
			});
		}); */
	</script><?php }

?>