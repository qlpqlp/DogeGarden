    <!-- Main content -->
        <div class="row">
                  <?php
                      $db = $pdo->query("SELECT p.* FROM products as p JOIN categories as c on p.id_cat = c.id and c.lang = '".$_SESSION["l"]."' where p.highlighted = 1 and p.active = 1 order by p.ord ASC");
                      while ($row = $db->fetch()) {
                  ?>
                    <?php include("product_main.php"); //we include the product design ?>
                  <?php
                  };
                  ?>


        </div>
        <!-- /.row -->