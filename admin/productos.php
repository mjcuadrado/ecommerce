<?php
include_once "db.php";
$con = mysqli_connect($host, $user, $pass, $db);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Productos</h1>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table  class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Precio</th>
                                      <th>Existencia</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                    $query = "SELECT * from product;  ";
                                    $res = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                      <tr>
                                          <td><?php echo $row['name'] ?></td>
                                          <td><?php echo $row['price'] ?></td>
                                          <td><?php echo $row['available'] ?></td>
                                          <td>
                                              <a href="admin.php?modulo=editarProducto&id=<?php echo $row['idProduct'] ?>" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
                                              <a href="admin.php?modulo=productos&idBorrar=<?php echo $row['idProduct'] ?>" class="text-danger borrar"> <i class="fas fa-trash"></i> </a>
                                          </td>
                                      </tr>
                                  <?php
                                    }
                                    ?>
                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
  </div>