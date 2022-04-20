        <div class="row">
                  <?php // we list all products
                      $db = $pdo->query("SELECT p.* FROM products as p JOIN categories as c on p.id_cat = c.id and c.lang = '".$_SESSION["l"]."' where p.id_cat = '".$_GET["c"]."' and p.active = 1 order by p.ord ASC");
                      while ($row = $db->fetch()) {
                         // we get the TAX for that product
                         $rowt["tax"] = 0; // we set default to zero
                         if (isset($_SESSION["country"])){ // we check if Shibe is logged in and we get only shipping from all countries or his own country
                                $rowt = $pdo->query("SELECT * FROM tax where category = '".$row["cat_tax"]."' and country = '".$_SESSION["country"]."' limit 1")->fetch();
                            }else{
                                $rowt = $pdo->query("SELECT * FROM tax where category = '".$row["cat_tax"]."' limit 1")->fetch();
                            }
                  ?>
                    <?php include("product_main.php"); //we include the product design ?>
                  <?php
                  };
                  ?>


        </div>
        <!-- /.row -->