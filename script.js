var links = document.getElementById("navbar-links"), nav = document.getElementById("navbar"),
    advisory = document.getElementById("advisory-track"), enterprise = document.getElementById("enterprise-track"),
    analytics = document.getElementById("analytics-track"), support = document.getElementById("support-track"),
    scrolltimer, lastScrollTop = 0, showButton = document.querySelectorAll(".show-more"),
    modalcontent = document.getElementById("modal-box-content"),
    modalBox = document.getElementById("modal-box"), closeButton = document.getElementsByClassName("close")[0],
    showmodal = document.getElementById("show-modal");

showButton.forEach(function (buttons) {
            buttons.addEventListener("click", function () {
                var index = indexInParent(buttons);
                var content = document.getElementsByClassName("window")[index];
                var addedContent = document.getElementsByClassName("read-more")[index];
                addedContent.classList.remove("read-more");
                addedContent.classList.add("block");
                var clone = content.cloneNode(true);
                modalcontent.appendChild(clone);
                modalBox.style.display = "block";
                console.log(clone);
                console.log(index);
            });
})

closeButton.onclick = function () {
    hideModal();
}

window.onclick = function (event) {
            if (event.target == modalBox){
                hideModal();
            }
}

function hideModal() {
        modalBox.style.display = "none";
        modalcontent.innerHTML = "";
}

function toggle() {
    if (links.className === "navbar-links"){
        links.className += " responsive";
        nav.style.display = "block";
    }else{
        links.className = "navbar-links";
        nav.style.display = "flex";
    }
}

var children = document.getElementsByClassName("show-more");
console.log(children.length)
function indexInParent(node) {
    var num = 0;
    for (var i=0; i<children.length; i++) {
        if (children[i]==node) return num;
        if (children[i].nodeType==1) num++;
    }
    return -1;
}

function getDocHeight() {
    return Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
    )
}

function amountscrolled(){
    var winheight= window.innerHeight || (document.documentElement || document.body).clientHeight
    var docheight = getDocHeight()
    var scrollTop = window.pageYOffset || (document.documentElement || document.body.parentNode || document.body).scrollTop
    var trackLength = docheight - winheight
    var pctScrolled = Math.floor(scrollTop/trackLength * 100)
    //console.log(pctScrolled + '% scrolled')

    if (scrollTop > lastScrollTop){
        clearTimeout(scrolltimer)
        nav.classList.remove("nav-show");
        nav.classList.add("nav-hide");
        scrolltimer = setTimeout(function () {
            nav.style.display = "none";
        }, 1000);
    }else{
        showNav();
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

    if(pctScrolled == 0) {
        showNav();
    }

    if(pctScrolled >= 14) {
        advisory.className += " display-box";
    }

    if(pctScrolled >= 34) {
        enterprise.className += " display-box";
    }

    if(pctScrolled >= 54) {
        analytics.className += " display-box";
    }

    if(pctScrolled >= 82) {
        support.className += " display-box";
    }
}

function showNav() {
    clearTimeout(scrolltimer);
    nav.classList.remove("nav-hide");
    nav.classList.add("nav-show");
    nav.style.display = "flex";
}

window.addEventListener("scroll", function(){
    amountscrolled()
}, false)

