<?php
include_once "db_ecommerce.php";
$con = mysqli_connect($host, $user, $pass, $db);
$id= mysqli_real_escape_string($con,$_REQUEST['id']??'');
$query="SELECT o.`idOrder`, o.`date`, c.name, c.email, c.address FROM `order` o inner join client c on o.idClient = c.idClient where o.idOrder='".$id."'; ";
$res=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($res);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo "Pedido número: ".$id?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
            <h5>Cliente</h5>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" required="required" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="name" class="form-control"  required="required" value="<?php echo $row['address'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Direccion</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['address'] ?>"  required="required" disabled>
                            </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <h5>Productos</h5>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalPedido = 0;
                                $query="SELECT p.name, lo.units, lo.price, lo.subTotal FROM `lineorder` lo join product p on lo.idProduct = p.idProduct where lo.idOrder='".$id."'; ";
                                $res=mysqli_query($con,$query);
                                while($row=mysqli_fetch_assoc($res)){
                                    $totalPedido += $row['subTotal'];
                                ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['units'] ?></td>
                                    <td><?php echo $row['price'] ?> €</td>
                                    <td><?php echo $row['subTotal'] ?> €</td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

            </div>

                <h3><?php echo "Total Pedido: ". $totalPedido?>€</h3>

                <a href="panel.php?modulo=ventas" class="btn btn-primary"> Volver a pedidos </a>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>