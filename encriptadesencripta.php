<?php
  // MD5 es de una sola via, es decir solo se puede encriptar pero no desencriptar,
  // para comparar es necesario encriptar con md5 la cadena a comparar y comparar las dos cadenas md5

  // Password que puede ingresar un usuario
  $password = "password1234";

  // Encriptando el password para guardarlo en la base de datos
  $hash = md5($password);

  echo $password .'<br />';

  echo $hash .'<br />';

  // Password que puede insgresar un usuario para iniciar sesión
  $passwordIngresado = "password1234";

  // Password encriptado guardado en la base de datos
  $passwordEnBaseDeDatos = "bdc87b9c894da5168059e00ebffb9077";

  // Encriptando el password ingresado
  $hash = md5($passwordIngresado);

  // Verificando si coinciden los password
  if($hash == $passwordEnBaseDeDatos){
    echo "El password coincide.";
  }else{
    echo "El password no coincide.";
  }
?>
