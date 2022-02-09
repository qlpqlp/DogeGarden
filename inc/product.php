                  <?php
                      $db = $pdo->query("SELECT * FROM products where id = '".$_GET["product"]."' limit 1")->fetch();
                      $dbc = $pdo->query("SELECT * FROM categories where id = '".$db["id_cat"]."' limit 1")->fetch();
                  ?>
   <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?php echo $db["title"]; ?></h3>

                          <?php if (isset($db["imgs"]) and $db["imgs"] != ""){ ?>
                            <?php
                            $imgs = explode(",", $db["imgs"]);
                            $total = count($imgs);
                            ?>
                          <?php }; ?>

              <div class="col-12">
                <img src="fl/<?php echo $imgs[0];?>" class="product-image dogepic" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                            <?php
                            for( $i=0 ; $i < $total ; $i++ ) {
                              if ($imgs[$i] != ""){
                              ?>
                                <div class="product-image-thumb <?php if ($i == 0){ echo "active"; }; ?>" ><img src="fl/<?php echo $imgs[$i];?>" alt="<?php echo $db["title"]; ?>" onmouseover="$('.dogepic').attr('src', 'fl/<?php echo $imgs[$i];?>');"></div>
                              <?php
                                };
                            };
                            ?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?php echo $dbc["title"]; ?></h3>
              <p>
                <?php echo $dbc["text"]; ?>
              </p>

              <hr>
              <!--
              <h4>Available Colors</h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  Green
                  <br>
                  <i class="fas fa-circle fa-2x text-green"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                  Blue
                  <br>
                  <i class="fas fa-circle fa-2x text-blue"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                  Purple
                  <br>
                  <i class="fas fa-circle fa-2x text-purple"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                  Red
                  <br>
                  <i class="fas fa-circle fa-2x text-red"></i>
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                  Orange
                  <br>
                  <i class="fas fa-circle fa-2x text-orange"></i>
                </label>
              </div>

              <h4 class="mt-3">Size <small>Please select one</small></h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  <span class="text-xl">S</span>
                  <br>
                  Small
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                  <span class="text-xl">M</span>
                  <br>
                  Medium
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                  <span class="text-xl">L</span>
                  <br>
                  Large
                </label>
                <label class="btn btn-default text-center">
                  <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                  <span class="text-xl">XL</span>
                  <br>
                  Xtra-Large
                </label>
              </div>-->

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Ð <?php echo number_format((float)($db["doge"] + ($db["doge"] * $db["tax"] / 100)), 8, '.', ''); ?>
                </h2>
                <h4 class="mt-0">
                  <small>Ex Tax: Ð <?php echo $db["doge"]; ?> </small>
                </h4>
              </div>

              <div class="mt-4">
                 <a href="javascript:insertcart('<?php echo $db["id"];?>',1);" class="btn btn-success btn-lg btn-flat"><i class="fas fa fa-shopping-cart"></i> <?php echo $lang["buy"]; ?></a>
              </div>

              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true"><?php echo $lang["description"]; ?></a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?php echo $db["text"]; ?> </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->