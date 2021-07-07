<?php
    namespace App\Controller;

    class Load
    {
        public  $directory;
        private $columns;
        private $files = [];
        private $folders = [];
        public $folder_dir;
        public function __construct($directory, $columns)
        {
            $this->directory = preg_replace('/\\/\\/+/', '/', $directory, -1 );
            $this->columns = $columns;
            if (!file_exists($directory)){
                mkdir($directory,0777,TRUE);
            }
            $this->folder_dir = ltrim($this->directory, './upload');
            $this->folder_dir = preg_replace('/\\/\\/+/', '/', $this->folder_dir, -1 );
        }
        public function load()
        {
            $fileik = $this->directory . '/' ;
            $directory = dir($fileik);
            
            if(is_array(scandir($fileik)) && count(scandir($fileik)) > 2){
                foreach (scandir($fileik) as $folder) {
                    if ($folder != '.' && $folder != '..'){
                        if(is_dir($fileik . '/'. $folder)){
                            $this->folders[] = $folder;
                        }
                    }
                }
            }
    
            while ($item = $directory->read())
            {
                if (strpos($item, ".png") || strpos($item, ".jpg"))
                {
                    $this->files[] = $item;
                }
            }
        }
        
        public function render()
        {
            echo ('<table class="container-custom" id="gallery"><tr class="tr">');
            echo '<th scope="col">Image</th>';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">FileSize</th>';
            echo '<th scope="col">Delete</th>';
            echo '<th scope="col">Move to </th>';
            echo '</tr>';
            
            foreach ($this->folders as $fold){
                echo '<tr class="tr"><td data-label="Image">';
                echo ('<form action="/delete/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<img style="width:50px;" src="../folder.png" alt=""></td><td data-label="Name">');
                echo ('<a  href="?page=' . $this->folder_dir . $fold .'">');
                echo $fold;
                echo ('</a></td><td data-label="FileSize">None</td>');
                echo '<td data-label="Delete">';
                echo ('<input type="hidden" value="' . $this->directory  .$fold.'" name="delete_file" />');
                echo ('<button type="submit" value="Delete"><i class="fas fa-trash"></i></button></form></a></td><td data-label="Move to">');
                echo ('<form action="/move/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<input class="mr-2" name="move_folder" type="text" />');
                echo ('<input type="hidden" value="' . $this->directory  .$fold.'" name="file_path" />');
                echo ('<button type="submit" value="move"><i class="fas fa-fighter-jet"></i></button></form></td>');
                
                echo '</tr>';
        }
            $galleryName = 'gallery' . uniqid();
            foreach ($this->files as $file)
            {
                $images =  $this->directory . $file;
                $filesize = round((filesize(htmlspecialchars($images)))/1024) . "kb";
                echo '<tr><td data-label="Image">';
                echo ('<form action="/delete/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<img style="width:50px; height:50px;" src="' . htmlspecialchars($images) . '" alt=""></td><td data-label="Name">');
                echo ('<a  href="'. htmlspecialchars($images) . '" data-lightbox="' . $galleryName . '">');
                echo $file;
                echo ('</a></td><td data-label="FileSize">');
                echo $filesize;
                echo '</td><td data-label="Delete">';
                echo ('<input type="hidden" value="' . $this->directory  .$file.'" name="delete_file" />');
                echo ('<button type="submit" value="Delete"><i class="fas fa-trash"></i></button></form></a></td><td data-label="Move to">');
                echo ('<form action="/move/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<input class="mr-2" name="move_folder" type="text" />');
                echo ('<input type="hidden" value="' . $this->directory  .$file.'" name="file_path" />');
                echo ('<button type="submit" value="move"><i class="fas fa-fighter-jet"></i></button></form></td>');
            
            }
            
            echo('</tr></table>');
        }
    }