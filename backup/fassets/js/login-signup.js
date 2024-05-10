function openlogin(){
				var x = document.getElementById("login");
				var y = document.getElementById("signup");
				var a = document.getElementById("login-name");
				var b = document.getElementById("signup-name");
				var n = document.getElementById("sig-form");
				b.classList.remove("sactive");
				b.classList.add("in-active");
				a.classList.remove("in-active");
				a.classList.add("sactive");
				y.style.display = "none";
				x.style.display = "block";
				
			}	
function opensignup(){
				var x = document.getElementById("login");
				var y = document.getElementById("signup");
				var a = document.getElementById("login-name");
				var b = document.getElementById("signup-name");
				var m = document.getElementById("log-form");
				a.classList.remove("sactive");
				a.classList.add("in-active");
				b.classList.remove("in-active");
				b.classList.add("sactive");
				x.style.display = "none";
				y.style.display = "block";
			}