$(document).ready(function(){
	
	$("#applyNow").click(function(){

		let name = $("#name").val();
		let father_name = $("#fname").val();
		let phone_no  = $("#phone").val();
		let email = $("#email").val();
		let address  = $("#address").val();
		let city  = $("#city").val();
		let current_business  = $("#current_business").val();
		let subject = $("#subject").val();
		let pincode  = $("#pincode").val();
		let location = $("#location").val();
		let investment_details  = $("#investment").val();
		let business  = $("#business").val();
		let message = $("#message").val();
		
		if(name !=="" && city !=="" && current_business !=="" && father_name !=="" && phone_no!=="" && email !=="" && address !== "" && subject !== "" && pincode !== "" && location !=="" && investment_details !=="" && business !== "" &&  message !==""){
				$.ajax({
					url:"./dashboard/api/index.php",
					type:"POST",
					data:{"name":name, "city":city, "current_business":current_business,  "father_name":father_name, "phone_no":phone_no, "email":email, "address":address, "subject":subject, "pincode":pincode, "location":location, "investment_details":investment_details, "business":business, "message":message},
					// dataType: "json",
					// cache: false,
					beforeSend:function(){
						$("#applyNow").val("Please Wait");					
					},
					success:function(obj){
						// var obj = JSON.parse(respnose)
						if(obj.status==1){
							$(".responseMsg").append("<span class='alert alert-success' role='alert' > Thanks for connecting us, We will contact you soon as possible :) </span>");
							$("#applyNow").val("Submitted");
							setInterval(() => {
								$(".responseMsg").html("");
								$("#applyNow").val("Submit");
							}, 3000);					
						}else {
							$(".responseMsg").append("<span class='alert alert-danger' role='alert' > Server Side Something Wrong, Please contact the developer </span>");
						}
					},
					error:function(textStatus, errorThrown){
						console.warn(textStatus, errorThrown);
					 	$(".responseMsg").append("<span class='alert alert-danger' role='alert' > Something Wrong,  Please contact web-developer. </span>");
						 setInterval(() => {
							$(".responseMsg").html("");
							$("#applyNow").val("Submit");
						}, 3000);
					}
				});
				
		}else {
			alert("All Fields are required");
		}
	});
})


	