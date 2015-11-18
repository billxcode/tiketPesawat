
function hideResult(){
	$("#result-order").hide();
	$("#result-order").html("");			
}
function buy(id_ticket,username){
		$.post("http://localhost/tiketPesawat/server/buyTicket.php",{"id_ticket":id_ticket,"username":username},function(data,success){
			if(data=="1"){
$("#result-order").html("success");			
}else{
$("#result-order").html("failed");			
}
		});
		$("#result-order").css("display","block");
	}
$(function(){
	$("#result-order").hide();
	$("#result-order").on("click",function(){
		$("#result-order").hide();
	})
	$("#formLogin").show();
	$("#formRegister").hide();
	$("#btnShowRegister").on("click",function(){
			$("#formLogin").hide();
	$("#formRegister").show();
	});
	$("#btnShowLogin").on("click",function(){
	$("#formLogin").show();
	$("#formRegister").hide();
	});
	$("#btnCreateAccount").on("click",function(){
		$.post("http://localhost/tiketPesawat/server/register.php",$("#formRegister").serialize(),function(data,success){
		});
	});
	$("#btnLogin").on("click",function(){
		$.post("http://localhost/tiketPesawat/server/login.php",$("#formLogin").serialize(),function(data,success){
			if(data=="success"){
				document.cookie = $("#username").val();
				window.location="dashboard";
			}else{
				alert(data);
			}
			
		});
	});
	$("#menu-left").hide();
	var $param1=true;
	$("#tab-menu").on("click",function(){
		if($param1){
		$("#menu-left").show();
		$param1=false;
		}else{
		$("#menu-left").hide();
		$param1=true;
		}
	});
	$("#login-or-regis").on("click",function(){
		window.location="RegLog.html";
	});
	$("#menu-right").hide();
	var $param2=true;
	$("#options").on("click",function(){
		if($param2){
		$("#menu-right").show();
		$param2=false;
		}else{
		$("#menu-right").hide();
		$param2=true;
		}
	});
	$("#logReg").on("click",function(){
		window.location = "RegLog.html";
	});
	$("#navigator").on("click",function(){
		window.location = "home.html";
	});
	$("#logout").on("click",function(){
		window.location="../home.html";
	});
	$("#search-tiket").on("click",function(){
		$("#pop-search-tiket").show();
	});
	$(".popupmenu").hide();
	$(".btn-close").on("click",function(){
		$(".popupmenu").hide();
	});
	$("#result").hide();
	$("#btn-Find-Ticket").on("click",function(){
		var $username = document.cookie;
		var $form_find_ticket = $("#form-find-ticket").serialize();
		$("#scope-list-ticket").html("");
		$.post("http://localhost/tiketPesawat/server/searchTicket.php",$form_find_ticket,function(data,success){
			if(data=="failed"){
				$("#scope-list-ticket").append("<div>DATA NOT FOUND! :(</div>");
			}else{
				var obj = JSON.parse('{"dataTicket":'+data+'}');
			var result=null;
			for (var i = 0;i<obj.dataTicket.length; i++) {
				result = "<p>Maskapai : "+obj.dataTicket[i].maskapai+"</p>";
				result += "<p>Date : "+obj.dataTicket[i].date_ticket+"</p>";
				result += "<p>Price : "+obj.dataTicket[i].price_ticket+"</p>";
				result += "<button type='button' name='"+obj.dataTicket[i].id_ticket+"' class='btn btn-buy-ticket' onclick=\"buy('"+obj.dataTicket[i].id_ticket+"','"+$username+"')\">Buy</button>";
				$("#scope-list-ticket").append("<form method=post>"+result+"</form>");
			};
			
			}
			
			$("#result").show();
		});
	});
	$(".date-picker").datepicker({
		dateFormat:"yy-mm-dd"
	});
	$("#manage-order").on("click",function(){
		$("#scope-list-order").html("");
		var $username = document.cookie;
		$.post("http://localhost/tiketPesawat/server/loadDataTicket.php",{"username":$username},function(data,success){
			var obj = JSON.parse('{"data_ticket":'+data+'}');
				var result=null;
			for (var i = 0;i<obj.data_ticket.length; i++) {
				result = "<p>Maskapai : "+obj.data_ticket[i].maskapai+"</p>";
				result += "<p>Date : "+obj.data_ticket[i].date_ticket+"</p>";
				result += "<p>Price : "+obj.data_ticket[i].price_ticket+"</p>";
				result += "<p>Stock : "+obj.data_ticket[i].stok+"</p>";
				result += "<button type='button' name='"+obj.data_ticket[i].id_ticket+"' class='btn btn-buy-ticket' onclick=''>Confirm</button>";
				$("#scope-list-order").append("<form method=post>"+result+"</form>");
			};
			//alert(data);

		});
		$("#pop-manage-order").show();
	});
	$("#update-profile").on("click",function(){
		alert("test");
		var $username = document.cookie;
		$.post("http://localhost/tiketPesawat/server/viewProfile.php",{"username":$username},function(data,success){
			var obj = JSON.parse('{"view_profile" :'+data+'}');
			$("#username").html(obj.view_profile[0].username);
			$("#email").html(obj.view_profile[0].email);
			$("#password").val(obj.view_profile[0].password);
		});
		$("#username").html(document.cookie);
		$("#pop-profile").show();
	});
	$("#btn-update-profile").on("click",function(){
		$.post("",$("#").serialize(),function(){

		});
	});
});