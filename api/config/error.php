<?php
echo  
<<<HTML
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="{$app_subdir}/public/favicon.png"/>
        <link rel="icon" type="image/ico" href="{$app_subdir}/public/favicon.ico"/>
        <title>$title</title>
    </head>
    <body>
        <pre>$content</pre>  
    </body>
</html>
HTML;
