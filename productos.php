<?php include("template/cabecera.php"); ?>
<?php include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
$listaProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <?php foreach ($listaProducto as $mueble) { ?>
            <div class="col-md-3 mt-4">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $mueble['imagen']; ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $mueble['nombre']; ?></h4>
                        <a name="" id="" class="btn btn-primary" href="#" role="button">Ver más</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("template/pie.php"); ?>
