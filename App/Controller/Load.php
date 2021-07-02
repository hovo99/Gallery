<?php
    namespace App\Controller;

    class Load
    {
        public  $directory;
        private $columns;
        private $files = [];
        public $folder_dir;
        public function __construct($directory, $columns)
        {
            $this->directory = $directory;
            $this->columns = $columns;
            if (!file_exists($directory)){
                mkdir($directory,0777,TRUE);
            }
            $this->folder_dir = ltrim($this->directory, './upload/');
        }
        public function load()
        {
            echo $this->directory;
            echo "<br>";
            echo $this->columns;
            $fileik = $this->directory . '/' ;
            $directory = dir($fileik);
            
            if(is_array(scandir($fileik)) && count(scandir($fileik)) > 2){
                foreach (scandir($fileik) as $folder) {
                    if ($folder != '.' && $folder != '..' && $folder != '.jpg'){
                        if(is_dir($fileik . '/'. $folder)){
                            $this->files[] = $folder;
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
            foreach ($this->files as $file)
            {
                $images =  $this->directory . $file;
                
                echo('<td style="width: 20%;">');
                echo ('<form action="/delete/index?page=');
                echo $this->folder_dir;
                echo ('" method="post">');
                echo ('<a  href="?page=' . $this->folder_dir . $file .  '">');
                echo $file;
                echo ('<img style="width:100%" src="' . htmlspecialchars($images) . '" alt="">');
                echo ('<input type="hidden" value="' . $this->directory  .$file.'" name="delete_file" />');
                echo ('<input type="submit" value="Delete" /></form></a>');
    
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