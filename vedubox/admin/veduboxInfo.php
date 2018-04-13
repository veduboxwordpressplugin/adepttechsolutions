<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
global $wpdb;
/* echo $ab  = site_url().'/wp-content/plugins/tscore/admin/';
echo '               ....................             ';
echo get_template_directory_uri(); */

?>
<section class="col-lg-12 col-md-12">
   <br>      
   <br><br>
   <div class="row">
      <div class="col-lg-12 col-md-12">
         <h2>Vedubox LMS - Shortcode Information For Pages</h2>
             <br/>
		  <table class="table">
			<thead>
			  <tr>
				<th>S.No</th>
				<th>Page Name</th>
				<th>Shortcode</th>
				<th>Description</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td>1</td>
				<td>Course List</td>
				<td>[COURSE]</td>
				<td>It will display list of all course category wise.There is also course search option.</td>
			  </tr>
			  <tr>
				<td>2</td>
				<td>Teachers List</td>
				<td>[TEACHER_LIST]</td>
				<td>It will display list of all teachers.</td>
			  </tr>
			  <tr>
				<td>3</td>
				<td>Teacher's Photo</td>
				<td>[TEACHER_PTOTOS]</td>
				<td>It will display photos of all teachers.</td>
			  </tr>
			  <tr>
				<td>4</td>
				<td>Login Button</td>
				<td>[L_BUTTON]</td>
				<td>It will display login button for login.</td>
			  </tr>
			</tbody>
		  </table>
		  <br/>
		  <br/>
		  <h6><span>Note : You have to use these shortcode in wordpress pages.</span></h6>
		</div>
		
         </div>
     </div>
</section>