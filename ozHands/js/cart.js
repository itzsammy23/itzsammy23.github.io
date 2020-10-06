$(document).ready(function () {
    load();

    var text = $('#hidden').text();

    if (text != 1){
        $('#submit-checkout').css('display', 'none');
        $('#no-items').append('<p>You need to be logged in to check-out. <a href="login.php">Login</a></p>')
    }

    $(document).on('click', '.delete', function () {
        var id = $('.delete').index(this);
        var cart_id = item_id[id];

        $.ajax({
            type: "POST",
            url: "cartdelete.php",
            data: {
                cart_id: cart_id,
            },
        });

        $('.colon').remove();
        $('hr').remove();
        $('#billed').remove();
        $('#amount').val('');

        load();
    })

});

var item_id = [];
function load() {
    $.get("showcart.php", function (response) {
        console.log(response);

        if (response.length == 0){
            $('#container').append('<p style=" text-align: center; color: #000d1a; font-size: 18px;">No items in cart</p>');
            $('.check-out').css('display', 'none');
        }else{
            if (response.items){
                for (var i = 0; i < response.items.length; i++){
                    item = response.items[i];
                    item_id[i] = item.id;
                    console.log(i);

                    var link = item.name;
                    link = link.replace(/\s/g, "-");
                    $('#container').append(`
                  <div class="colon">
                <div class="colon-divisor cart-image" id="image">
                    <img src="/img/${item.image}">
                </div>
               
                <div class="colon-divider cart">
                <div class="delete"><i class="fas fa-trash-alt"></i></div>
                    <div class="order name" id="name" style="font-size: 22px;"><h4>${item.name}</h4></div>
                    <div class="order price" id="price"><b>Vendor: ${item.seller_name}</b></div>
                    <div class="order quantity" id="quantity"><b>Quantity: ${item.quantity}</b></div>
                    <div class="order link" id="link"><a href="product.php?name=${link}">View Product</a></div>
                </div>
            </div>
            <hr>
            
            
               `)

                }

                    $('#amount').val(response.total_price);
            }
            $('#container').append(`<div id="billed"><p><b>Total enquiry cost charge: &#36;${response.total_price}</b></p></div>
                                    <div id="notice"><p>Once you have completed payment, the request for wholesale will be sent to the seller and
                                     you will able to continue communication.</p></div>`)
        }

    });
}
