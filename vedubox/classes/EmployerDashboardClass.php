<?php

class EmployerDashboard{
  public function submittingjob($data){
	extract($data);
	global $wpdb;
	global $current_user;
	$user_id = $current_user->ID;
	$paid_guards = $wpdb->get_results("select *from wp_usermeta where meta_key='role' and meta_value='security_guard' and user_id in(Select distinct user_id from wp_usermeta where user_id in (SELECT user_id FROM `wp_usermeta` where meta_key='subscription' and meta_value =1))");
	//print_r($paid_guards);

	$memebership_status = get_usermeta($user_id,'subscription',true);
	if($memebership_status<1){
		$results = $wpdb->get_results("SELECT * FROM wp_jobs where user_id='{$user_id}'");
		if(count($results)<6){
	     $job_title       = $data['job_title'];
	     $job_state    	  = $data['state']; 
		 $job_city    	  = $data['city'];
	     $job_registered  = date('Y-m-d h:i:s');
         $job_status      = 1;
		if(empty($job_title)){
		   return array('type'=>'danger','message'=>'Please fill your job title.');
		}
	  else{
		   global $wpdb;
		   /* Create job */					
			$jobdata = array(
				'job_title'             =>  $job_title,
				'user_id'               =>  $user_id,
				'job_state' 			=>  $job_state ,
				'job_city' 				=>  $job_city , 
				'job_registered'    	=>  $job_registered,			
				'job_status'		    =>  $job_status,
			);	
			
			 $job_id = wp_insert_job($jobdata);

			if($job_id){
				//$job_id=3;
				
				$arr=array(
				
					'job_designation'	=>  $data['job_designation'],
					'job_decription'	=>  $data['job_decription'],
					'job_expmin'		=>  $data['job_expmin'],
					'job_expmax'		=>  $data['job_expmax'],
					'salary'			=>  $data['salary'],
					'job_hire_status'	=>  '0',
					'job_timing_strt'	=>  $data['job_timing_strt'],
					'job_timing_end'	=>  $data['job_timing_end'],
					'job_type'			=>  $data['job_type'],
					'job_days'			=>  $data['job_days']
				
				);
				foreach($arr as $key=>$value){
					add_jobs_meta($job_id,$key,$value);
				}
				
			/* 	add_jobs_meta($job_id,'job_designation',$data['job_designation']);
				add_jobs_meta($job_id,'job_decription',$data['job_decription']);
				add_jobs_meta($job_id,'job_expmin',$data['job_expmin']);
				add_jobs_meta($job_id,'job_expmax',$data['job_expmax']);
				add_jobs_meta($job_id,'salary',$data['salary']);
				add_jobs_meta($job_id,'job_hire_status','0');
				add_jobs_meta($job_id,'job_timing_strt',$data['job_timing_strt']);
				add_jobs_meta($job_id,'job_timing_end',$data['job_timing_end']);
				add_jobs_meta($job_id,'job_type',$data['job_type']);
				add_jobs_meta($job_id,'job_days',$data['job_days']);
				 */
				
				
				
				/* add_jobs_meta($job_id,'job_desired_candidate_qual',$data['job_desired_candidate_qual']); */
				if(!empty($paid_guards)){
					$job_infos = $wpdb->get_row("select * from job where id='{$job_id}'");
					foreach($job_infos as $job_info){
						$job_name = $job_info->job_title;
					}
					
					$emp_infos = get_user_by('ID',$user_id);
					$emp_name =  $emp_infos->display_name;
					$guard_post_title="New job posted";
					$guard_post_content=''.$emp_name.'  has been posted a new '.$job_name.' job.';
					$today = date("m/d/Y");
					$today_time = strtotime($today);
					foreach($paid_guards as $paid_guard){
						$security_guard_id = $paid_guard->user_id;
						$plan_payments = $wpdb->get_results("select * from wp_plan_payment where user_id='{$security_guard_id}'");
						foreach($plan_payments as $plan_payment){
							$plan_expire_date = $plan_payment->expire_date;
							$expire_time = strtotime($plan_expire_date);
							if($expire_time>$today_time){
								notify_to_guard_for_new_job_posting($security_guard_id,$user_id,$guard_post_title,$guard_post_content);
							}
						}
					}
				}

				return array('type'=>'success','message'=>'Your have successfully submitted your job.');
			}
				
		  }
		}
		else{
			 return array('type'=>'danger','message'=>'You can not posts the job more than five.If you want to continue to post your job please upgrade your membership.');
		}
	}else{
	     $job_title       = $data['job_title'];
	      $job_state    	  = $data['state']; 
		   $job_city    	  = $data['city'];
	     $job_registered  = date('Y-m-d h:i:s');
         $job_status      = 1;
		if(empty($job_title)){
		   return array('type'=>'danger','message'=>'Please fill your job title');
		}
	   else{
		   global $wpdb;
		   /* Create job */					
			$jobdata = array(
				'job_title'             =>  $job_title,
				'user_id'               =>  $user_id,
				'job_state' 			=>  $job_state ,
				'job_city' 				=>  $job_city , 
				'job_registered'    	=>  $job_registered,			
				'job_status'		    =>  $job_status,
			);	
			 $job_id = wp_insert_job($jobdata);

			if($job_id){
				//$job_id=3;
				
					$arr=array(
				
					'job_designation'	=>  $data['job_designation'],
					'job_decription'	=>  $data['job_decription'],
					'job_expmin'		=>  $data['job_expmin'],
					'job_expmax'		=>  $data['job_expmax'],
					'salary'			=>  $data['salary'],
					'job_hire_status'	=>  '0',
					'job_timing_strt'	=>  $data['job_timing_strt'],
					'job_timing_end'	=>  $data['job_timing_end'],
					'job_type'			=>  $data['job_type'],
					'job_days'			=>  $data['job_days']
				
				);
				foreach($arr as $key=>$value){
					add_jobs_meta($job_id,$key,$value);
				}
				
				
				/* add_jobs_meta($job_id,'job_designation',$data['job_designation']);
				add_jobs_meta($job_id,'job_decription',$data['job_decription']);
				add_jobs_meta($job_id,'job_expmin',$data['job_expmin']);
				add_jobs_meta($job_id,'job_expmax',$data['job_expmax']);
				add_jobs_meta($job_id,'salary',$data['salary']);
				add_jobs_meta($job_id,'job_timing_strt',$data['job_timing_strt']);
				add_jobs_meta($job_id,'job_timing_end',$data['job_timing_end']);
				add_jobs_meta($job_id,'job_type',$data['job_type']);
				add_jobs_meta($job_id,'job_days',$data['job_days']); */
				
					if(!empty($paid_guards)){
					$job_infos = $wpdb->get_row("select * from job where id='{$job_id}'");
					foreach($job_infos as $job_info){
						$job_name = $job_info->job_title;
					}
					
					$emp_infos = get_user_by('ID',$user_id);
					$emp_name =  $emp_infos->display_name;
					$guard_post_title="New job posted";
					$guard_post_content=''.$emp_name.'  has been posted a new '.$job_name.' job.';
					$today = date("m/d/Y");
					$today_time = strtotime($today);
					foreach($paid_guards as $paid_guard){
						$security_guard_id = $paid_guard->user_id;
						$plan_payments = $wpdb->get_results("select * from wp_plan_payment where user_id='{$security_guard_id}'");
						foreach($plan_payments as $plan_payment){
							$plan_expire_date = $plan_payment->expire_date;
							$expire_time = strtotime($plan_expire_date);
							if($expire_time>$today_time){
								notify_to_guard_for_new_job_posting($security_guard_id,$user_id,$guard_post_title,$guard_post_content);
							}
						}
					}
				}

				return array('type'=>'success','message'=>'Thanks!.You have successfully posted your job.');
			}
		  }
		}
	}

