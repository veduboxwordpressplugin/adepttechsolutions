//SIGN UP FINAL VALIDATION START
$(document).ready(function() {

	//SIGN UP FINAL employee VALIDATION START
	$( "#sign_up_final" ).validate( {
                rules: {
                    fname:"required",
                    lname:"required",
					 useremail:"required",
					/* userpassword:"required", 
					confirm_password:"required",*/ 
					ph_number:"required",
					state:"required",
					 userpassword: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#userpassword"
                    }
					
					

                },
                messages: {
                    fname: "Please enter your first name",
                    lname:"Please enter your last name",
					useremail:"Please enter your email",
					/*  userpassword:"Please enter your password", 
					confirm_password:"Please enter your confirm password",   */
					ph_number:"Please enter your phone number", 
					state:"Please select your state",
					     userpassword: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirmpassword: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    }
                   
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error " ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 

//SIGN UP FINAL VALIDATION for security guars START
	$( "#sign_up_guard" ).validate( {
                rules: {
                    fname:"required",
                    lname:"required",
					 useremail:"required",
					/* userpassword:"required", 
					confirm_password:"required",*/ 
					ph_number:"required",
					total_experience_in_year:"required",
					rate_par_hour:"required",
					date_of_expire:"required",
					
					state:"required",
					 
					 userpassword: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#userpassword"
                    }
					
					

                },
                messages: {
                    fname: "Please enter your first name",
                    lname:"Please enter your last name",
					useremail:"Please enter your email",
					/*  userpassword:"Please enter your password", 
					confirm_password:"Please enter your confirm password",   */
					ph_number:"Please enter your phone number", 
					total_experience_in_year:"Please enter your experience", 
					rate_par_hour:"Please enter your rate per hour", 
					date_of_expire:"Please enter your license expire date", 
				
					state:"Please select your state",
					 
					     userpassword: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirmpassword: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    }
                   
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 
//edit security guard validation
   $( "#edit_guard_profile" ).validate( {
                rules: {
                    first_name:"required",
                    last_name:"required",
                    phone:"required",
                    total_experience_in_year:"required",
                    rate_par_hour:"required"
                           

                },
                messages: {
                    first_name: "Please enter your first name",
                    last_name:"Please enter your last name",
                    phone:"Please enter your Phone Number",
                    total_experience_in_year:"Please enter total experience",
                    rate_par_hour:"Please enter rate per hour"
                    /* job_ctcmin:"Please enter minimum salary for job",
                    job_ctcmax:"Please enter maximum salary for job",
                    job_location:"Please enter location for job",
                    job_timing_strt:"Please enter starting time for job",
                    job_timing_end:"Please enter end time for job",  
                    job_type:"Please enter type of job",     
                    job_days:"Please enter number of working days"  */   
                   
                },
            
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 
//edit profile employer
  $( "#edit_profile_employee" ).validate( {
                rules: {
                    fname:"required",
                    lname:"required",
                    phone:"required"
                   
                           

                },
                messages: {
                    fname: "Please enter your first name",
                    lname:"Please enter your last name",
                    phone:"Please enter your Phone Number"
                  
                    /* job_ctcmin:"Please enter minimum salary for job",
                    job_ctcmax:"Please enter maximum salary for job",
                    job_location:"Please enter location for job",
                    job_timing_strt:"Please enter starting time for job",
                    job_timing_end:"Please enter end time for job",  
                    job_type:"Please enter type of job",     
                    job_days:"Please enter number of working days"  */   
                   
                },
            
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 			
//registered first step validation 
	$( "#sign_up" ).validate( {
                rules: {
                    userrole:"required"
                    

                },
                messages: {
                    userrole: "Please select user type"
              
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error " ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            });

//login form validation 
	$( "#login_form" ).validate( {
                rules: {
                    log:"required",
                    pwd:"required"
                    

                },
                messages: {
                    log: "Please enter your email",
                    pwd: "Please enter your password"
              
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error " ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error " );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 

//forget password email form validation 
	$( "#forgot_password" ).validate( {
                rules: {
                    user_input:"required"
            
                },
                messages: {
                    user_input: "Please enter your email"
         
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success " ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 			
			
			
//forget password and confirm password match form validation 
	$( "#wp_pass_rst" ).validate( {
                rules: {
                   pswd: {
                        required: true,
                        minlength: 5
                    },
                    conpwd: {
                        required: true,
                        minlength: 5,
                        equalTo: "#pswd"
                    }
            
                },
                messages: {
                    pswd: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    conpwd: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    }
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error " ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error " );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 			
//change password from dashboard form validation 
	$( "#change_password1" ).validate( {
                rules: {
				 old_password:"required",
				 new_password:"required",
				 confirm_password:"required"
				 	/*  new_password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#new_password"
                    }
                  */
                },
                messages: {
					 old_password: "Please enter your old password",
					 new_password: "Please enter your new password",
					 confirm_password: "Please enter your confirm password"
                    /*   new_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    } */
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 
//contact form validation starting

$( "#contact_form_validation" ).validate( {
                rules: {
				 uname:"required",
				 uemail:"required",
				 phonenum:"required",
				 subject:"required",
				 umessage:"required"
				 	/*  new_password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#new_password"
                    }
                  */
                },
                messages: {
					 uname: "Please enter your name",
					 uemail: "Please enter your email",
					 phonenum: "Please enter your phone",
					 subject: "Please enter your subject",
					 umessage: "Please enter your message"
                    /*   new_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    } */
                },
			
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 

    //Employer Submit job VALIDATION START
    $( "#submit_job" ).validate( {
                rules: {
                    job_title:"required",
                    job_designation:"required",
                    job_decription:"required",
                    job_expmin:"required",
                    job_expmax:"required",
                    salary:"required",
                    /* job_ctcmax:"required", */
                    job_location:"required",
                    job_timing_strt:"required",
                    job_timing_end:"required",
                    job_type:"required",     
                    job_days:"required"             

                },
                messages: {
                    job_title: "Please enter your job title",
                    job_designation:"Please enter your job designation",
                    job_decription:"Please enter your job decription",
                    job_expmin:"Please enter minimum experience for job",
                    job_expmax:"Please enter maximum experience for job",
                    salary:"Please enter salary for job",
                   /*  job_ctcmax:"Please enter maximum salary for job", */
                    job_location:"Please enter location for job",
                    job_timing_strt:"Please enter starting time for job",
                    job_timing_end:"Please enter end time for job",  
                    job_type:"Please enter type of job",     
                    job_days:"Please enter number of working days"     
                   
                },
            
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 
//hire employee from employee dashboard popup validation

		
    //search for jobs
    $( "#search" ).validate( {
                rules: {
                    
                    state:"required"
                    
                },
                messages: {
                    
                    state:  ""  
                },
            
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-error " ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".input-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); 
			

//hire security guard from employee dashboard valiadtion

    //Employer Submit job VALIDATION START
/*     $( "#hire_security_guard_popup" ).validate( {
                rules: {
                    expire_date:"required",
                    description:"required"                             

                },
                messages: {
                    expire_date: "Please select your expire date",
                    description:"Please enter your designation"
                
                },
            
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    // Add `has-feedback` class to the parent div.form-group
                    // in order to add icons to inputs
                    element.parents( ".form-group" ).addClass( "has-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }

                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !element.next( "span" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-remove form-control-feedback'></i>" ).insertAfter( element );
                    }
                },
                success: function ( label, element ) {
                    // Add the span element, if doesn't exists, and apply the icon classes to it.
                    if ( !$( element ).next( "i" )[ 0 ] ) {
                        $( "<i class='glyphicon glyphicon-ok form-control-feedback'></i>" ).insertAfter( $( element ) );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
                    $( element ).next( "i" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
                },
                unhighlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
                    $( element ).next( "i" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
                }
            }); */ 	
    //search for jobs
    		
/*  $("#aSelect").click(function(){
    var selectedValues = [];    
    $("#lstSelect :selected").each(function(){
        selectedValues.push($(this).val()); 
    });
    alert(selectedValues);
    return false;
});  */          		
						
			
}); 			
var url="http://dsmesh.co.uk/dsmesh_demo/";
var invite_security_guard = function (ID) {
	if (confirm("Are you sure you want to Invite security guard for these job?") ) {
	
		var form_id = 'JOB_'+ID; 
		var str = $('#'+form_id).val();
		//var arr = jQuery.makeArray(str);
		//var string = JSON.stringify(arr);
		//alert(string);
		$.ajax({
			type: "POST",
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=invite_security_guard_for_job&user_id="+ID+"&job_id="+str,
			success: function(data) 
			{ 
			location.reload();
			 /* $(".athlete"+ID).fadeOut(2000, function(){
				});   */
			},
		/* 	error: function(xhr, ajaxOptions, thrownError) {
			} */
		}); 	
	}
	else return false;
};		

var not_interested_invite_guard = function (ID) {
	if (confirm("Are you not interested in this employee?") ) {
		$.ajax({
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=not_interested_invite_guard&id="+ID,
			success: function(data) 
			{ 
			//location.reload();
			  $(".emp"+ID).fadeOut(2000, function(){
				});  
			},
			error: function(xhr, ajaxOptions, thrownError) {
			}
		}); 	
	}
	else return false;
};	

var approve_invite_guard = function (ID,guard_id,employee_id,job_id) {
	//alert(job_id);
	if (confirm("Are you interested in this employee?") ) {
		$.ajax({
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=approve_invite_guard&id="+ID+"&guard_id="+guard_id+"&employee_id="+employee_id+"&job_id="+job_id,
			success: function(data) 
			{ 
			location.reload(); 
			 /* $(".athlete"+ID).fadeOut(2000, function(){
				});   */
			},
			error: function(xhr, ajaxOptions, thrownError) {
			}
		}); 	
	}
	else return false;
};

var complete_job_employer = function (ID,employee_id,guard_id,job_id) {
	//alert(guard_id);
	if (confirm("Are you Sure your job is completed.") ) {
		$.ajax({
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=complete_job_employer&id="+ID+"&employee_id="+employee_id+"&guard_id="+guard_id+"&job_id="+job_id,
			success: function(data) 
			{ 
			//alert(html);
			location.reload();
			 /* $(".athlete"+ID).fadeOut(2000, function(){
				});   */
			},
			error: function(xhr, ajaxOptions, thrownError) {
			}
		}); 	
	}
	else return false;
};
 $(document).ready(function() {
    $('#mytable').DataTable();
} );  
 $(document).ready(function() {
    $('#review').DataTable();
} ); 
