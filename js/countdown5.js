
(function(){
	var countDownDate = Math.floor(Date.now() / 1000) + 5;
	var x = setInterval(function() {
		var now = Math.floor(Date.now() / 1000);
		var distance = countDownDate - now;
		document.getElementById("countdown").innerHTML = "<h>REDIRACTE in " + distance + " seconds</h>";
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("countdown").innerHTML = "<h>EXPIRED</h>";
		}
	}, 1000);
})();