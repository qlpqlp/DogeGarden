<?php
// include the configuration and functions
include("config.php");

if (isset($_POST["fetch"])){
?>

                  <?php
                      $db = $pdo->query("SELECT p.* FROM products as p JOIN categories as c on p.id_cat = c.id and c.lang = '".$_SESSION["l"]."' where p.title LIKE '%".$_POST["fetch"]."%' and p.active = 1 order by p.ord ASC");
                      while ($row = $db->fetch()) {
                  ?>
                    <!-- /.col-md-2 -->
                    <div class="col-lg-2">
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
                            <a href="javascript:insertcart('<?php echo $row["id"];?>',1);" class="btn btn-success" style="float: right" ><i class="fas fa fa-shopping-cart"></i> <?php echo $lang["buy"]; ?></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-md-2 -->
                  <?php
                  };


};
?>