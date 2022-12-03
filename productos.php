<div class="col-md-12">
    <p>Categorias: </p>
    <a href="index.php?modulo=productos"  class="btn btn-primary">Todos</a>
<?php
$queryCat = "SELECT * FROM category;";
    $resCat = mysqli_query($con, $queryCat);
    while ($row = mysqli_fetch_assoc($resCat)) {
        ?>
        <a href="index.php?modulo=productos&categoria=<?php echo $row['idCategory'] ?>"  class="btn btn-primary"><?php echo $row['name'] ?></a>
<?php
    }
?> 
</div>
<div class="row mt-1">
    <?php
    $where = " where 1=1 ";
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');

    
    $catSel = $_REQUEST['categoria'] ?? false;
    if ($catSel) {
        $where .= " and idCategory='$catSel' ";
    }

    if (empty($nombre) == false) {
        $where = "and nombre like '%" . $nombre . "%'";
    }
    $queryCuenta = "SELECT COUNT(*) as cuenta FROM product  $where ;";
    $resCuenta = mysqli_query($con, $queryCuenta);
    $rowCuenta = mysqli_fetch_assoc($resCuenta);
    $totalRegistros = $rowCuenta['cuenta'];

    $elementosPorPagina = 6;

    $totalPaginas = ceil($totalRegistros / $elementosPorPagina);

    $paginaSel = $_REQUEST['pagina'] ?? false;

    if ($paginaSel == false) {
        $inicioLimite = 0;
        $paginaSel = 1;
    } else {
        $inicioLimite = ($paginaSel - 1) * $elementosPorPagina;
    }
    $limite = " limit $inicioLimite,$elementosPorPagina ";
    $query = "SELECT 
                        p.idProduct,
                        p.name,
                        p.price,
                        p.available,
                        f.webPath,
                        f.filename
                        FROM
                        product AS p
                        INNER JOIN productfile AS pf ON pf.idProduct=p.idProduct
                        INNER JOIN file AS f ON f.idFile=pf.idFile
                        $where
                        GROUP BY p.idProduct
                        $limite
                        ";
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($res)) {
    ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card border-primary">
                <img class="card-img-top img-thumbnail" src="<?php echo "admin/images/product/".$row['filename'] ?>" alt="">
                <div class="card-body">
                    <h2 class="card-title"><strong><?php echo $row['name'] ?></strong></h2>
                    <p class="card-text"><strong>Precio:</strong><?php echo $row['price'] ?></p>
                    <p class="card-text"><strong>Existencia:</strong><?php echo $row['available'] ?></p>
                    <a href="index.php?modulo=detalleproducto&id=<?php echo $row['idProduct'] ?>" class="btn btn-primary">Ver</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php
if ($totalPaginas > 0) {
?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            if ($paginaSel != 1) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            for ($i = 1; $i <= $totalPaginas; $i++) {
            ?>
                <li class="page-item <?php echo ($paginaSel == $i) ? " active " : " "; ?>">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php
            }
            ?>
            <?php
            if ($paginaSel != $totalPaginas) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>
<?php
}
?>