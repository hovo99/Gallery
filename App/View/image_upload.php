
    <div class="container-custom">
        <h1>Welcome Gallery</h1>
        <lable>Message :</lable>
        <?php
            $session = new \App\Model\session();
            if($session->has('message')){
                printf('<b>%s</b>', $_SESSION['message']);
                $session->remove('message');
            }
        ?>
        <form action="/upload/folder?page=<?= $_GET['page'] ?? '' ?>" method="post">
            <div class="form-group row">
                <label for="folder">Create folder : &nbsp; </label>
                <input id="folder" placeholder="Enter Folder Name" class="form-control col-11 col-md-3 mr-1 " name="createfolder" type="text">
                <input class="btn btn-primary" type="submit" value="Create Folder">
            </div>
        </form>
        <form method="POST" action="/upload/index?page=<?=$_GET['page'] ?? '' ?>" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="file">Upload a File : &nbsp; </label>
                <input id="file" class="btn" type="file" name="uploadedFile">
                <input type="submit" class="btn btn-primary" name="uploadBtn" value="Upload">
            </div>
        </form>
    </div>
<?php
