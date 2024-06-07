<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        img {
            max-width: 100%;
            height: auto;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $product->prod_name; ?></h2>
        <img src="<?php echo base_url('images/'.$product->image); ?>" alt="<?php echo $product->prod_name; ?>" style="width: 300px; height: 300px;">
        <p><?php echo $product->prod_desc; ?></p>
        <p>Price: <?php echo $product->price; ?></p>
        <p>Stock: <?php echo $product->stock; ?></p>
        <form method="post" action="<?php echo site_url('cart/add'); ?>">
            <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</body>
</html>
