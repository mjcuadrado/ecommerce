<?php
if (isset($_SESSION['idCliente'])) {
    if(isset($_REQUEST['guardar'])){
        $nombreCli=$_REQUEST['nombreCli']??'';
        $emailCli=$_REQUEST['emailCli']??'';
        $direccionCli=$_REQUEST['direccionCli']??'';
        $queryCli="UPDATE client set name='$nombreCli',email='$emailCli',address='$direccionCli' where idClient='".$_SESSION['idCliente']."' ";
        $resCli=mysqli_query($con,$queryCli);

        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=pasarela" />';
    }
    $queryCli="SELECT name,email,address from client where idClient='".$_SESSION['idCliente']."';";
    $resCli=mysqli_query($con,$queryCli);
    $rowCli=mysqli_fetch_assoc($resCli);

?>
    <form method="post">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <h3>Datos del cliente</h3>
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombreCli" id="nombreCli" class="form-control" value="<?php echo $rowCli['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="emailCli" id="emailCli" class="form-control" readonly="readonly" value="<?php echo $rowCli['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Direccion</label>
                        <textarea name="direccionCli" id="direccionCli" class="form-control" row="3"><?php echo $rowCli['address'] ?></textarea>
                    </div>
                </div>
                
            </div>
        </div>
        <a class="btn btn-warning" href="index.php?modulo=carrito" role="button">Regresar al carrito</a>
        <button type="submit" class="btn btn-primary float-right" name="guardar" value="guardar">Ir a pagar</button>
    </form>
<?php
} else {
?>
    <div class="mt-5 text-center">
        Debe <a href="login.php">loguearse</a> o <a href="registro.php">registrarse</a>
    </div>
<?php

}
?>