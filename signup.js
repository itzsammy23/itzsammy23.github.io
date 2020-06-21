var slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
  showSlides(slideIndex += n);
}

	function currentSlide(n) {
  showSlides(slideIndex = n);
}

	function showSlides(n) {
  					var i;
	 				 var slides = document.getElementsByClassName("tab");
	 				 var dots = document.getElementsByClassName("step");
  					if (n > slides.length) {slideIndex = 1}    
  					if (n < 1) {slideIndex = slides.length}
  			for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  };
  			for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  };
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
};

  setTimeout(showSlides, 1000);

  

//function to make eye icon show password when clicked
  function showPass() {
  		var pass = document.getElementById("pass");
  		if (pass.type == "password") {
  			pass.type = "text";
  		} else {
  			pass.type = "password";
  		};
  };

  function showText() {
  	var text = document.getElementById("confirmpass");
  	if (text.type == "password") {
  		text.type = "text";
  	}else {
  		text.type = "password";
  	}
  }

  var x, i, j, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
//function to validate first slide input
function validateSlideOne() {
	var firstName = document.forms["register"]["firstname"].value;
	var lastName = document.forms["register"]["lastname"].value;
	var email = document.forms["register"]["email"].value;
	var phone = document.forms["register"]["phone"].value;
	var firstNameError = document.getElementById("error-firstname");
	var lastNameError = document.getElementById("error-lastname");
	var emailError = document.getElementById("error-email");
	var phoneError = document.getElementById("error-phone");
	var letters = /^[A-Za-z]+$/;
	var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var numbers = /^[0-9]+$/;

	//checks if firstname meets validation requirements
	if (firstName == "") {
		firstNameError.innerHTML = "This field is required";
	}else if (!firstName.match(letters)) {
		firstNameError.innerHTML = "Only letters are allowed";
	}
	 else {
		firstNameError.innerHTML = "";
	};

	//checks if lastname meets validation requirements
	if (lastName == "") {
		lastNameError.innerHTML = "This field is required";
	} else if (!lastName.match(letters)) {
		lastNameError.innerHTML = "Only letters are allowed";
	}
	 else {
		lastNameError.innerHTML = "";
	};

	//checks if email meets validation requirements
	if (email == "") {
		emailError.innerHTML = "This field is required";
	}else if (!email.match(mailFormat)) {
		emailError.innerHTML = "Invalid email format";
	}
	 else {
		emailError.innerHTML = "";
	};

	//checks if phone meets validation requirements then moves the user to the next slide
	if (phone == "") {
		phoneError.innerHTML = "This field is required";
	}else if (isNaN(phone)) {
		phoneError.innerHTML = "Only numbers allowed";
	}
	 else if (phone.length != 11){
		phoneError.innerHTML = "Number must be 11 characters long";
	} else {
		phoneError.innerHTML = "";
	};

	//checks if either of the input fields fail validation, remain on current slide else move to next slide
	if (firstName == "" || lastName == "" || email == "" || phone == "" || phone.length !=11 || !firstName.match(letters) || !lastName.match(letters) || !email.match(mailFormat) || isNaN(phone)) {
		currentSlide(1);
	} else {
		plusSlides(1);
};
};
	//function to validate slide two
	function validateSlideTwo() {
	var bizName = document.forms["register"]["businessname"].value;
	var bizInfo = document.forms["register"]["businessinfo"].value;
	var bizPhone = document.forms["register"]["businessphone"].value;
	var bizNameError = document.getElementById("error-businessname");
	var bizInfoError = document.getElementById("error-businessinfo");
	var bizPhoneError = document.getElementById("error-businessphone");
	var bizAddr =document.forms["register"]["businessaddress"].value;
	var bizAddrError = document.getElementById("error-businessaddress");
	


	//validates business name
		if (bizName == "") {
		bizNameError.innerHTML = "This field is required";
	} 
	 else {
		bizNameError.innerHTML = "";
	}


	//validates business info
	if (bizInfo == "") {
		bizInfoError.innerHTML = "This field is required";
	} 
	else {
		bizInfoError.innerHTML = "";
	}


	//validates business phone
	if (bizPhone == "") {
		bizPhoneError.innerHTML = "This field is required";
	}	else if (isNaN(bizPhone)) {
		bizPhoneError.innerHTML = "Only numbers allowed";
	}
	 else if (bizPhone.length != 11){
		bizPhoneError.innerHTML = "Number must be 11 characters long";
	} else {
		bizPhoneError.innerHTML = "";
	};

	if (bizAddr == "") {
		bizAddrError.innerHTML = "This field is required";
	}

	//if either fails validation remain on current slide else move to next slide
	if (bizPhone == "" || bizPhone.length != 11 || bizName == "" || bizInfo == "" || isNaN(bizPhone) || bizAddr == "") {
		currentSlide(2);
	} else{
		plusSlides(1);
	};
};
	

	//validates slide three input
	function validateSlideThree() {
	var motto = document.forms["register"]["businessmotto"].value;
	var mottoError = document.getElementById("error-businessmotto");
	var state = document.forms["register"]["state"].value;
	var area = document.forms["register"]["area"].value;
	var stateError = document.getElementById("error-state");
	var areaError = document.getElementById("error-area");

	

	//validates business motto
	if (motto == "") {
		mottoError.innerHTML = "This field is required";
	} else {
		mottoError.innerHTML = "";
	}

	if (state == "") {
		stateError.innerHTML = "This field is required";
	} else {
		stateError.innerHTML = "";
	}

	if (area == "") {
		areaError.innerHTML = "This field is required";
	} else {
		areaError.innerHTML = "";
	}

	//if either fails validation remain on current slide else move to next slide

	if (motto == "" || area == "" || state == "") {
		currentSlide(3);
	} else {
		plusSlides(1);
	}
};

	//validates slide Four input
	function validateSlideFour() {
		var pass = document.forms["register"]["password"].value;
		var confirmPass = document.forms["register"]["password_confirmation"].value;
		var passError = document.getElementById("error-password");
		var confirmPassError = document.getElementById("error-confirm-password");
		var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

		//validates password
		if (pass == "") {
			passError.innerHTML = "This field is required";
			return false;
		} else if (pass.length < 8) {
			passError.innerHTML = "Password must be at least 8 characters long";
			return false;
		}
		 else {
			passError.innerHTML = "";
		}

		//validates confirm password
		if (confirmPass == "") {
			confirmPassError.innerHTML = "This field is required";
			return false;
		}else if (pass !== confirmPass && confirmPass != "") {
			confirmPassError.innerHTML = "Passwords don't match";
			return false;
		}
		 else {
			confirmPassError.innerHTML = "";
		}
		//if either fails validation remain on current slide
		if (pass == "" || confirmPass == "" || pass !== confirmPass && confirmPass != "" ||	pass.length < 6 ) {
			currentSlide(4);
		}else{
        document.getElementById("register").submit();}; 
        };