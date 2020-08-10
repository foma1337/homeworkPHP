<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузка файлов</title>
</head>
<body>
<form method="post" action="loadFileHandler.php" enctype="multipart/form-data">
    <div>
        <input type="text" name="title" placeholder="Название">
    </div>
    <div>
        <input type="file" accept="image/*" multiple name="picture[]">
    </div>
    <div>
        <input type="submit" value="Загрузить">
    </div>
</form>
</body>
</html>