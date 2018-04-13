<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
global $wpdb;
$textarea_text = '<?php
/* Template Name: vedubox_temp */
?>
<div class="container-fload"> 
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="wrapper-content bg-white ">
				<?php 
				  while( have_posts()): the_post(); 
				  the_content();
				  endwhile;
				?>
			</div>
		</div>
	</div>
</div>';

?>
<style>.area{width:60%;}</style>
<section class="col-lg-12 col-md-12">
   <br>      
   
   <div class="row">
      <div class="col-lg-12 col-md-12">
         <h2>Vedubox LMS - <br>User Guide Information For Using This Plugin And How To Create Pages</h2>
             <br/>
		  <div class="row">
			<div class="step1">
				<h4>Step 1</h4><span>Creat a blank file in your wordpress theme folder with name "vedubox_temp.php".</span>
				<h4>Step 2</h4><span>Copy and past below code in "vedubox_temp.php" file.</span>				
				<textarea width="50%" class="form-control area" rows="18" id="comment"> <?php echo $textarea_text; ?> </textarea>
				<h4>Step 3</h4><span>Save this file "vedubox_temp.php".</span>
				<h4>Step 4</h4><span>Follow steps according below image.</span></br>
				 <?php $ab  = site_url().'/wp-content/plugins/tscore/assets/user_guide.png'; ?>
				 <img width="75%" src="<?php echo $ab; ?>" class="img-rounded" alt="Cinque Terre"> 
			</div>
		  </div>
		  <br/>	 
	  </div>
		 
   </div>
    
</section>



