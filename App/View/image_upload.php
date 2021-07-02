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
<form action="/upload/folder?page=<?php echo $_GET['page'] ?? '' ?>" method="post">
    <span>
        Create New Folder
    </span>
    <input name="createfolder" type="text">
    <input type="submit" value="Create Folder">
</form>
    <form method="POST" action="/upload/index?page=<?php echo $_GET['page'] ?? '' ?>" enctype="multipart/form-data">
        <div>
            <span>Upload a File:</span>
            <input type="file" name="uploadedFile">
        </div>
        <input type="submit" name="uploadBtn" value="Upload">
    </form>
</body>
</html>