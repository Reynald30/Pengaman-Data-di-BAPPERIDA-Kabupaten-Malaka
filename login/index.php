

<?php include('top-login.php') ?>
<h2><center><strong>Aplikasi Pengaman Data </strong></center></h2>
<h3><center><strong>Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah (BAPPERIDA) Kabupaten Malaka</strong></center></h3>
<div class="row" style="margin-top: 50px">
  <div class="col-md-4 col-md-offset-4">
    <div class="well">

      <form class="form-signin" method="post" action="../login/proses-login.php">
        <h2 class="form-signin-heading text-center">
          <strong>LOGIN</strong>          
        </h2>        
        <input type="text" name="username_user" class="form-control" placeholder="Username" autofocus required>

        <input type="password" name="password_user" class="form-control" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">
        Masuk
        </button>
      </form>
    </div>
  </div>
</div>

<?php include('bottom-login.php') ?>
