(function(){
	var Qu = document.getElementsByClassName("query-user-class");
	var Qg = document.getElementsByClassName("query-games-class");
	var content = document.getElementById("query-result");
	Qu[2].addEventListener('click',function(event){
		event.preventDefault();
		Qg[1].value = "";
		content.innerHTML = QueryUser( Qu[1].value );
	})
	Qg[2].addEventListener('click',function(event){
		//Qg[0].submit();
		event.preventDefault();
		Qu[1].value = "";
		content.innerHTML = QueryGame( Qg[1].value );
	})

	function QueryUser(inputname) {
		var result = "Your Query result will be print here.";
		$.ajax({
			type: "POST",
			url: '../php/queryUser.php',
			dataType: 'json',
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
			dataType: 'json',
			async: false,
			data:{"query-game": inputgame},

			success: function(data){
				if(data != "") result = data;
			}
		});
		return result;
	}
})();