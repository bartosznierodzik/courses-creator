<?php
$this->view('base/header', ['title' => 'Dashboard']);
$this->view('base/nav');
?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" xmlns="http://www.w3.org/1999/html">
        <h3 class="page-header">Witaj</h3>
        <div class="row">
            <div class="col-md-4">
                <h3><span class="label label-info">Jak zacząć ?</span></h3>
                <p>Aby dodać pierwsze szkolenie przejdź do zakładki szkolenia</p>
                <p>Zapisanych uczestników na aktualne szkolenie sprawdzisz w zakładce uczestnicy</p>
            </div>
            
            <div class="col-md-4">
                <h3><span class="label label-info">W przyszłości</span></h3>
                <ul>
                    <li>Archiwum uczestników z poprzednich szkoleń</li>
                    <li>Eksport tabel z uczestnikami do pliku csv</li>
                </ul>
            </div>
        </div>
    </div>

<?php $this->view('base/footer'); ?>