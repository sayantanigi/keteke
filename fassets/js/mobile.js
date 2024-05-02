
			function open_mobile_nav(){
				var x = document.getElementById("nav-mobile")
				x.classList.remove("animate__bounceOutLeft");
				x.classList.add("animate__bounceInLeft");
				x.style.display = "block";
			}
			function close_mobile_nav(){
				var x = document.getElementById("nav-mobile")
				x.classList.add("animate__bounceOutLeft");
				setTimeout(function(){x.style.display = "none";}, 500);
			}