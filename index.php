<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dlink Academy</title>

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="panel/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>body{font-family: 'Lato', sans-serif;}</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1><img src="panel/img/akademia.png" alt="logo"></h1>
            <hr>
            <?php
                include_once 'app/core/Database.php';
                $model = new Model('projects');

                $model->load('status', '1');

                if(!$model->get('id')){
                    echo '<div class="alert-info alert">Obecnie brak przeprowadzanych szkoleń</div>';
                }else{
                    $project = [
                        'id' => $model->get('id'),
                        'subiect' => $model->get('subiect'),
                        'date' => $model->get('date'),
                        'price' => $model->get('price'),
                        'localization' => $model->get('localization'),
                        'capacity' => $model->get('capacity'),
                    ];
                    unset($model);
                    $model = new Model('students');
                    $students = $model->getAll('id', 'id_project', $project['id']);
                    $students->num_rows;

                    if($students->num_rows >= $project['capacity']){
                        echo '<div class="alert alert-danger" role="alert">Niestety, skończyły sie już miejsca na to szkolenie. Ktoś Cię ubiegł.</div>';
                    }else{
            ?>
            <div class="list-group">
                <span class="list-group-item active" style="background: #231F20;">
                    <h4>Temat szkolenia: <b><?php echo $project['subiect']; ?></b></h4>
                </span>
                <span class="list-group-item">Data: <b><?php echo $project['date']; ?></b></span>
                <span class="list-group-item">Koszt: <b><?php echo $project['price']; ?></b></span>
                <span class="list-group-item">Miejsce: <b><?php echo $project['localization']; ?></b></span>
            </div>
            <?php if(($project['capacity'] - $students->num_rows) == 1) echo '<div class="alert alert-danger" role="alert">Zostało <b>ostatnie miejsce</b> na to szkolenie!</div>'; ?>
            <br />


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Formularz rejestracyjny</h3>
                        </div>
                    </div>

    <br>

            <form action="panel/Students/addStudent" method="POST" class="form-horizontal">
                <div class="form-group">
                    <label for="imie" class="col-sm-2 control-label">Imię</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="imie" id="imie" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nazwisko" class="col-sm-2 control-label">Nazwisko</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nazwisko" id="nazwisko" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="firma" class="col-sm-2 control-label">Nazwa firmy</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="firma" id="firma" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nip" class="col-sm-2 control-label">NIP</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nip" id="nip" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Adres e-mail</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tel" class="col-sm-2 control-label">Tel. kontaktowy</label>
                    <div class="col-sm-4">
                        <input type="tel" class="form-control" name="tel" id="tel" required>
                    </div>
                </div>
                
                <input type="text" class="form-control" name="szkolenie" id="szkolenie" value="<?php echo $project['id']; ?>" style="display: none;">

                <div class="form-group">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary pull-right" style="width: 126px; background: #231F20;">Wyślij</button>
                    </div>
                </div>

                <br />
            </form>
            <br>
            <br>
            <br>
            <br>
            <?php }} ?>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Slider script-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
