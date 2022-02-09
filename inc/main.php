    <!-- Main content -->
        <?php
            $bd = $pdo->query("SELECT * FROM banners where id_cat = 0 and id_prod = 0 and id_page = 0 and lang = '".$_SESSION["l"]."' and active = 1")->fetch();
            if (isset($bd["id"])){
         ?>
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="carouselDogeIndicators" class="carousel slide pointer-event" data-ride="carousel">
                    <ol class="carousel-indicators">
                  <?php
                      $i = 0;
                      $db = $pdo->query("SELECT * FROM banners where id_cat = 0 and id_prod = 0 and id_page = 0 and lang = '".$_SESSION["l"]."' and active = 1");
                      while ($row = $db->fetch()) {
                  ?>
                      <li data-target="#carouselDogeIndicators" data-slide-to="<?php echo $i; ?>" class="<?php if ($i == 0){ ?>active<?php };?>"></li>
                  <?php
                  $i++;
                  };
                  ?>
                    </ol>
                    <div class="carousel-inner" style="max-height: 300px;">

                  <?php
                      $i = 0;
                      $db = $pdo->query("SELECT * FROM banners where id_cat = 0 and id_prod = 0 and id_page = 0 and lang = '".$_SESSION["l"]."' and active = 1");
                      while ($row = $db->fetch()) {
                  ?>
                      <div class="carousel-item <?php if ($i == 0){ ?>active<?php };?>" style="background-image: url(fl/<?php echo $row["img"]; ?>); background-size: cover; background-position: center; background-repeat: no-repeat">
                      <?php
                      if ($row["video"] != ""){
                      ?>
                      <div style="position: absolute; width: 100%;height: 56.25vw !important;margin-top: -5.9vw;">
                        <div data-video="data-video" data-autoplay="true" data-hide-controls="true" data-loop="true" class="video-block" style="position: absolute;height: 100%;width: 100%;margin: 0;padding: 0;">
                            <iframe src="<?php echo $row["video"];?>?rel=0&controls=0&showinfo=0&wmode=opaque&autoplay=1&modestbranding=1&loop=1&mute=1" width="100%" height="100%" class="video-block__media" style="opacity: 1; transition: opacity 0.5s ease-in-out 0s;" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; playlist; loop" ></iframe>
                        </div>
                      </div>
                      <div style=" width: 100%; min-height: 300px;">&nbsp;</div>
                        <?php
                        }else{
                        ?>
                        <div style=" width: 100%; min-height: 300px;">&nbsp;</div>
                        <?php
                        };
                        ?>
                      </div>
                  <?php
                  $i++;
                  };
                  ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselDogeIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                      </span>
                      <span class="sr-only"><?php echo $lang["previous"]; ?></span>
                    </a>
                    <a class="carousel-control-next" href="#carouselDogeIndicators" role="button" data-slide="next">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                      </span>
                      <span class="sr-only"><?php echo $lang["next"]; ?></span>
                    </a>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->
          </div>
        </div>
        <?php }; ?>
        <div class="row">
                  <?php
                      $db = $pdo->query("SELECT p.* FROM products as p JOIN categories as c on p.id_cat = c.id and c.lang = '".$_SESSION["l"]."' where p.highlighted = 1 and p.active = 1 order by p.ord ASC");
                      while ($row = $db->fetch()) {
                  ?>
                    <!-- /.col-md-3 -->
                    <div class="col-lg-3">
                      <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h5 class="m-0"><?php echo $row["title"];?></h5>
                        </div>
                        <div class="card-body">
                          <?php if (isset($row["imgs"]) and $row["imgs"] != ""){ $imgs = explode(",", $row["imgs"]); ?><a href="?d=product&product=<?php echo $row["id"];?>"><img class="card-img-top" src="fl/<?php echo $imgs[0]; ?>"></a><?php }; ?>
                          <!--<p class="card-text">
                          A Cannoli Doge is a food consisting of a grilled or steamed sausage served in the slit of a partially sliced bun. The term Cannoli Doge can also refer to the sausage</p>-->
                          <div style="padding-top: 10px">
                            <a href="#" class="btn btn-light">Ð <?php echo number_format((float)($row["doge"] + ($row["doge"] * $row["tax"] / 100)), 8, '.', ''); ?></a>
                            <a href="javascript:insertcart('<?php echo $row["id"];?>',1);" class="btn btn-success" style="float: right"><i class="fas fa fa-shopping-cart"></i> <?php echo $lang["buy"]; ?></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-md-3 -->
                  <?php
                  };
                  ?>


        </div>
        <!-- /.row -->