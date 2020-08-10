<?php
$files = $_FILES;
$picture = $files['picture'];
$post = $_POST;
$title = $post['title'];
function checkTypeImg($file_name)
{
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if( in_array($ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp')))
    {
        return $ext;
    }
    else
    {
        return false;
    }
}
function checkSizeImg($file_size) : bool
{
    $maxSize = 1024 * 512;
    if($file_size > $maxSize)
    {
        return false;
    }
    else
    {
        return true;
    }
}
if(isset($picture['name']))
{
    $count_files = count($picture['name']);
    for($i = 0; $i < $count_files; $i++)
    {
        if(isset($picture['name'][$i]))
        {
            if ($ext = checkTypeImg($picture['name'][$i]))
            {
                if(checkSizeImg($picture['size'][$i]))
                {
                    $name = md5($picture['name'][$i] . $title . microtime() .rand(0, 999));
                    $name .= ".$ext";
                    $tmp_name = $picture['tmp_name'][$i];
                    if(move_uploaded_file($tmp_name, "img/$name"))
                    {
                        echo 'Файл ' . $picture['name'][$i] . ' успешно загружен' . "<br>";
                    }
                    else
                    {
                        echo 'Файл ' . $picture['name'][$i] . ' загрузить не удалось' . "<br>";
                    }
                }
                else echo 'Не удалось загрузить файл ' . $picture['name'][$i] . '. Файл больше 512Kб' . "<br>";
            }
            else echo 'Не удалось загрузить файл ' . $picture['name'][$i] . '. Файл не является изображением' . "<br>";
        }
    }
}
