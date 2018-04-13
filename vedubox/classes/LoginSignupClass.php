<?php
  Class LoginSignupClass{
  public function registartion($data){
  	global $wpdb;
  	@session_start();
  	extract($data);
    //print_r($data);

		       $user_name = $data['member_name'];
		       $user_last = $data['member_lastname'];
		    $user_license = $data['driver_license_no'];
		    $user_website = $data['website'];
     $user_propertymanage = $data['property_managed'];
     $user_brokerage_name = $data['brokerage_name'];
		      $user_email = $data['member_email'];
		       $user_pass = $data['member_password'];
			  $user_phone = $data['member_phone'];
			$user_country = $data['member_country'];
			  $user_state = $data['member_state'];
			$user_address = $data['member_street_add'];
			   $user_city = $data['member_city'];
			   $user_unit = $data['member_unit'];
		    $user_zipcode = $data['member_zipcode'];
		       $user_role = $data['member_role'];
		       $user_pass = $data['member_rpassword'];
       
     $check = get_user_by('login',$user_email);
     $admin_email = get_option( 'admin_email' );
     if(!$check){
			     $full_name =  $user_name.' '.$user_last;
			      $userdata = array(
									'user_login' 		 => $user_email, 
									'user_pass'  		 => $user_pass,
									'user_email'  		 => $user_email,
									'user_registered'    => date('Y-m-d h:i:s'),
									'display_name'       => ucwords($full_name),
									'user_nicename'		 => ucwords($full_name),
									'user_status'		=> 1,
									'role'				 => $user_role,
								);
					
							$user_id = wp_insert_user($userdata); 
							if($user_id){

					           $member_usermeta = array(
											 'first_name'	=>	$user_name,
											 'last_name'	=>	$user_last ,
											 'license no'   =>  $user_license, 
											  'website'     =>  $user_website,
											 'phone'		=>	$user_phone,
											 'country'      =>  $user_country,
											 'state'		=>	$user_state,
											 'address'		=>	$user_address,
											 'city'         =>  $user_city,
											 'unit'         =>  $user_unit,
											 'zipcode'      =>  $user_zipcode,
											 'role'			=>	$user_role,
											 'subscription'	=>	0,
											 'profile_pic'	=>	200, 
										
											 'user_pass'    => $user_pass
											);
										
									foreach($member_usermeta as $key => $value){
												update_user_meta($user_id,$key,$value);
									}
								if ($user_role == 'landlord'){

									update_user_meta($user_id, 'property managed', $user_propertymanage);
								}

								if($user_role == 'real estate agent'){

									update_user_meta($user_id, 'brokerage name', $user_brokerage_name);
								}


                                /*************    Email send *******************/
	                            $headers = "From: 'Tscore'<'info@tscore.ca'>\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								$headers .= "X-Priority: 3\r\n";
								$headers .= "X-Mailer: PHP". phpversion() ."\r\n";

								$subject = 'Welcome to TSCORE!';
								$to = $user_email;
								$message = '<html><body>';
								$message .= '<p>Welcome to TSCORE!<br><br><br> You have successfully registered as a '.$user_role.' with TSCORE.ca (Tenant Scoring/Screening Services). We are currently checking the information you provided to verify you are the Owner (Landlord) of the property. Any concerns we will contact you. Here you can attach supporting documents if we require verification. Our email info@Tscore.ca.<br/><br/>The admin has to first verify Owner Landlord of property then allow them to start using the features. Please put a STATUS indication on the account dashboard. And do put a message saying to Landlord to notify Tenant to check their Spam/Junk folder in case email does not go to inbox.</br/>Your login detail are :-<br><br><strong>USER NAME:-</strong>'.$user_email.'<br><strong>PASSWORD:-</strong>'.$user_pass.'<br><br>Thanks and Regards,<br>TSCORE Team</p>';	
								$message .= '</body></html>';
								mail($to, $subject, $message, $headers ); 
							
							/* admin email */
							 
								$admin_email =$admin_email;
								$subject1  = 'A new member registered.';	
								$message1  = '<html><body>';
								$message1 .= '<p>Hi Admin,<br><br>'.ucwords($user_name).' '. ucwords($user_last).' has been registered now.<br><br> Kind Regards,<br>TSCORE Team</p>';
								$message1 .= '</body></html>';
								$headers1 = "From: TSCORE<info@tscore.ca>;" . "\r\n";
								$headers1 .= "MIME-Version: 1.0\r\n";
								$headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								$headers1 .= "X-Priority: 3\r\n";
								$headers1 .= "X-Mailer: PHP". phpversion() ."\r\n";
								mail($admin_email, $subject1, $message1, $headers);
							    /*
								$creds = array();
								$creds['user_login'] = $user_email;
								$creds['user_password'] = $userpassword;
								$creds['remember'] = true;
								wp_signon($creds);
								wp_redirect('my-account');  
                                */
  							  return array('type'=>'success','message'=>'You have successfully registered in the TSCORE.');
							}

		}
		else{
			    return array('type'=>'danger','message'=>'Your email id already exist. Please use another email id.');
			}	
	 
 	}
/******  update landlord profile **********/
public function update($data){
  	 global $wpdb;
  	 global $current_user;
	$user_id = $current_user->ID;
    
 
        $user_name = $data['member_name'];
		       $user_last = $data['member_lastname'];
		    $user_license = $data['driver_license_no'];
		    $user_website = $data['website'];
     $user_propertymanage = $data['property_managed'];
			  $user_phone = $data['member_phone'];
			$user_address = $data['member_street_add'];
			   $user_city = $data['member_city'];
			   $user_unit = $data['member_unit'];
		    $user_zipcode = $data['member_zipcode'];
			 $user_profile = $data['profile_pic'];
	
	       if($data){

	               $full_name =  $user_name.' '.$user_last;
					$userdata = array(
						'ID'                 => $user_id,
						'user_nicename'		 => ucwords($full_name),
						'user_email'  		 => $user_email,
						'display_name'       => ucwords($full_name),							
					);
                      
                     /*update user*/
                       $user_id = wp_update_user($userdata);

                     if($user_id){
                     	
			             $member_usermeta = array(
											 'first_name'	=>	$user_name,
											 'last_name'	=>	$user_last ,
											 'license no'   =>  $user_license, 
											  'website'     =>  $user_website,
								 'property managed'  => $user_propertymanage,
											 'phone'		=>	$user_phone,
											 'address'		=>	$user_address,
											 'city'         =>  $user_city,
											 'unit'         =>  $user_unit,
											 'zipcode'      =>  $user_zipcode,
											 'subscription'	=>	0,
											 'profile_pic'	=>	$user_profile, 
											);
										
									foreach($member_usermeta as $key => $value){
												update_user_meta($user_id,$key,$value);
									}
					    return array('type'=>'success','message'=>'Thank you ! .You have successfully updated your profile.');
            		 }

	                else{

	  	 			     return array('type'=>'danger','message'=>'Please fill the required fields.');
	                }

            }

      else{
	    	 return array('type'=>'danger','message'=>'Please enter the required information.');
	   }
    }
	/******  update tenant profile **********/
public function update_tenant($data){
  	 global $wpdb;
  	 global $current_user;
	$user_id = $current_user->ID;

	  $user_name = $data['member_name'];
		       $user_last = $data['member_lastname'];
		    $user_license = $data['driver_license_no'];
		    $user_website = $data['website'];
			  $user_phone = $data['member_phone'];
			$user_address = $data['member_street_add'];
			   $user_city = $data['member_city'];
			   $user_unit = $data['member_unit'];
		    $user_zipcode = $data['member_zipcode'];
			 $user_profile = $data['profile_pic'];
	
	       if($data){

	               $full_name =  $user_name.' '.$user_last;
					$userdata = array(
						'ID'                 => $user_id,
						'user_nicename'		 => ucwords($full_name),
						'user_email'  		 => $user_email,
						'display_name'       => ucwords($full_name),							
					);
                      
                     /*update user*/
                       $user_id = wp_update_user($userdata);

                     if($user_id){
                     	
						$member_usermeta = array(
											 'first_name'	=>	$user_name,
											 'last_name'	=>	$user_last ,
											 'license no'   =>  $user_license, 
											  'website'     =>  $user_website,
											 'phone'		=>	$user_phone,
											 'address'		=>	$user_address,
											 'city'         =>  $user_city,
											 'unit'         =>  $user_unit,
											 'zipcode'      =>  $user_zipcode,
											 'subscription'	=>	0,
											 'profile_pic'	=>	$user_profile, 
											);
										
									foreach($member_usermeta as $key => $value){
												update_user_meta($user_id,$key,$value);
									}

					    return array('type'=>'success','message'=>'Thank you ! .You have successfully updated your profile.');
            		 }

	                else{

	  	 			     return array('type'=>'danger','message'=>'Please fill the required fields.');
	                }

            }

      else{
	    	 return array('type'=>'danger','message'=>'Please enter the required information.');
	   }
    }
		/******  update tenant profile **********/
    public function update_real_estate_agent($data){
			 global $wpdb;
			 global $current_user;
			$user_id = $current_user->ID;

			  $user_name = $data['member_name'];
					   $user_last = $data['member_lastname'];
					$user_license = $data['driver_license_no'];
					$user_website = $data['website'];
					  $user_phone = $data['member_phone'];
					$user_address = $data['member_street_add'];
					   $user_city = $data['member_city'];
					   $user_unit = $data['member_unit'];
					$user_zipcode = $data['member_zipcode'];
					 $user_profile = $data['profile_pic'];
	
	       if($data){

	               $full_name =  $user_name.' '.$user_last;
					$userdata = array(
						'ID'                 => $user_id,
						'user_nicename'		 => ucwords($full_name),
						'user_email'  		 => $user_email,
						'display_name'       => ucwords($full_name),							
					);
                      
                     /*update user*/
                       $user_id = wp_update_user($userdata);

                     if($user_id){
                     	
						$member_usermeta = array(
											 'first_name'	=>	$user_name,
											 'last_name'	=>	$user_last ,
											 'license no'   =>  $user_license, 
											  'website'     =>  $user_website,
											 'phone'		=>	$user_phone,
											 'address'		=>	$user_address,
											 'city'         =>  $user_city,
											 'unit'         =>  $user_unit,
											 'zipcode'      =>  $user_zipcode,
											 'subscription'	=>	0,
											 'profile_pic'	=>	$user_profile, 
											);
										
									foreach($member_usermeta as $key => $value){
												update_user_meta($user_id,$key,$value);
									}

					    return array('type'=>'success','message'=>'Thank you ! .You have successfully updated your profile.');
            		 }

	                else{

	  	 			     return array('type'=>'danger','message'=>'Please fill the required fields.');
	                }

            }

      else{
	    	 return array('type'=>'danger','message'=>'Please enter the required information.');
	   }
    }
 }
?>