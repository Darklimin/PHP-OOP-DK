<?php

namespace MyProject\View;

$data = file_get_contents('./data.json');
$myAllMetaData = json_decode($data, true);
$myAllMetaData[] = [
    'name' => $_POST['name'],
    'title' => $_POST['title'],
    'text' => $_POST['text'],
    'city' => $_POST['city'],
    'phone' => $_POST['phone']
];
$serializedData = json_encode($myAllMetaData, JSON_PRETTY_PRINT);
file_put_contents('./data.json', $serializedData);
?>

<!DOCTYPE html>
<html>
<body>

<h1 style="text-align: center">
    Skelbimas "<?php echo $_POST['title'] ?>" sukurtas
</h1>
<div style="text-align: center">
    <a href="index.php">
        <input style="align-content: center" type="submit" value="Grįžti"/>
    </a>
</div>
</body>
</html>