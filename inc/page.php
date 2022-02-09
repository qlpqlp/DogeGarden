                  <?php
                      // we get the page id to display
                      $db = $pdo->query("SELECT * FROM pages where id = '".$_GET["page"]."' limit 1")->fetch();
                      // we check if there is any sub pages
                      $dbm = $pdo->query("SELECT * FROM pages where id_page = '".$_GET["page"]."' and lang = '".$_SESSION["l"]."' and active = 1 limit 1")->fetch();
                  ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $db["title"]; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(isset($dbm["id"])){ // we only show the sub pages menu if there is any active ?>
                    <ul class="navbar-nav dogeh" style="max-width: 290px;">
                      <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                          <i class="far fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                                  <?php
                                      // we get all sup pages menu
                                      $dbs = $pdo->query("SELECT * FROM pages where id_page = '".$_GET["page"]."' and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                                      while ($rows = $dbs->fetch()) {
                                  ?>
                                    <a href="?d=page&page=<?php echo $rows["id"]; ?>" class="dropdown-item">
                                      <i class="fas fa fa-angle-right mr-2"></i> <?php echo $rows["title"]; ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                  <?php
                                  };
                                  ?>
                        </div>
                      </li>
                    </ul>
                <?php }; ?>
    <ul class="navbar-nav d-sm-inline-block">
                                  <?php
                                      // we get all sup pages menu
                                      $dbs = $pdo->query("SELECT * FROM pages where id_page = '".$_GET["page"]."' and lang = '".$_SESSION["l"]."' and active = 1 order by ord ASC");
                                      while ($rows = $dbs->fetch()) {
                                  ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?d=page&page=<?php echo $rows["id"]; ?>" class="btn btn-block btn-secondary"><i class="fas fa fa-angle-right mr-2"></i> <?php echo $rows["title"]; ?></a>
      </li>
                  <?php
                  };
                  ?>
    </ul>
    <p>
                <?php echo $db["text"]; ?>
</p>
              </div>
            </div>