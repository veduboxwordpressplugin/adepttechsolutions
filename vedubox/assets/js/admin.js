var url="http://172.16.1.19/dsmesh/";
var delete_employee = function (ID) {
	if (confirm("Are you sure you want to delete Employee permanently?") ) {
		$.ajax({
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=deleteemployee&employeeID="+ID,
			success: function(data) 
			{ 
		
			 $(".employee"+ID).fadeOut(2000, function(){
				});  
			},
			error: function(xhr, ajaxOptions, thrownError) {
			}
		}); 	
	}
	else return false;
};
var delete_security_guard = function (ID) {
	if (confirm("Are you sure you want to delete Security Guard permanently?") ) {
		$.ajax({
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=deletesecurityguard&employeeID="+ID,
			success: function(data) 
			{ 
		
			 $(".employee"+ID).fadeOut(2000, function(){
				});  
			},
			error: function(xhr, ajaxOptions, thrownError) {
			}
		}); 	
	}
	else return false;
};
var plan_payment_status = function (ID,user_id) {
	if (confirm("Are you sure you want to activate this employee?") ) {
		$.ajax({
			url: url+"/wp-content/plugins/wp-post-and-apply-job/process.php?action=plan_payment_status&user_id="+user_id+"&plan_id="+ID,
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
