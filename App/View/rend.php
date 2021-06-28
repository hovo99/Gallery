<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Image gallery</title>
</head>

<body>
<?php
    $gallery = new \App\Controller\Load('./upload/', 4);
    $gallery->load();
    $gallery->render();
?>
</body>
</html>