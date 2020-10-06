var quantity, value;


$(document).ready(function() {
    var click_count = 0;
    alert("Working");

    $('#cart-button').click(function (e) {
        e.preventDefault();
        if (click_count >= 1) {
            e.preventDefault();
        }else{
            var route = "addToCart.php";
            var form_request = $('#add-to-cart');
            click_count++;
            console.log(click_count);
            $.ajax({
                type: "POST",
                url: route,
                data: form_request.serialize(),
            })

            $('#cart-button').text('Added to cart');
        }


    })
})

