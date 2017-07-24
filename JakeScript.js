$(document).ready(function(){
	loadHtml("init", initialize);
	
	$.ajaxSetup({cache:false});

	setInterval(runRefresh, 2000);

	$("#data").ready(function(){setTimeout(putAtBottom, 2100);});
	//$("#data").ready(function(){putAtBottom();});

});

function changeLocale(e){
	var localeData = {
		localeId: e.id,
	};

	$.ajax({
	  type: "POST",
	  url: "locale.php",
	  data: localeData,
	  success: function(result, status, error) {

	  },
  	  error: function(errorMsg){

	  }     
	}); 
}

//POST ajax for submitting message
var go = function()
{	
	var $msg = $('#input');

	var msgData = {
		id: "msg",
		msg: $msg.val(),
	};

	$.ajax({
	  type: "POST",
	  url: "controller.php",
	  data: msgData,
	  success: function(result, status, error) {
	  putAtBottom();
	  document.getElementById('input').value = '';
	  refreshMsgs();
	  },
  	  error: function(errorMsg){
	  	console.log(errorMsg);
	  }     
	}); 

}


function loadHtml(input, func){

	var data = {
		id: input,
		//function: func,
	};

	$.ajax({
	  type: "POST",
	  url: "controller.php",
	  data: data,
	  success: function(result, status, error) {
	  	//console.log(result);
	  	console.log(func);
	  	func(result);
	  	checkIfLoggedIn();
	  },
  	  error: function(msg,status,error){
	  	console.log(msg);
	  	console.log(status);
	  	console.log(error);
	  }     
	}); 
}

function initialize(html){
	$( "#chat" )[ 0 ].innerHTML = html;
	$("#loginForm").hide();
	$("#registerForm").hide();
	$("#deleteMsg").hide();
	//document.getElementById("test").innerHTML = html;
	//$('#test').innerHTML = html;
}


//POST ajax for login form
$(document).on ("click", "#loginBtn", function () {

	var $loginUsrName = $('#loginUsrName');
	var $loginPassword = $('#loginPassword');

	var loginData = {
		loginUsrName: $loginUsrName.val(),
		loginPassword: $loginPassword.val(),
	};

	$.ajax({
	  type: "POST",
	  url: "login.php",
	  data: loginData,
	  success: function(result, status, error) {
	  	  if(result.includes("username"))
		  {
			  alert(result);
		  } else {
			  refreshMsgs();
		  $("#loginForm").hide(100);
		  $("#loginRegister").hide(100);
		  $("#messageBox").show(100);
		  $("#logoutBtn").show(100);
		  }
		  
		  
	  },
  	  error: function(msg,status,error){
	  	console.log(msg);
	  	console.log(status);
	  	console.log(error);
	  }     
	}); 

});

//keep up to date
function runRefresh(){
	refreshMsgs();
	checkAtBottom();
}

//keep chatbox up to date
function refreshMsgs(){
	$('#data').load('display.php');
}

//have scrollable div at the bottom
function putAtBottom(){
	$('#data').stop().animate({
	  scrollTop: $('#data')[0].scrollHeight
	}, 200);
}

//if enter pressed then submit message
function checkForEnter(e, data){
	if (e.keyCode == 13 && data.value != "" && data.id == 'input') {
		go();
	}
};

//submit on click
$(document).on ("click", "#submitMsg", function () {
	go()
});

//toggle login form
$(document).on ("click", "#loginButton", function () {
	$("#loginForm").toggle(100);
		if($('#registerForm').is(':visible')){
			$("#registerForm").hide(100);
		}
		if($('.loginReg').is(':visible')){
			$(".loginReg").hide(100);
			$("#registerButton").hide(100);
		} else {
			$(".loginReg").show(100);
			$("#registerButton").show(100);
		}
});

//toggle register form
$(document).on ("click", "#registerButton", function () {
	$("#registerForm").toggle(100);
		if($('#loginForm').is(':visible')){
			$("#loginForm").hide(100);
		}
		if($('.loginReg').is(':visible')){
			$(".loginReg").hide(100);
			$("#loginButton").hide(100);
		} else {
			$(".loginReg").show(100);
			$("#loginButton").show(100);
		}
});

//check to see if someone is scrolled to the bottom of the div.. if they are then keep div updated
function checkAtBottom(){
	var scrollheight;
	var scrollpos;
	var scrollzero;
	scrollheight = $('#data')[0].scrollHeight;
	scrollpos = $('#data').scrollTop();
	scrollzero = scrollheight - scrollpos;
	//console.log("scrollheight = " + scrollheight);
	//console.log("scrollpos = " + scrollpos);
	//console.log("scrollzero = " + scrollzero);
	if(scrollzero < 360){
		putAtBottom();
	}
};


//POST ajax for deleting a message
$(document).on ("click", "#data .btn", function () {

	var divId = {
		msgId: this.id
	};

	$.ajax({
	  type: "POST",
	  url: "deleteMessage.php",
	  data: divId,
	  success: function() {
	  refreshMsgs();
	  }
	}); 

});

//POST ajax for register form
$(document).on ("click", "#registerBtn", function () {

	var $registerUsrName = $('#registerUsrName');
	var $registerPassword = $('#registerPassword');
	var $registerEmail = $('#registerEmail');

	var registerData = {
		registerUsrName: $registerUsrName.val(),
		registerPassword: $registerPassword.val(),
		registerEmail: $registerEmail.val()
	};


	$.ajax({
	  type: "POST",
	  url: "register.php",
	  data: registerData,
	  success: function(result, status, error) {
		  if(result.includes("User") || result.includes("Password") || result.includes("email"))
		  {
			  alert(result);
		  } else{
			$("#registerForm").hide(100);
		  $("#loginRegister").hide(100);
		  $("#messageBox").show(100);
		  $("#logoutBtn").show(100);
		  }
		  
		  
		  
	  },
  	  error: function(msg,status,error){
	  	console.log(msg);
		console.log(status);
		console.log(error);
	  }     
	}); 

}); 

//ajaxfor logout button
$(document).on ("click", "#logoutBtn", function () {
//$("#logoutBtn").click(function(){
	$.ajax({
	  url: "logout.php",
	  success: function(){
	  	refreshMsgs();
	  	$("#loginRegister").show(100);
	  	$("#logoutBtn").hide(100);
	  	$("#messageBox").hide(100);
	  }
	})
});

function checkIfLoggedIn(){
	var data = {
	    action: "session"
	};


	$.ajax({
	    type: "POST",
	    url: "loginCheck.php",
	    data: data,
	    dataType:"json",
	    
	    success: function (json) {
	        if(json.logStatus == true){
	        	$("#loginRegister").hide();
	        	$("#logoutBtn").show();
	    		$("#messageBox").show();
	    		//console.log("loggedin");
	    	}	
	        //if(json.session == "true"){
	           // code here
	        //}
	    },
	    error: function(){
	    	//console.log("fail");
	    	$("#logoutBtn").hide();
	    	$("#messageBox").hide();
			$("#loginRegister").show();
			}     
	});
}
