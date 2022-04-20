                    <!-- /.col-md-3 -->
                    <div class="col-lg-3">
                      <div class="card card-secondary card-outline">
                        <div class="card-header">
                          <h5 class="m-0"><i class="fa fa-th-list"></i> <?php echo $row["title"];?></h5>
                        </div>
                        <div class="card-body">
                          <a href="?d=<?php echo $_GET["d"]; ?>&do=view&id=<?php echo $row["id"];?>"><div class="card-img-top" style="background-image: url('../fl/<?php echo $row["img"];?>'); background-position: center; background-size: cover; min-width: 100%; min-height: 200px"></div></a>
                        </div>
                      </div>
                    </div>
                    <!-- /.col-md-3 -->