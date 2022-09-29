<?php

declare(strict_types=1);

namespace MyProject\View;

$data = file_get_contents('./data.json');
$myAllMetaData = json_decode($data, true);

$myID = $_POST['delete'];
$deleted = $myAllMetaData[$myID];
if (key_exists($myID, $myAllMetaData)) {
    unset($myAllMetaData[$myID]);
    $serializedData[] = json_encode($myAllMetaData, JSON_PRETTY_PRINT);
    file_put_contents('./data.json', $serializedData);
} ?>

<!DOCTYPE html>
<html>
<body>

<h1 style="text-align: center">
    Skelbimas "<?php echo $deleted["title"] ?>" ištrintas
</h1>
<div style="text-align: center">
    <a href="index.php">
        <input style="align-content: center" type="submit" value="Grįžti"/>
    </a>
</div>
</body>
</html>