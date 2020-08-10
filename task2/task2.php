<?php
function delete_dir($dirname) {
    if (is_dir($dirname))
    {
        if ($dh = opendir($dirname))
        {
            while (($data = readdir($dh)) !== false)
            {
                if(is_file($dirname . '/' . $data))
                {
                    unlink("$dirname/$data");
                    //echo 'Удаляем файл' . "<br>";
                }
                else if(is_dir($dirname . '/' . $data) && $data != '.' && $data != '..')
                {
                    //echo "Удаляем папку $data <br>";
                    delete_dir($dirname . '/' . $data);
                }
            }
            closedir($dh); // закрываем директори
            //echo "Удаляем папку $dirname <br>";
            rmdir($dirname);
        }
    }
}
$dir = "For_task_two";
delete_dir($dir);
