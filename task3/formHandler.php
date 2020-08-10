<?php
$post = $_POST;
$user_link = $post['link'];
$file = 'Links.txt';
$arr_link = file($file,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$long_link = [];
$short_link = [];
foreach ($arr_link as $link)
{
    list($long_link[], $short_link[]) = explode("#", $link);
}
function get_hash($url)
{
    $scheme = parse_url($url, PHP_URL_SCHEME);
    $name = mb_strimwidth(parse_url($url, PHP_URL_HOST), 0,3);
    $symbols = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
    $max = 5;
    $word = 0;
    $size = strlen($symbols);
    while($max--)
    {
        $word .= $symbols[rand(0,$size)];
    }
    $dvu = (rand(0, 1) == 1) ? 'ru' : 'com';
    return $scheme . '://' . $name . '.' . $dvu . '/' . $word;
}
trim($user_link);
if($user_link != '' && $user_link = filter_var($user_link, FILTER_VALIDATE_URL))
{
    if($key = array_search($user_link, $long_link))
    {
        echo "Короткая ссылка: $short_link[$key]";
    }
    else
    {
        $new_link = get_hash($user_link);
        while (in_array($new_link, $short_link))
        {
            $new_link = $new_link = get_hash($user_link);
        }
        echo "Ваша коротокая ссылка: $new_link";
        file_put_contents($file, $user_link . '#' . $new_link . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
else
{
    echo "Ссыдка введена неверно! <br>";
}
