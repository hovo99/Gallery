<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Image gallery</title>
</head>

<body>
<?php
    $gallery = $GLOBALS['gallery'];
    $gallery->load();
    $gallery->render();
?>
</body>
</html>