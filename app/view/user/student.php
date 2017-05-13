<?php
$this->view('base/header', ['title' => 'Dashboard']);
$this->view('base/nav');

$student = $this->getStudent($data['student_id']);
foreach ($student as $item){
    $id = $item['id'];
    $name = $item['name'];
    $surname = $item['surname'];
    $brand = $item['brand'];
    $nip = $item['nip'];
    $telephone = $item['telephone'];
    $email = $item['email'];
    $register_at = $item['register_at'];
}
?>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h3 class="page-header"><?php echo $name . ' ' .$surname; ?></h3>
            <div class="row">
                <div class="col-md-6">
                        <form class="form" action="<?php echo $this->getBase(); ?>Students/editStudent/<?php echo $id; ?>" method="POST">
                            Imię<input class="form-control" type="text" name="name" value="<?php echo $name; ?>"/><br />
                            Nazwisko<input class="form-control" type="text" name="surname" value="<?php echo $surname; ?>"/><br />
                            Firma<input class="form-control" type="text" name="brand" value="<?php echo $brand; ?>"/><br />
                            NIP<input class="form-control" type="text" name="nip" value="<?php echo $nip; ?>"/><br />
                            Telefon<input class="form-control" type="text" name="tel" value="<?php echo $telephone; ?>"/><br />
                            E-mail<input class="form-control" type="text" name="email" value="<?php echo $email; ?>"/><br />
                            <input class="btn btn-success form-control" type="submit" name="submit" value="Edytuj"/>
                        </form>
                </div>
                <div class="col-md-6">
                    Data utworzenia - <?php echo $register_at; ?>
                </div>


</div>

<?php $this->view('base/footer'); ?>