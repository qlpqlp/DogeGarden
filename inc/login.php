  <style type="text/css">
  .lockscreen-image {
      left: -30px;
      top: -2px;
  }
  </style>
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="img/logo_dgg.png" alt="DogeGarden">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="?d=shibe&do=login" method="post">
      <div class="input-group">
        <input type="email" name="email" class="form-control" placeholder="<?php echo $lang["email"]; ?>" required="required">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-users text-muted"></i>
          </button>
        </div>
      </div>
      <div class="input-group">
        <input type="password" name="password" class="form-control" placeholder="<?php echo $lang["password"]; ?>" required="required">

        <div class="input-group-append">
          <button type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
                <p style="text-align: center">
                <a href="?d=shibe&do=insert" style="margin: 10px; color: #869099">
                  <i class="nav-icon far fa fa-id-card"></i>
                  <?php echo $lang["register"]; ?>
                </a>
                <a href="?d=recover" style="margin: 10px; color: #869099">
                  <i class="nav-icon far fa fa-user-lock"></i>
                  <?php echo $lang["password_recover"]; ?>
                </a>
                </p>