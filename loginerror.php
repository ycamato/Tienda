<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>ERROR DE LOGIN</title>
</head>
<body>
    <div class="imagen">
    <img class="imagen" src="../imag/Supertienda.png">
    </div>
    <form method="POST" name="form1" action="../include/pruebalogin.php" autocomplete="off">
    <div class="login">
    <img class="imag" src="../imag/logo1.png">
    </div>
    <h3>ERROR DE  LOGIN</h3>
    <h2>Accede  aqui</h2><br>
    <label class="for"> Ingrese  su  documento:</label><br>
    <input type="text" class="input" name="doc" id="doc" placeholder=" Ingrese su documento" required=""><br><br>
    <label class="for"> Digite  su  clave:</label><br>
    <input type="password" class="input" name="clave" id="clave" placeholder=" Ingrese su clave" required=""><br>

    <input class="submit" type="submit" value="envia" name="envia">
    <input type="hidden" value="formreg" name="MM_insert">
    <button class="btn"><a href="../index.php">Regresar</a></button>
</form>
</body>
</html>