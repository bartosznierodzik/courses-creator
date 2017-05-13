<?php
$this->view('base/header', ['title' => 'Dashboard']);
$this->view('base/nav');

$project = $this->getProject($data['project_id']);
foreach ($project as $item){
    $id = $item['id'];
    $subiect = $item['subiect'];
    $date = $item['date'];
    $price = $item['price'];
    $localization = $item['localization'];
    $capacity = $item['capacity'];
    $created_date = $item['created_date'];
    $close_date = $item['close_date'];
    $status = $item['status'];
}
?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3 class="page-header"><?php echo $subiect; ?></h3>
            <div class="row">
                <div class="col-md-6">
                        <form class="form" action="<?php echo $this->getBase(); ?>Projects/editProject/<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                            Temat<input class="form-control" type="text" name="subiect" value="<?php echo $subiect; ?>"/><br />
                            Data<input class="form-control" type="text" name="date" value="<?php echo $date; ?>"/><br />
                            Cena<input class="form-control" type="text" name="price" value="<?php echo $price; ?>"/><br />
                            Lokalizacja<input class="form-control" type="text" name="localization" value="<?php echo $localization; ?>"/><br />
                            Ilość miejs<input class="form-control" type="number" name="capacity" value="<?php echo $capacity; ?>"/><br />
                            Plik PDF<input class="btn btn-default" type="file" name="pdf_file" id="pdf_file" /><br>
                            <input class="btn btn-success form-control" type="submit" name="submit" value="Edytuj"/>
                        </form>
                </div>
                <div class="col-md-6">
                    Data utworzenia - <?php echo $created_date; ?>
                    <?php if($close_date!="0000-00-00")echo '<br/>Data zakończenia - ' . $created_date; ?>
                    <hr>
                    <div class="alert alert-info" role="alert">Poniżej znajdziesz listę uczestników z tego szkolenia</div>
                </div>
            </div>
            <hr>
            <h3>Archiwum uczestników</h3>
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
                        $students = $this->getStudentsList($id);
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
                </div>

<?php $this->view('base/footer'); ?>