	window.onscroll = function() {myFunction()};

			// Get the header
			var header = document.getElementById("head-bar");
			var logomain = document.getElementById("logo-main");
			var logosec = document.getElementById("logo-sec");
			var mainone = document.getElementById("main-one");


			// Get the offset position of the navbar
			var sticky = header.offsetTop + 80;

			// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
			function myFunction() {
			  if (window.pageYOffset > sticky) {
				header.classList.add("sticky");
				mainone.style.paddingTop="120px";
				  logomain.style.display="none";
					logosec.style.display="block";	
			  } else {
				header.classList.remove("sticky");
				mainone.style.paddingTop="0";
				  logomain.style.display="block";
					logosec.style.display="none";
			  }
			}