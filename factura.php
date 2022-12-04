<?php
    $total=$_REQUEST['total']??'';

    $queryVenta="INSERT INTO `order` (`idClient`, `date`) values ('".$_SESSION['idCliente']."',now());";
    
    $resVenta=mysqli_query($con,$queryVenta);
    $id=mysqli_insert_id($con);
    
    $insertaDetalle="";
    $cantProd=count($_REQUEST['id']);
    for($i=0;$i<$cantProd;$i++){
        $subTotal=$_REQUEST['precio'][$i]*$_REQUEST['cantidad'][$i];
        $insertaDetalle=$insertaDetalle."('".$_REQUEST['id'][$i]."','$id','".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio'][$i]."','$subTotal'),";
    }
    $insertaDetalle=rtrim($insertaDetalle,",");
    $queryDetalle="INSERT INTO lineorder (idProduct, idOrder, units, price, subTotal) values 
    $insertaDetalle;";
    $resDetalle=mysqli_query($con,$queryDetalle);

    if($resVenta && $resDetalle){
       
        ?> 
        <div class="alert alert-success" role="alert">
        <?php
             echo "Pedido ".$id." realizado corectamente. Será redirigido a la página principal en 5 segundos.";
        ?>
        </div>
        <script src="admin/plugins/jquery/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $.ajax({
                type: "post",
                url: "ajax/borrarCarrito.php",
                dataType: "json",
                success: function (response) {
                    llenaCarrito(response);
                    setTimeout(()=>window.location = "index.php", 5000);
                }
            });
            function llenaCarrito(response){
                var cantidad=Object.keys(response).length;
                if(cantidad>0){
                    $("#badgeProducto").text(cantidad);
                }else{
                    $("#badgeProducto").text("");
                }
                $("#listaCarrito").text("");
                Array.from(response).forEach(element => {
                    $("#listaCarrito").append(
                        `
                        <a href="index.php?modulo=detalleproducto&id=${element['id']}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="${element['web_path']}" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        ${element['nombre']}
                                        <span class="float-right text-sm text-primary"><i class="fas fa-eye"></i></span>
                                    </h3>
                                    <p class="text-sm">Cantidad ${element['cantidad']}</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        `
                    );
                });
                $("#listaCarrito").append(
                    `
                    <a href="index.php?modulo=carrito" class="dropdown-item dropdown-footer text-primary">
                        Ver carrito 
                        <i class="fa fa-cart-plus"></i>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer text-danger" id="borrarCarrito">
                        Borrar carrito 
                        <i class="fa fa-trash"></i>
                    </a>
                    `
                );
            }  
        });
        </script>
<?php    
    }else{
        echo "Error al realizar el pedido.";
    }

?>