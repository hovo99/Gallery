<?php
    $session = new \App\Model\session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MVC Gallery</title>
</head>
<body>

<?php
    if($session->has('message')){
        printf('<b>%s</b>', $_SESSION['message']);
        $session->remove('message');
    }
?>
<form action="/upload/folder" method="post">
    <h2>
        Create New Folder
    </h2>
    <input name="createfolder" type="text">
    <input type="submit" value="Create Folder">
</form>
    <form method="POST" action="/upload/index" enctype="multipart/form-data">
        <div>
            <span>Upload a File:</span>
            <input type="file" name="uploadedFile">
        </div>
        <input type="submit" name="uploadBtn" value="Upload">
    </form>
</body>
</html>