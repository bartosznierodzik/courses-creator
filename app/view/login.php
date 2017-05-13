<?php $this->view('base/header', ['title' => 'Logowanie']); ?>

<div class="container">
    <div style="width:300px; margin: 0 auto;">
        <p>
            <h3>Panel administratora</h3>
        </p>
        <form class="form" action="<?php echo $this->getBase(); ?>login/logIn" method="POST">
            <input class="form-control" type="text" name="username" placeholder="login"/><br>
            <input class="form-control" type="password" name="password" placeholder="hasło"/><br>
            <input class="form-control" type="submit" name="submit" value="Zaloguj"/>
        </form><br />
        <?php echo isset($data['error_message']) ? '<div class="alert alert-danger" role="alert">'.$data['error_message'].'</div>' : ' '; ?>
    </div>
</div>
