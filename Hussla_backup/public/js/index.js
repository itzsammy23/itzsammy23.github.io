function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "service-list");
      a.setAttribute("class", "service-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "service-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("service-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("service-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("service-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

var service = ["Air-condition Repair", "Carpentry","Childcare services",  "Electricial Repair","Event Planning","Haircuts", "Homecooking", "House Keeping", "Hair Styling","Painting", "Phone Repair", "Photography", "Plumbing", "Tailoring", "TV Repair", "Vehicle Repair"]

var states = ["Abia","Adamawa","Akwa Ibom","Anambra","Bauchi","Bayelsa","Benue","Borno","Cross River","Delta","Ebonyi","Enugu","Edo","Ekiti","FCT - Abuja","Gombe","Imo","Jigawa","Kaduna","Kano","Katsina","Kebbi","Kogi","Kwara","Lagos","Nasarawa","Niger","Ogun","Ondo","Osun","Oyo","Plateau","Rivers","Sokoto","Taraba","Yobe","Zamfara"]

var area = ["Abule-Oja", "Alapere", "Akoka", "Alago-meji", "Alausa", "Bariga", "Fadeyi", "Ikosi", "Ikeja", "Ikorodu", "Isolo", "Ketu", "Magodo", "Mile 12","Mile 2", "Lekki", "Obanikoro", "Opebi", "Palmgrove", "Surulere", "Yaba"]

autocomplete(document.getElementById("input-state"), states);
autocomplete(document.getElementById("input-service"), service);
autocomplete(document.getElementById("input-area"), area);


function dropDown () {
  document.getElementById("Dropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if(!event.target.matches(".icon")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;

    for (i = 0; i < dropdowns.length; i++) {
      var DropDown = dropdowns[i];
      if(DropDown.classList.contains('show')) {
        Dropdown.classList.remove('show');
      }
    }
  }
}
   
 function check() {
  var service = document.forms["select"]["service"].value;
 var state = document.forms["select"]["state"].value;
 var area = document.forms["select"]["area"].value;

 if (service == "" || state == "" || area == "") {
  alert("Please fill out the form");
  return false;
 }
 }

 