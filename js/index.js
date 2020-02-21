let conferenceDate = new Date('Nov 05, 2020 10:00:00').getTime();

let countdownFunction = setInterval(function(){
	let currentDate = new Date().getTime();
	let remainingTime = conferenceDate - currentDate;
	let days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
	let hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24))/(1000*60* 60));
	let minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
	let seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
	document.getElementById("day").innerHTML = days;
	document.getElementById("hour").innerHTML = hours;
	document.getElementById("minute").innerHTML = minutes;
	document.getElementById("second").innerHTML = seconds;
	if(remainingTime < 0 ) {
		clearInterval(countdownFunction);
		document.getElementById("final-text").innerHTML = "The Conference time has arrived!";

	}
}, 1000);