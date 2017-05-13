<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($data['title']) ? $data['title'] : 'Base title'; ?></title>
        <link rel="stylesheet" href="<?php echo $this->getBase(); ?>bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo $this->getBase(); ?>css/dashboard.css"/>
        <link rel="stylesheet" href="<?php echo $this->getBase(); ?>css/style.css"/>

        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

        <script src="<?php echo $this->getBase(); ?>js/functions.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#dateEnd" ).datepicker({ dateFormat: 'yy-mm-dd' });
            } );
            $( function() {
                $( "#dateStart" ).datepicker({ dateFormat: 'yy-mm-dd' });
            } );
        </script>

        <script src="<?php echo $this->getBase(); ?>js/js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
        
    </head>
    <body onload="onLoadFunctions()">