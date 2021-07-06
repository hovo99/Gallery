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
//            echo $this->directory;
//            echo "<br>";
//            echo $this->columns;
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
            echo('<table style="width: 90%; margin: 0 auto;" id="gallery"><tr>');
            $column = 0;
            foreach ($this->folders as $fold)
            {
                $images =  $this->directory . $fold;
                
                echo('<td style="width: 20%;">');
                echo ('<form action="/delete/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<a  href="?page=' . $this->folder_dir . $fold .  '">');
                echo $fold;
                echo ('<img style="width:100%" src="../folder.png" alt="">');
                echo ('<input type="hidden" value="' . $this->directory  .$fold.'" name="delete_file" />');
                echo ('<input type="submit" value="Delete" /></form></a>');
    
                echo ('<form action="/move/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<input name="move_folder" type="text" />');
                echo ('<input type="hidden" value="' . $this->directory  .$fold.'" name="file_path" />');
                echo ('<input type="submit" value="move" /></form></a></td>');
                
                $column++;
                if ($column >= $this->columns)
                {
                    echo('</tr><tr>');
                    $column = 0;
                }
            }
            $galleryName = 'gallery' . uniqid();
    
            foreach ($this->files as $file)
            {
                $images =  $this->directory . $file;
                $filesize = round((filesize(htmlspecialchars($images)))/1024) . "kb";
                echo('<td style="width: 20%;">');
                echo ('<form action="/delete/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<a  href="'. htmlspecialchars($images) . '" data-lightbox="' . $galleryName . '">');
                echo $file;
//                echo filesize($file);
                echo ('<img style="width:100%" src="' . htmlspecialchars($images) . '" alt="">');
                echo ('<input type="hidden" value="' . $this->directory  .$file.'" name="delete_file" />');
                echo ('<input type="submit" value="Delete" /></form></a>');
                echo $filesize;
                echo ('<form action="/move/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<input name="move_folder" type="text" />');
                echo ('<input type="hidden" value="' . $this->directory  .$file.'" name="file_path" />');
                echo ('<input type="submit" value="move" /></form></a></td>');
        
                $column++;
                if ($column >= $this->columns)
                {
                    echo('</tr><tr>');
                    $column = 0;
                }
            }
            
            echo('</tr></table>');
        }
    }