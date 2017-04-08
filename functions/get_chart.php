<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

extract($_POST);
require_once('get_products.php');
require_once('database.php');

function get_cart_total(){
  $totaal = 0;
  // Controleer of de cart gevuld is
  if(isset($_SESSION['cart'])){
  if(is_array($_SESSION['cart'])){
    foreach($_SESSION['cart'] AS $id => $amount){
      //echo "ID: $id aantal: $amount <br />";
      $totaal += (getPrice($id)[0]['prijs'] * $amount);
    }
  }
}
  echo convertPrice($totaal);
}

function get_total(){
  // Controleer of de cart gevuld is
  if(isset($_SESSION['cart'])){
  if(is_array($_SESSION['cart'])){
    foreach($_SESSION['cart'] AS $id => $amount){
        // Haal hier de data op:
        // 1. Pizza Bolognese Small   1x    16,95   16,95   + - X
        // 2. Pizza Bolognese Small   1x    16,95   16,95   + - X
        // 3. Pizza Bolognese Small   1x    16,95   16,95   + - X
        // 4. Totaal:                 3x            41,95
        echo "Mandindhoud";
    }

  }else{
    echo "De winlelmand bevat nog geen items.";
  }
}else{
  echo "De winkelmand bevat nog geen items.";
}
}

function getNrInChart($id){
  // Controleer of de cart gevuld is [id] => aantal
  if(isset($_SESSION['cart'])){
    if(is_array($_SESSION['cart'])){
      if(isset($_SESSION['cart'][$id])){
        return $_SESSION['cart'][$id];
      }else{
        return 0;
      }
    }else{
      return 0;
    }
  }else{
    return 0;
  }
}
// Er kan gevraagd worden om totaal bedrag van het mandje (action = getTotal)
// Er kan gevraagd worden om alle order regels (getCart)
if(isset($action)){
  if($action == "getTotal"){
    get_cart_total();
  }
  if($action == "getCart"){
    get_cart_detail();
  }
}
?>
