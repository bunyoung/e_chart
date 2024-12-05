<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-hycenter</title>
</head>

<body>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <img src="ViewImage.php?hn=<?= $hn ?>" style="margin-left:10px;margin-top:0px;width:70px;height:80px;">
        </div>
        <div class="col-md-9">
            <div class="row">
                <label class="label-control"> ชื่อ สกุล : <?= $na ?>
            </div>
            <div class="row">
                <label class="label-control"> อายุ : <?= $old ?> ปี
            </div>
            <div class="row">
                <label class="label-control"> บปช : <?= $idcard ?>
            </div>
        </div>
    </div>
    <br>
    <!-- </div>
    </div> -->
</body>

</html>