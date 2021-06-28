 <?php
function d($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}
    
     function showError($errno, $errstr, $errfile, $errline){
         echo 'Co loi: '.$errno;
         echo '<br>Loi: '.$errstr;
         echo '<br>File: '.$errfile;
         echo '<br>Dong: '.$errline;
     }
     