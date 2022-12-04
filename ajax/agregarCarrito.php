<?php
    $productos= unserialize($_COOKIE['productos']??'');
    if(is_array($productos)==false)$productos=array();
    $siYaEstaProducto=false;
    foreach ($productos as $key => $value) {
        if($value['id']==$_REQUEST['id']){
            $nuevacantidad = $value['cantidad']+$_REQUEST['cantidad'];
            if($nuevacantidad>$value['disponible']){
                $nuevacantidad=$value['disponible'];
            }
            
            $productos[$key]['cantidad']=$nuevacantidad;
            $siYaEstaProducto=true;
        }
    }
    if($siYaEstaProducto==false){

        if($_REQUEST['cantidad']>$_REQUEST['disponible']){
            $_REQUEST['cantidad']=$_REQUEST['disponible'];
        }
        
        $nuevo=array(
            "id"=>$_REQUEST['id'],
            "nombre"=>$_REQUEST['nombre'],
            "web_path"=>$_REQUEST['web_path'],
            "cantidad"=>$_REQUEST['cantidad'],
            "precio"=>$_REQUEST['precio'],
            "disponible"=>$_REQUEST['disponible']
        );
        array_push($productos,$nuevo);
    }
    setcookie("productos",serialize($productos));
    echo json_encode($productos);
    
?>