$(document).ready(function(){
	
	$("#applyNow").click(function(){

		let name = $("#name").val();
		let father_name = $("#fname").val();
		let phone_no  = $("#phone").val();
		let email = $("#email").val();
		let address  = $("#address").val();
		let subject = $("#subject").val();
		let pincode  = $("#pincode").val();
		let location = $("#location").val();
		let investment_details  = $("#investment").val();
		let business  = $("#business").val();
		let message = $("#message").val();
		
		if(name !=="" && father_name !=="" && phone_no!=="" && email !=="" && address !== "" && subject !== "" && pincode !== "" && location !=="" && investment_details !=="" && business !== "" &&  message !==""){
				$.ajax({
					url:"./dashboard/api/index.php",
					type:"POST",
					data:{"name":name, "father_name":father_name, "phone_no":phone_no, "email":email, "address":address, "subject":subject, "pincode":pincode, "location":location, "investment_details":investment_details, "business":business, "message":message},
					dataType: "json",
					// cache: false,
					beforeSend:function(){
						$("#applyNow").val("Please Wait");					
					},
					success:function(respnose){
						// var obj = JSON.parse(respnose)
						// console.warn("Your response", respnose[1].post[0].status);
						if(respnose[1].post[0].status==1){
							console.warn("OK");
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
					error:function(jqXHR, textStatus, errorThrown){
						console.warn(textStatus, errorThrown);
					 	$(".responseMsg").append("<span class='alert alert-danger' role='alert' > Something Wrong,  Please contact web-developer soon as possible </span>");
					}
				});
				
		}else {
			alert("All Fields are required");
		}
	});



	$(".deleteCustomer").click(function(evt){
		let id = this.val();

		alert(id);
		/*
		if(name !=="" && father_name !=="" && phone_no!=="" && email !=="" && address !== "" && subject !== "" && pincode !== "" && location !=="" && investment_details !=="" && business !== "" &&  message !==""){
				$.ajax({
					url:"./dashboard/api/index.php",
					type:"POST",
					data:{"name":name, "father_name":father_name, "phone_no":phone_no, "email":email, "address":address, "subject":subject, "pincode":pincode, "location":location, "investment_details":investment_details, "business":business, "message":message},
					dataType: "json",
					// cache: false,
					beforeSend:function(){
						$("#applyNow").val("Please Wait");					
					},
					success:function(respnose){
						// var obj = JSON.parse(respnose)
						// console.warn("Your response", respnose[1].post[0].status);
						if(respnose[1].post[0].status==1){
							console.warn("OK");
							$(".responseMsg").append("<span class='alert alert-success' role='alert' > Thanks for connecting us, We will contact you soon as possible :) </span>");
							$("#applyNow").val("Submitted");					
						}else {
							$(".responseMsg").append("<span class='alert alert-danger' role='alert' > Server Side Something Wrong, Please contact the developer </span>");
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						console.warn(textStatus, errorThrown);
					 	$(".responseMsg").append("<span class='alert alert-danger' role='alert' > Something Wrong,  Please contact web-developer soon as possible </span>");
					}
				});
				
		}else {
			alert("All Fields are required");
		}
		
	})*/
	
})


	