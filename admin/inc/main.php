   <!-- Main content -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo count($pdo->query("SELECT * FROM orders where status = 0 or status = ''")->fetchAll()); ?></h3>

                <p><?php echo $lang["admin_new_orders"]; ?></p>
              </div>
              <div class="icon">
                <i class="fas fa-shopping-bag"></i>
              </div>
              <a href="?d=orders" class="small-box-footer"><?php echo $lang["admin_more_info"]; ?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo count($pdo->query("SELECT * FROM orders where confirmations < 3")->fetchAll()); ?></h3>

                <p><?php echo $lang["admin_doge_transactions_verification"]; ?></p>
              </div>
              <div class="icon">
                <i class="fas fa-exchange-alt"></i>
              </div>
              <a href="?d=orders" class="small-box-footer"><?php echo $lang["admin_more_info"]; ?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo count($pdo->query("SELECT * FROM shibes")->fetchAll()); ?></h3>

                <p><?php echo $lang["admin_total_shibes"]; ?></p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="?d=shibes" class="small-box-footer"><?php echo $lang["admin_more_info"]; ?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo count($pdo->query("SELECT * FROM cart where id_shibe > 0")->fetchAll()); ?></h3>

                <p><?php echo $lang["admin_pending_cart"]; ?></p>
              </div>
              <div class="icon">
                <i class="fas fa-cart-arrow-down"></i>
              </div>
              <a href="?d=cart" class="small-box-footer"><?php echo $lang["admin_more_info"]; ?> <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
    <?php include("orders.php"); ?>