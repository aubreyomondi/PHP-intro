<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Private Area</title>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript" src="../placeorder.js"></script>




    </head>
    <h3>It is time to communicate with the exposed API, all we need is the API key to be passed in the header</h3>
        <hr>
    <h4>Feature 1 - Placing an order</h4>
        <hr>
    <form name="order_form" id="order_form">
        <fieldset>
            <legend>Place order</legend>
            <input type="text" name="name_of_food" id="name_of_food" required placeholder="name of food"><br>
            <input type="number" name="number_of_units" id="number_of_units" required placeholder="number of units"><br>
            <input type="number" name="unit_price" id="unit_price" required placeholder="unit price"><br><br>
            <input type="hidden" name="status" id="status" required placeholder="unit price" value="order placed"><br><br>
            <button id="btn-place-order" class="btn btn-primary" type="submit">Place Order</button>
        </fieldset>
    </form>
    <hr>
    <h4>Feature 2 - Checking order status</h4>
    <hr>
    <form name="order_status_form" id="order_status_form">
        <fieldset>
            <legend>Chech Order Status</legend>
            <input type="number" name="order_id" id="order_id" required placeholder="ORDER ID" /><br><br>
            <button class="btn btn-warning" id="btn-check-order" type="submit">Check Order Status</button>
        </fieldset>
    </form>
    <body>
    </body></html>

