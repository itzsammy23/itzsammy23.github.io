var ratedIndex = 1;

$(document).ready(function () {

    $('#address').each(function () {
var link = "<a href='http://maps.google.com/maps?q=" + encodeURIComponent($(this).text()) + "' target= '_blank'>" + "Open Business Location in Google Maps" + "</a>";
    $('.location').html(link);
})

resetStarColors();

if (localStorage.getItem('ratedIndex') != null)
setStars(parseInt(localStorage.getItem('ratedIndex')));

$('.fa-star').on('click', function () {
    ratedIndex = parseInt($(this).data('index')); 
    localStorage.setItem('ratedIndex', ratedIndex);
    saveToTheDB();
})

$('.fa-star').mouseover(function () {
    resetStarColors();

var currentIndex = parseInt($(this).data('index'));
setStars(currentIndex);
})

$('.fa-star').mouseleave( function () {
    resetStarColors();

    if (ratedIndex != -1)
        setStars(ratedIndex);
})

})

$('.userId').css('display', 'none');
var userId = $('.userId').text();

function saveToTheDB() {
    $.ajax({
        url: "/rate/service/" + userId,
        method: "GET",
        dataType: "json",
        data: {
            save: 1,
            ratedIndex: ratedIndex
        }, 
    })
}

function setStars(max) {
    for (var i = 0; i <=max; i++)
                $('.fa-star:eq('+i+')').css('color', 'orange');
}

function resetStarColors() {
    $('.fa-star').css('color', 'black');
}

$('#starOne').mouseover(function() {
    $('#message').text("Bad!");
    $('#message').css("color", "red");
})

$('#starOne').mouseleave(function() {
    $('#message').text("");
})

$('#starTwo').mouseover(function() {
    $('#message').text("Okay");
    $('#message').css("color", "#990000");
})

$('#starTwo').mouseleave(function() {
    $('#message').text("");
})

$('#starThree').mouseover(function() {
    $('#message').text("Acceptable");
    $('#message').css("color", "#cc9900");
})

$('#starThree').mouseleave(function() {
    $('#message').text("");
})

$('#starFour').mouseover(function() {
    $('#message').text("Good!");
    $('#message').css("color", "#009900");
})

$('#starFour').mouseleave(function() {
    $('#message').text("");
})

$('#starFive').mouseover(function() {
    $('#message').text("Excellent!");
    $('#message').css("color", "#006600");
})

$('#starFive').mouseleave(function() {
    $('#message').text("");
})
