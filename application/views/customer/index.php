<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter Project Manager</title>
    <style>
        .product-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 0 10px 20px 0;
            background-color: #f9f9f9;
            border-radius: 5px;
            width: calc(25% - 15px); /* 25% width for each box with margin */
            display: inline-block; /* Display boxes in line */
            vertical-align: top; /* Align boxes at the top */
            box-sizing: border-box; /* Include padding and border in the width */
            text-align: center; /* Center align text */
        }
        .product-box img {
            display: block;
            margin: 0 auto 10px; /* Center align image */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5 mb-3"><?php echo $title; ?></h2>
        <div class="card">
            <div class="card-body">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <div class="text-center">
                    <a href="<?php echo site_url('customer/cart_view'); ?>">View Cart</a>
                </div>
                <div class="productList">
                    <div id="categoryItems">
                        <div class="product-list">
                            <?php foreach ($products as $product): ?>
                                <div class="product-box">
                                    <p>
                                        <a href="<?php echo site_url('customer/details/'.$product->product_id); ?>">
                                            <img src="<?php echo base_url('images/'.$product->image); ?>" style="width: 100px; height: 100px;">
                                        </a>
                                    </p>
                                    <h3>
                                        <a href="<?php echo site_url('customer/details/'.$product->product_id); ?>">
                                            <?php echo $product->prod_name; ?>
                                        </a>
                                    </h3>
                                    <p><?php echo $product->prod_desc; ?></p>
                                    <p>Price: <?php echo $product->price; ?></p>
                                    <p>Stock: <?php echo $product->stock; ?></p>
                                    <form method="post" action="<?php echo site_url('cart/add'); ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $product->product_id; ?>">
                                        <button type="submit">Add to Cart</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
