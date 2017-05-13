<?php
$this->view('base/header', ['title' => 'Dashboard']);
$this->view('base/nav');
?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Szkolenia</h1>

        <?php
            $current = $this->getCurrentProject();
            if($current['id']){
                echo "Aby utworzyć nowe szkolenie musisz zakończyć obecne<br><h3>" . $current['subiect'] . "</h3><br>";
                echo '<a href="' . $this->getBase() . 'Projects/project/' . $current['id'] . '" title="Edytuj"><button class="btn btn-primary">Edytuj</button></a>';
                echo ' <a href="' . $this->getBase() . 'Projects/closeProject/' . $current['id'] . '" title="Zakończ projekt"><button class="btn btn-default">Zakończ szkolenie</button></a>';
            }else{
        ?>

            <h3>Nowe szkolenie</h3>
            <form class="form" action="<?php echo $this->getBase(); ?>Projects/addProject" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        Temat<input class="form-control" type="text" name="subiect"/><br />
                        Data<input class="form-control" type="text" name="date"/><br />
                        Cena<input class="form-control" type="text" name="price"/><br />
                        Lokalizacja<input class="form-control" type="text" name="localization"/><br />
                        Ilość miejs<input class="form-control" type="number" name="capacity"/><br />
                        Plik PDF<input class="btn btn-default" type="file" name="pdf_file" id="pdf_file" /><br>
                        <input class="btn btn-success form-control" type="submit" name="submit" value="Dodaj Szkolenie"/>
                    </div>
                    <div class="col-md-6">
                        <?php echo isset($data['message']) ? '<div class="alert alert-'.$data['message_type'].' myalert" role="alert">'.$data['message'].'</div>' : ' '; ?>
                    </div>
                </div>
            </form>

        <?php } ?>
        <hr>
        <h3 class="sub-header">Szkolenia</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Temat</th>
                    <th>Data rozpoczęcia</th>
                    <th>Data ukończenia</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $projects = $this->getProjects();
                foreach ($projects as $project){
                    echo '<tr>';
//                    if ($project['status']==1)echo '<td><a href="' . $this->getBase() . 'Timer/startTimer/' . $project['id'] .'"><button class="btn btn-primary"><span class="glyphicon glyphicon-play"></span></button></a></td>';
                    echo '<td><a href="' . $this->getBase() . 'Projects/project/' . $project['id'] . '">' . $project['subiect'] . '</a></td>';
                    echo '<td>' . $project['created_date'] . '</td>';
                    if($project['close_date']!="0000-00-00")echo '<td>' . $project['close_date'] . '</td>';else echo '<td></td>';
                    echo '<td><a href="' . $this->getBase() . 'Projects/deleteProject/' . $project['id'] . '" title="Usuń projekt"><button onclick="confirm("Czy na pewno chcesz usunąć to zagadnienie?")" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></a></td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
            <div style="position: static; bottom:0px;" class="alert-info alert">Aby <b>edytować szkolenie</b> lub <b>sprawdzić archiwum z uczestnikami</b> kliknij na jego nazwę.</div>
        </div>
    </div>

<?php $this->view('base/footer'); ?>