	public function updatingjob($data){
	extract($data);
	global $wpdb;
	//global $current_user;
	//print_r($data);
	$id = $_GET['id'];
	
	       //$user_id       = $id;
	     $job_title       = $data['job_title'];
	     $job_state       = $data['state'];
         $job_city        = $data['city']; 
	     $job_registered  = date('Y-m-d h:i:s');
         $job_status      = 1;
         $job_designation       = $data['job_designation'];
					 $job_decription		=$data['job_decription'];
					 $job_expmin			=$data['job_expmin'];
					$job_expmax			=$data['job_expmax'];
					$salary			=$data['salary'];
					/* $job_ctcmax	    =$data['job_ctcmax'];
					$job_othr_slry_detail	=$data['job_othr_slry_detail']; */
					$job_timing_strt		=$data['job_timing_strt'];
					$job_timing_end		=$data['job_timing_end'];
					$job_type				=$data['job_type'];
					$job_days				=$data['job_days'];
		/* $job_desired_candidate_qual =$data['job_desired_candidate_qual']; */

         
       

		if(empty($job_title)){
		   return array('type'=>'danger','message'=>'Please fill your job title');
		}
	   else{
		   global $wpdb;
		   /* Update job */	
		   			
			$jobdata = array(
				'job_title'             =>  $job_title,
				'job_state'             =>  $job_state,
				'job_city'              =>  $job_city,
				'job_registered'    	=>  $job_registered,			
				'job_status'		    =>  $job_status,
			);	
			//print_r($jobdata);

			  $job_id = wp_update_job($id, $jobdata);

			if($job_id){
                   

				$jobmeta = array(
					'job_designation'       =>$job_designation,
					'job_decription'		=>$job_decription,
					'job_expmin'			=>$job_expmin,
					'job_expmax'			=>$job_expmax,
					'salary'			=>$salary,
					/* 'job_ctcmax'			=>$job_ctcmax,
					'job_othr_slry_detail'	=>$job_othr_slry_detail, */
					'job_timing_strt'		=>$job_timing_strt,
					'job_timing_end'		=>$job_timing_end,
					'job_type'				=>$job_type,
					'job_days'				=>$job_days,
					/* 'job_desired_candidate_qual'=>$job_desired_candidate_qual, */
							);	
            }

           
			if(!empty($jobmeta)){	
			  $check=  update_jobs_meta($id,$jobmeta);	
				return array('type'=>'success','message'=>'Your have successfully updated your job.');
	             // $url= site_url().'/my-account/manage-jobs/';
	             // wp_redirect($url);
				/*if($check)
				{
				  echo 'hello'	;
	              //return array('type'=>'success','message'=>'Your have successfully updated your job.');
	              //$url= site_url().'/my-account/manage-jobs/';
	              wp_redirect('http://172.16.1.19/dsmesh/my-account/manage-jobs/');
				}
				else{
	               return array('type'=>'success','message'=>'Please try again.');
				 }*/
			}
                 
				
	    }

	}

}
?>