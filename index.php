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
<div class="container" id="body">
    <?php
    include 'ImageGallery.php';
    $gallery = new ImageGallery("img");
    $gallery ->printTable();
    ?>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Загрузите файлы:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data" id="myform">
                    <div>
                        <div class="row">
                            <div class="col-9">
                                <input type="file" class="form-control" id="file" name="file"/>
                            </div>
                            <div class="col-3"><input type="button" class="button btn btn-primary" value="Загрузить" id="but_upload"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary modal-toggle-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Добавить изображения
            </button>
        </div>
    </div>

</div>

<script>
    $( document ).ready(function (){
        $('#bttn-1').css( "background-color", "#6c757d" );
        $('#bttn-1').css( "color", "white" );

        $("#but_upload").click(function(){

            var fd = new FormData();
            var files = $('#file')[0].files;

            // Check file selected or not
            if(files.length > 0 ){
                fd.append('file',files[0]);

                $.ajax({
                    url: 'add.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response != 0){
                            alert("Файл успешно загружен!.");
                            changePage(1);
                        }else{
                            alert('Файл не являеься валидным изображением!');
                        }
                    },
                });
            }else{
                alert("Пожалуйста, выберите файл.");
            }
        });
    })



    function deleteImage(name){
        $.ajax({
            method: "GET",
            data: {"name":name},
            url: './delete.php',
            success: function(data) {
                alert('Element deleted successfully');
                $('#body').html(data);
            }
        });
    }

    function changePage(pageNum){
        $.ajax({
            method: "GET",
            data: {"pageNum":pageNum},
            url: './change.php',
            success: function(data) { 
                $('#body').html(data);
                $('#bttn-'+pageNum).css( "background-color", "#6c757d" );
                $('#bttn-'+pageNum).css( "color", "white" );
            }
        });
    }
</script>


</body>
</html>

