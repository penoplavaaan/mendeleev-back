<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row align-items-end titles">
        <div class="col">#</div>
        <div class="col">Действия</div>
        <div class="col">Название</div>
        <div class="col">Дата</div>
        <div class="col">Картинка</div>
    </div>
    <?php
    include 'ImageRow.php';
    $directory = "img";
    $images = glob($directory . "/*.jpg");
    $forbiddenList = str_split(file_get_contents("forbiddenIDs.txt", FILE_USE_INCLUDE_PATH));

    $currentPage = 1;
    $currentNumberOfRows = 0;
    $pages = [];
    foreach($images as $id=>$image)
    {
        if(in_array($id,$forbiddenList)) continue;
        $row = new ImageRow($id, $image);
        echo $row::toString($row);

        $currentNumberOfRows++;
        if ($currentNumberOfRows % 3 == 1){
            $pages[count($pages)+1] = ($currentNumberOfRows-$currentNumberOfRows % 3)/3+1;
        }
    }

    echo "<div class='row justify-content-center'>";
    foreach ($pages as $page){
        echo("<div class='col-1 pageManipulator' id='pageManipulator-$page'>$page </div>");
    }
    echo "</div>";
    ?>
</div>


</body>
</html>

