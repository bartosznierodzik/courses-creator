<nav class="navbar navbar-inverse navbar-fixed-top" xmlns="http://www.w3.org/1999/html">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><span style="font-family: 'Righteous', cursive; color:aqua; font-size:24px;">D-Link </span> <span style="font-size: 10px;"> ACADEMY</span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $this->getBase() ?>login/logOut">Wyloguj</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <p>Witaj</p>
        <!-- menu -->
          <ul class="nav nav-sidebar">
            <li <?php if($_SESSION['active_menu'] == 'dashboard') echo 'class="active"'; ?>><a href="<?php echo $this->getBase() ?>dashboard"><span class="glyphicon glyphicon-home">&nbsp;</span>Overview</a></li>
            <li <?php if($_SESSION['active_menu'] == 'students') echo 'class="active"'; ?>><a href="<?php echo $this->getBase() ?>Students"><span class="glyphicon glyphicon-user">&nbsp;</span>Uczestnicy</a></li>
            <li <?php if($_SESSION['active_menu'] == 'projects') echo 'class="active"'; ?>><a href="<?php echo $this->getBase() ?>Projects"><span class="glyphicon glyphicon-folder-open">&nbsp;</span>Szkolenia</a></li>
          </ul>
        </div>