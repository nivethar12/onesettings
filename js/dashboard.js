var accountRowTemp;
var selectedElementTemp;
$(document).ready(function(){
	
	accountRowTemp = Handlebars.compile($("#accountRow").html());
	selectedElementTemp = Handlebars.compile($("#selectedElement").html());
	
	
	$('.multiselect').multiselect({
 		includeSelectAllOption: true,
 		enableFiltering: true,
 		enableCaseInsensitiveFiltering:true,
 		numberDisplayed: 0
	});	
	$("#addAccountButton").click(function(e){
		e.preventDefault();
		$('#myModal').modal("show");
		$("#accountsList option:selected").each(function() {
			$(this).attr("selected");
	     });
    });
	
	$(".accountCheck").live("change",function(e){
		e.preventDefault();
		if($(this).prop('checked')){
			$(this).parent().parent().addClass("active");
		}else{
			$(this).parent().parent().removeClass("active");
		}
	});
	
	
	$("#changePasswordBulk").click(function(e){
		e.preventDefault();
		$("#changePass").val("");
		$("#changePassConfirm").val("");		
		$("#changePasswordModal .selectedList").html("");
		var ids = [];
		$(".accountCheck:checked").each(function(){
			var tdTag = $(this).parent().parent();
			var email = tdTag.attr("data-email");
			var password = tdTag.attr("data-pass");
			var service = tdTag.attr("data-service");
			var credId = tdTag.attr("data-id");
			ids.push(credId);
			$("#changePasswordModal .selectedList").append(selectedElementTemp({"service":service,"email":email}))
		});
		$("#selectedListHdn").val(ids.join(","));
		
		$("#changePasswordModal").modal("show");
	});
	

	$("#changeEmailBulk").click(function(e){
		e.preventDefault();
		$("#updatedEmail").val("");
		$("#changeEmailModal .selectedList").html("");
		var ids = [];
		$(".accountCheck:checked").each(function(){
			var tdTag = $(this).parent().parent();
			var email = tdTag.attr("data-email");
			var password = tdTag.attr("data-pass");
			var service = tdTag.attr("data-service");
			var credId = tdTag.attr("data-id");
			ids.push(credId);
			$("#changeEmailModal .selectedList").append(selectedElementTemp({"service":service,"email":email}))
		});
		$("#selectedListHdn").val(ids.join(","));
		
		$("#changeEmailModal").modal("show");
	});

	
	
	$("#terminateAccountBulk").click(function(e){
		e.preventDefault();
		$("#terminateAccountModal .selectedList").html("");
		var ids = [];
		$(".accountCheck:checked").each(function(){
			var tdTag = $(this).parent().parent();
			var email = tdTag.attr("data-email");
			var password = tdTag.attr("data-pass");
			var service = tdTag.attr("data-service");
			var credId = tdTag.attr("data-id");
			ids.push(credId);
			$("#terminateAccountModal .selectedList").append(selectedElementTemp({"service":service,"email":email}))
		});
		$("#selectedListHdn").val(ids.join(","));
		
		$("#terminateAccountModal").modal("show");
	});

	
	
	
	
		
	$(".changePassLnk").live("click",function(e){
		e.preventDefault();
		
		var tdTag = $(this).parent().parent().parent();
		var email = tdTag.attr("data-email");
		var password = tdTag.attr("data-pass");
		var service = tdTag.attr("data-service");
		var credId = tdTag.attr("data-id");
		
		$("#changePass").val("");
		$("#changePassConfirm").val("");
		$("#selectedListHdn").val(credId);
		$("#changePasswordModal .selectedList").html("");
		$("#changePasswordModal .selectedList").append(selectedElementTemp({"service":service,"email":email}))
		$("#changePasswordModal").modal("show");
	});
	
	$(".changeEmailLnk").live("click",function(e){
		e.preventDefault();
		
		var tdTag = $(this).parent().parent().parent();
		var email = tdTag.attr("data-email");
		var password = tdTag.attr("data-pass");
		var service = tdTag.attr("data-service");
		var credId = tdTag.attr("data-id");
		
		$("#updatedEmail").val("");
		$("#selectedListHdn").val(credId);
		$("#changeEmailModal .selectedList").html("");
		$("#changeEmailModal .selectedList").append(selectedElementTemp({"service":service,"email":email}))
		$("#changeEmailModal").modal("show");
	});
	
	$(".terminateLnk").live("click",function(e){
		e.preventDefault();
		
		var tdTag = $(this).parent().parent().parent();
		var email = tdTag.attr("data-email");
		var password = tdTag.attr("data-pass");
		var service = tdTag.attr("data-service");
		var credId = tdTag.attr("data-id");
		
		$("#selectedListHdn").val(credId);
		$("#terminateAccountModal .selectedList").html("");
		$("#terminateAccountModal .selectedList").append(selectedElementTemp({"service":service,"email":email}))
		$("#terminateAccountModal").modal("show");
	});	
	
	
	
	
	
	
	function changePasswordUpdate(credId,newPass) {
		var email = $("#" + credId).attr("data-email");
		var pass = $("#" + credId).attr("data-pass");
		var service = $("#" + credId).attr("data-service");
		$("#" + credId + " span.label").removeClass("label-error");
		$("#" + credId + " span.label").removeClass("label-success");
		$("#" + credId + " span.label").text("Changing Password");
		$("#" + credId + " span.label").addClass("label-primary");
		$("#" + credId + " .loadingImg").removeClass("hide");	
		$.post("/api/changepass",{"email":email,"password":pass,"service":service,"credId":credId,"newpass":newPass},function(data){
 			var data = jQuery.parseJSON(data);
 			$("#" + data.credId + " .loadingImg").addClass("hide");
 			if(data.status == "SUCCESS"){
 				$("#" + data.credId + " .label").removeClass("label-primary");
 				$("#" + data.credId + " .label").addClass("label-success");
 				$("#" + data.credId + " .actions").removeClass("hide");
 				$("#" + data.credId + " .label").text("Password Changed");
 				$("#" + data.credId).attr("data-pass",data.pass);
 			}else{
 				$("#" + data.credId + " .label").removeClass("label-primary");
 				$("#" + data.credId + " .label").addClass("label-danger");
 				$("#" + data.credId + " .label").text("Password Change Failed");
 			}
			
		});
	};
	
	function changeEmailUpdate(credId,newEmail) {
		var email = $("#" + credId).attr("data-email");
		var pass = $("#" + credId).attr("data-pass");
		var service = $("#" + credId).attr("data-service");
		$("#" + credId + " span.label").removeClass("label-error");
		$("#" + credId + " span.label").removeClass("label-success");
		$("#" + credId + " span.label").text("Updating Email");
		$("#" + credId + " span.label").addClass("label-primary");
		$("#" + credId + " .loadingImg").removeClass("hide");	
		$.post("/api/changeemail",{"email":email,"password":pass,"service":service,"credId":credId,"newemail":newEmail},function(data){
 			var data = jQuery.parseJSON(data);
 			$("#" + data.credId + " .loadingImg").addClass("hide");
 			if(data.status == "SUCCESS"){
 				$("#" + data.credId + " .label").removeClass("label-primary");
 				$("#" + data.credId + " .label").addClass("label-success");
 				$("#" + data.credId + " .actions").removeClass("hide");
 				$("#" + data.credId + " .label").text("Email Updated");
 				$("#" + data.credId).attr("data-email",data.email);
 				$("#" + data.credId + " .name").text(data.email);
 			}else{
 				$("#" + data.credId + " .label").removeClass("label-primary");
 				$("#" + data.credId + " .label").addClass("label-danger");
 				$("#" + data.credId + " .label").text("Email Updated Failed");
 			}
			
		});
	};	
	

	$("#changePasswordForm").submit(function(e){
		e.preventDefault();
		var changePass = $("#changePass").val();
		var changePassConfirm = $("#changePassConfirm").val();
		var selectedList = $("#selectedListHdn").val();
		selectedList = selectedList.split(",");
		
		for(i in selectedList){
			var credId = selectedList[i];
			changePasswordUpdate(credId,changePass)
		}
		$("#changePasswordModal").modal("hide");		
	});
	
	$("#emailUpdateForm").submit(function(e){
		e.preventDefault();
		var updatedEmail = $("#updatedEmail").val();
		var selectedList = $("#selectedListHdn").val();
		selectedList = selectedList.split(",");
		for(i in selectedList){
			var credId = selectedList[i];
			changeEmailUpdate(credId,updatedEmail);
		}
		$("#changeEmailModal").modal("hide");		
	});
	
	$("#terminateAccountForm").submit(function(e){
		e.preventDefault();
		var selectedList = $("#selectedListHdn").val();
		selectedList = selectedList.split(",");
		alert("Deleting Account Coming Soon");
		$("#terminateAccountModal").modal("hide");		
	});	
	
	$("#addAccountForm").submit(function(e){
		e.preventDefault();
		var email = $("#email").val();
		var password = $("#password").val();
		var accounts = [];
		$("#accountsList option:selected").each(function() {
			accounts.push($(this).val());
	     });
		
		if(email != "" && password != "" && accounts.length > 0){
		 	for(var i=0;i<accounts.length;i++){
		 		var service = accounts[i];
		 		var credId =  hex_md5(email + "_" + password + "_" + service);
		 		$("#AccountTable").append(accountRowTemp({"credId":credId,"account":email,"service":service,"password":password,"status":"primary","label":"Logging In"}));
		 		$("#" + credId + " .loadingImg").removeClass("hide");
		 		$.post("/api/login",{"email":email,"password":password,"service":service,"credId":credId},function(data){
		 			var data = jQuery.parseJSON(data);
		 			$("#" + data.credId + " .loadingImg").addClass("hide");
		 			if(data.status == "SUCCESS"){
		 				$("#" + data.credId + " .label").addClass("label-success");
		 				$("#" + data.credId + " .actions").removeClass("hide");
		 				$("#" + data.credId + " .label").text("Logged In");
		 			}else{
		 				$("#" + data.credId + " .label").addClass("label-danger");
		 				$("#" + data.credId + " .label").text("Log In Failed");
		 				$("#" + data.credId + " .accountCheck").attr("disabled","disabled");
		 			}
		 		});
		 	}
		 	$('#myModal').modal("hide");
		 	$(".bulkactions").removeClass("disabled");
		}
    });
	
	
});
  