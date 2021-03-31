<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Test</title>
</head>
<body>
    <h1>Coucou</h1>
    <p> clique !</p>
    <?php
        echo $_POST["id"];
        echo $_GET["id"];
        echo $_POST["identifiant"];
        echo $_GET["identifiant"];
        echo $_POST["Name"];
    ?>

</body>
</html>