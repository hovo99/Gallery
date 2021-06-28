<?php
    namespace App\Controller;

    class Load
    {
        private $directory;
        private $columns;
        private $files = [];
        
        public function __construct($directory, $columns)
        {
           $this->directory = $directory;
           $this->columns = $columns;
            if (!file_exists($directory)){
                mkdir($directory,0777,TRUE);
            }
        }
        public function load()
        {
            $fileik = $this->directory;
            $directory = dir($fileik);
            
            if(is_array(scandir($fileik)) && count(scandir($fileik)) > 2){
                foreach (scandir($fileik) as $folder) {
                    if ($folder != '.' && $folder != '..' && $folder != '.jpg'){
                        if(is_dir($fileik . '/'. $folder)){
//                            print_r($folder);
                            $this->files[] = $folder;
//                            print_r($this->files);
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
                $folderner = $this->directory;
                echo('<td style="width: 20%;">');
                echo ('<form action="/delete/index" method="post">');
                echo ('<a  href="' . "#" . '">');
                echo ('<img style="width:100%" src="' . htmlspecialchars($images) . '" alt="">');
                echo ('<input type="hidden" value="./upload/'.$file.'" name="delete_file" />');
                echo ('<input type="submit" value="Delete image" /></form></a></td>');
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