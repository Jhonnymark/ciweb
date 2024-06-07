<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .total {
            font-weight: bold;
            text-align: right;
            padding: 10px;
        }
        .checkout {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .checkout:hover {
            background-color: #45a049;
        }
        .empty-cart {
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Shopping Cart</h2>
        <?php if (!empty($cart)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item) { ?>
                        <tr>
                            <td><?php echo $item->prod_name; ?></td>
                            <td><?php echo $item->quantity; ?></td>
                            <td><?php echo $item->price; ?></td>
                            <td><?php echo $item->quantity * $item->price; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p class="total">Total: <?php echo $total_price; ?></p>
            <a class="checkout" href="<?php echo site_url('shopping_cart/checkout'); ?>">Proceed to Checkout</a>
        <?php } else { ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php } ?>
    </div>
</body>
</html>
