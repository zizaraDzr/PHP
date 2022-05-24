<?php

/**
 * @var $errorno \wfm\ErrorHandler
 * @var $errorstr \wfm\ErrorHandler
 * @var $errorfile \wfm\ErrorHandler
 * @var $errorline \wfm\ErrorHandler
 */

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>

<body>
    <h1>Произошла ошибка</h1>
    <p><b>Код ошибки:</b> <?= $errorno ?></p>
    <p><b>Текст ошибки:</b> <?= $errorstr ?></p>
    <p><b>Файл, в котором произошла ошибка:</b> <?= $errorfile ?></p>
    <p><b>Строка, в которой произошла ошибка:</b> <?= $errorline ?></p>

</body>

</html>