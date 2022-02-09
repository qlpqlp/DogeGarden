  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="img/logo_dgg.png" alt="DogeGarden">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="?d=recover&do=password" method="post">
      <div class="input-group">
        <input type="email" name="email" class="form-control" placeholder="<?php echo $lang["email"]; ?>" required="required">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-users text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>