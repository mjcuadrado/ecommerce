<?php
include_once "db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
if(isset($_REQUEST['idBorrar'])){
    $id= mysqli_real_escape_string($con,$_REQUEST['idBorrar']??'');
    $query="DELETE from user  where idUser='".$id."';";
    $res=mysqli_query($con,$query);
    if($res){
        ?>
        <div class="alert alert-warning float-right" role="alert">
            Usuario borrado con exito (no tienes corazon)
        </div>
        <?php
    }else{
        ?>
        <div class="alert alert-danger float-right" role="alert">
            Error al borrar <?php echo mysqli_error($con); ?>
        </div>
        <?php
    }
}
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Ventas/h1>
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
                          <table id="example2" class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>Venta</th>
                                      <th>Fecha</th>
                                      <th>Cliente</th>
                                      <th>Total</th>
                                      <th>Detalle</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                    $query = "SELECT o.`idOrder`, o.`date`, c.name, sum(lo.subTotal) as total FROM `order` o inner join lineorder lo on o.idOrder=lo.idLineOrder inner join client c on o.idClient = c.idClient GROUP by o.idOrder order by date asc;  ";
                                    $res = mysqli_query($con, $query);

                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                      <tr>
                                          <td><?php echo $row['idOrder'] ?></td>
                                          <td><?php echo $row['date'] ?></td>
                                          <td><?php echo $row['name'] ?></td>
                                          <td><?php echo $row['total'] ?></td>
                                          <td>
                                              <a href="panel.php?modulo=detalleventas&id=<?php echo $row['idOrder'] ?>" style="margin-right: 5px;"> <i class="fas fa-edit"></i> </a>
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