<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Quick Shop</title>
    <link rel="stylesheet" type="text/css" href="./View/Shop/style.css"/>
</head>
<body>

<h1>Quick Shop</h1>

<fieldset>
    <legend>Enter your products</legend>
    <form method="POST" action="./index.php">
        <input type="hidden" name="id" value="">
        <input type="hidden" name='name' value="create">
        <input type="text" name='product' placeholder="Product name">
        <input type="number" step="0.01" name='price' placeholder="Product price">
        <input type="submit" value="Enter">
    </form>
</fieldset>

<table>
    <thead>
    <tr>
        <td>Product ID</td>
        <td>Product name</td>
        <td>Product price</td>
        <td>Remove product</td>
    </tr>
    </thead>

    <tbody>
    <?php if (isset($products))
        foreach ($products as $key => $product) : ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $product['product'] ?></td>
                <td><?= $product['price'] ?></td>
                <td>
                    <form method="POST" action="./index.php">
                        <input type="hidden" name="delete" value="<?php echo $key ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Remove this product">
                    </form>
                </td>
            </tr>
            <tr>
            </tr>
        <?php endforeach; ?>
    <tr>

    </tr>
    </tbody>

</table>
<div class="bottom_buttons">
    <form class="sum_button" method="POST" action="./index.php">
        <input type="hidden" name="_method" value="SUM">
        <input type="submit" value="Get total">
    </form>
    <form class="sum_button" method="POST" action="./index.php">
        <input type="hidden" name="_method" value="DISCOUNT">
        <input class="disc_input" type="number" min="1" max="99" name='discount' placeholder="Enter discount code">
        <input type="submit" value="Get discount">
    </form>
    <div class="my_sum">
        <?php if (isset($outputSum)) {
            echo "Total value is " . $outputSum . " Eur";
        } ?>
    </div>
    <div class="my_disc">
        <?php if (isset($finalSum) && $finalSum != 0) {
            echo "Total value after discount is " . $finalSum . " Eur. \n You purchased all products!";
        } ?>
    </div>
</div>
</body>
</html>
