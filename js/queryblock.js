(function(){
	var Qu = document.getElementsByClassName("query-user-class");
	var Qg = document.getElementsByClassName("query-games-class");
	var content = document.getElementById("query-result");
	Qu[2].addEventListener('click',function(event){
		event.preventDefault();
		Qg[1].value = "";
		setCookie("queryResult", QueryUser( Qu[1].value ), 1);
		window.location.replace("../index.php");
	});
	Qg[2].addEventListener('click',function(event){
		event.preventDefault();
		Qu[1].value = "";
    setCookie("queryResult", QueryGame( Qu[1].value ), 1);
    window.location.replace("../index.php");
	});

	function QueryUser(inputname) {
		var result = "Your Query result will be print here.";
		$.ajax({
			type: "POST",
			url: '../php/queryUser.php',
			dataType: 'text',
			async: false,
			data:{"query-user": inputname},

			success: function(data){
				if(data != "") result = data;
			}
		});
		return result;
	}

	function QueryGame(inputgame){
		var result = "Your Query result will be print here.";
		$.ajax({
			type: "POST",
			url: '../php/queryGame.php',
			dataType: 'text',
			async: false,
			data:{"query-game": inputgame},

			success: function(data){
				if(data != "") result = data;
			}
		});
		return result;
	}
})();

function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
  }
  alert(name + "=" + (value || "")  + expires + "; path=/");
  document.cookie = name + "=" + (window.escape(value) || "")  + expires + "; path=/";
}