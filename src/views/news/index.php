<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php foreach ($newsList as $item):?>
        <div>
            <h1><a href="/news/<?php echo $item['id']?>"><?php echo $item['title']?></a></h1>
            <div><?php echo $item['short_content']?></div>
        </div>
    <?php endforeach;?>
</body>
</html>
