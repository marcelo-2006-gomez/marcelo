<?php include('../template/cabecera.php'); ?>
<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtAccion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

 include('../config/bd.php'); 
switch ($txtAccion) {
  case "Agregar":
      
    $sentenciaSQL=$conexion->prepare("INSERT INTO producto (nombre, imagen) VALUES (:nombre, :imagen);");
    $sentenciaSQL->bindParam(':nombre',$txtNombre); 

  //adjuntar imagen a la carpeta img
     $fecha=new DateTime(); 
     $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
      // Almacenar el nombre temporal de la imagen
     $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

     if ($tmpImagen!=""){
         // si esa imagen no esta vacia que la mueva a la carpeta img con el nuevo nombre del archivo
         move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
     }



    $sentenciaSQL->bindParam(':imagen',$txtImagen); 
    $sentenciaSQL->execute();

    break;
  case "Modificar":

    
    $sentenciaSQL=$conexion->prepare(" UPDATE producto SET nombre=:nombre  WHERE id= :id");
    $sentenciaSQL->bindParam(':nombre',$txtNombre);
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();

    if ($txtImagen!=""){



      $fecha= new DateTime ();
      $nombreArchivo=($txtImagen!="")?
      $fecha->getTimestamp()."_".$_FILES
      ["txtImagen"]["nombre"]:"imagen.jpg"; 
  
  $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

  move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);



  $sentenciaSQL=$conexion->prepare("SELECT imagen  FROM producto WHERE id= :id");
  $sentenciaSQL->bindParam(':id',$txtID);
  $sentenciaSQL->execute();
  $mueble= $sentenciaSQL->fetch(PDO::FETCH_LAZY);

//eliminar la imgaen en el servidor

if(isset($mueble["imagen"])&&($mueble["imagen"]!="imagen.jpg")){
if(file_exists("../../img/".$mueble["imagen"])){
unlink("../../img/".$mueble["imagen"]);

}
}


   
      $sentenciaSQL=$conexion->prepare(" UPDATE producto SET Imagen=:Imagen  WHERE id= :id");
    
      $sentenciaSQL->bindParam(':Imagen',$txtImagen);

    $sentenciaSQL->bindParam(':id',$txtID);

    $sentenciaSQL->execute();
    }

    $fecha= new DateTime ();
    $nombreArchivo=($txtImagen!="")?
    $fecha->getTimestamp()."_".$_FILES
    ["txtImagen"]["nombre"]:"imagen.jpg"; 



$tmpImagen=$_FILES["txtImagen"]["tmp_name"];
if($tmpImagen!=""){

  move_uploaded_file($tempImagen,"../../img/".$nombreArchivo);
  
}
header('location:productos.php');

    break;
  case "Cancelar":
   header('location:productos.php');
    break;
  case "seleccionar":

    $sentenciaSQL=$conexion->prepare("SELECT *  FROM producto WHERE id= :id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $mueble= $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    $txtNombre=$mueble['nombre'];
    $txtImagen=$mueble['Imagen'];


    break;
    case "borrar":
      
      $sentenciaSQL=$conexion->prepare("SELECT imagen  FROM producto WHERE id= :id");
      $sentenciaSQL->bindParam(':id',$txtID);
      $sentenciaSQL->execute();
      $mueble= $sentenciaSQL->fetch(PDO::FETCH_LAZY);

//eliminar la imgaen en el servidor

if(isset($mueble["imgaen"])&&($mueble["imagen"]!="imagen.jpg")){
  if(file_exists("../../img".$mueble["imagen"])){
    unlink("../../img/".$mueble["imagen"]);

  }
}






    $sentenciaSQL=$conexion->prepare("DELETE  FROM producto WHERE id= :id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
header('location:productos.php');
    break;
    
    
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
$listaProducto= $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<!---->
<div class="col-md-5">
  <div class="card">
    <div class="card-header">
      DATOS DEL MUEBLE
    </div>
    <div class="card-body">

      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtID">ID</label>
          <input type="text" readonly class="form-control" name="txtID" value="<?php echo $txtID;?>"id="txtID" placeholder="ID">
        </div>

        <div class="form-group">
          <label for="txtNombre">Nombre</label>
          <input type="text" class="form-control" name="txtNombre"value="<?php echo $txtNombre;?>" id="txtNombre" placeholder="Nombre">
        </div>

        <div class="form-group">
          <label for="txtImagen">Imagen</label>
          <?php echo $txtImagen;?>

<?php if ($txtImagen!=""){?>  <img src="../../img/<?php echo $mueble
          ['imagen'];?>" width="50" class="rounded"
          alt="">
<?php } ?>


          <input type="file" class="form-control-file" name="txtImagen" id="txtImagen" placeholder="Imagen">
        </div>

        <div class="btn-group" role="group" aria-label="">
          <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
          <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
          <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-md-7">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
<!---->
    <?php foreach($listaProducto as $mueble){?>
      <tr>
        <td><?php echo $mueble['id']; ?></td>
        <td><?php echo $mueble['nombre']; ?></td>
      

        <td>
          <img src="../../img/<?php echo $mueble
          ['imagen'];?>" width="50" class="rounded"
          alt="">
        </td>
        
        <td>Seleccionar|Borrar
        <form method="POST">
          <input type="hidden" name="txtID" id="txtID" value="<?php echo $mueble ['id'];?>">
          <input type="submit" name="accion" value="seleccionar" class="btn btn-primary">
          <input type="submit" name="accion" value="borrar" class="btn btn-danger">
        </form>


        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<?php include('../template/pie.php');?>