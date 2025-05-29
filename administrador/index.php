

<?php 
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST"){
if(($_POST['usuario']=="marcelo")&&($_POST['contraseña']=="sistema")){


$_SESSION['usuario']="ok";
$_SESSION['nombreUsuario']="marcelo";
header('location:inicio.php');
}else{
    $mensaje="Error:el usuario y la contraseña son incorrectos";

}
}























?>






<?php 
if($_POST){
header(header:'location:inicio.php');



}






?>







<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"href="../css/bootstrap.min.css"/>
  </head>
  <body>
   
<!-- esto se agrega con b4 greed defaul-->
    <div class="container"><!--esto sirve para poner todo junto en una linea-->
        <div class="row">
            <div class="col-md-4"><!--agrego b4grid-col-->
                
            </div>
            <div class="col-md-4">

                <br> </br><!-- agrega espacios mas br mas espacios-->
                <div class="card">
                    <div class="card-header">
                        INICIAR SECCION
                    </div>
                    <div class="card-body">



                    <?php  if (isset ($mensaje)){?>
                     <div class="alert alert-danger" role="alert">
                     <strong>danger</strong>
                     <?php  echo $mensaje; }?>
                     </div>
                    




                        <form method="post">

                        <div class = "form-group">
                        <label for="exampleInputEmail1">usuario</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"name="usuario" aria-describedby="emailHelp" placeholder="ingrese usuario">
                        <small id="emailHelp" class="form-text text-muted">
                        </div>
                        
                        <div class="form-group">
                        <label for="exampleInputPassword1">contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"name="contraseña" placeholder="ingrese contraseña">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">ingresar al administrador</button>
                        
                        </form>
                        
                        
                    </div>
                    
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</body>
   </html>