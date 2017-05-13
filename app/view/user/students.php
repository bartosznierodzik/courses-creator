<?php
$this->view('base/header', ['title' => 'Dashboard']);
$this->view('base/nav');
?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!--        <h1 class="page-header">Zapisani uczestnicy</h1>-->

        <?php
            $current = $this->getCurrentProject();
            if(empty($current['id'])){
                echo '<div class="alert-info alert">Obecnie nie przeprowadzasz szkoleń, przejdź do zakładki szkolenia aby dodać nowe</div>';
            }else{
                $students = $this->getStudentsList($current['id']);
        ?>

            <h4 class="sub-header">Uczestnicy zapisani na: <b><?php echo $current['subiect']; ?></b></h4>

                Zajętość <b><?php echo $students->num_rows . ' / ' . $current['capacity']; ?></b>
            <div class="table-responsive">
                <table id="students_table" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Imie i Nazwisko</th>
                        <th>Firma</th>
                        <th>NIP</th>
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Data rejestracji</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($students as $student){
                        echo '<tr>';
                        echo '<td><a href="' . $this->getBase() . 'Students/student/' . $student['id'] . '">' . $student['name'] . ' ' . $student['surname'] . '</a></td>';
                        echo '<td>' . $student['brand'] . '</td>';
                        echo '<td>' . $student['nip'] . '</td>';
                        echo '<td>' . $student['telephone'] . '</td>';
                        echo '<td>' . $student['email'] . '</td>';
                        echo '<td>' . $student['register_at'] . '</td>';
                        echo '<td><a href="' . $this->getBase() . 'Students/deleteStudent/' . $student['id'] . '" title="Usuń osobę"><button onclick="confirm("Czy na pewno chcesz usunąć tą osobę?")" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
                <p><a href="<?php echo $this->getBase() . 'Students/toCsv/'.$current['id']; ?>" class="btn btn-default">Eksport do CSV</a></p>
                <div style="position: static; bottom:0px;" class="alert-info alert">Aby <b>edytować dane uczestnika</b> kliknij na jego imię.</div>
            </div>
            <?php } ?>
    </div>

<?php $this->view('base/footer'); ?>