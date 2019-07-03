$(document).ready(function () {
    $('#btn-place-order').click(function (event) {
        event.preventDefault();
        var name_of_food = $('#name_of_food').val();
        var number_of_units = $('#number_of_units').val();
        var unit_price = $('#unit_price').val();
        var order_status = $('#status').val();

        $.ajax({
            url: " http://localhost/btc3205/Lab1/api/v1/orders/index.php",
            type: "post",
            data: {name_of_food:name_of_food,number_of_units:number_of_units,unit_price:unit_price,order_status:order_status},
            headers: {
                'Authorization':'Basic qDLzNmj2q2ojv3c4RmhU5OS3mtOETnzORb1WOKFBxGOocQhYkIE1FYbDObg7DETH'
            },
            success: function (data) {
                
                if (data['success'] == 1){
                    alert(data['message']);
                }else{
                    alert("Something went wrong. Please try again");
                }
            }
        });
    });
});

$(document).ready(function () {
    $('#btn-check-order').click(function (event) {
        event.preventDefault();
        var order_id = $('#order_id').val();
        $.ajax({
            url: "http://localhost/btc3205/Lab1/api/v1/orders/index.php",
            type: "get",
            data: {order_id:order_id},
            headers: {
                'Authorization':'Basic qDLzNmj2q2ojv3c4RmhU5OS3mtOETnzORb1WOKFBxGOocQhYkIE1FYbDObg7DETH'
            },
            success: function(data) {
                if (data['success'] == 1){
                    alert(data['message']);
                }else{
                    alert("Order does not exist");
                }
            }
        });
    });
});