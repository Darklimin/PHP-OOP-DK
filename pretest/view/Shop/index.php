<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Quick Shop</title>
    <link rel="stylesheet" type="text/css" href="./View/Shop/style.css"/>
</head>
<body>

<h1>Quick Shop</h1>

<table>
    <thead>
    <tr>
        <td>ID</td>
        <td>Pavadinimas</td>
        <td>Skelbimo tekstas</td>
        <td>Miestas</td>
        <td>Telefonas pasiteiravimui</td>
        <td>Pašalinti skelbimą</td>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($advertisements as $key => $advertisement) : ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $advertisement['title'] ?></td>
            <td><?= $advertisement['text'] ?></td>
            <td><?= $advertisement['city'] ?></td>
            <td><?= $advertisement['phone'] ?></td>
            <td>
                <form method="POST" action="./index.php">
                    <input type="hidden" name="delete" value="<?php echo $key ?>">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Pašalinti">
                </form>
            </td>
        </tr>
        <tr>

        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<fieldset>
    <legend>Enter your products</legend>
    <form method="POST" action="./index.php">
        <input type="hidden" name="id" value="">
        <input type="hidden" name='name' value="create">
        <input type="text" name='product' placeholder="Product name">
        <input type="number" name='price' placeholder="Product price">
        <input type="submit" value="Skelbti">
    </form>
</fieldset>

</body>
</html>
