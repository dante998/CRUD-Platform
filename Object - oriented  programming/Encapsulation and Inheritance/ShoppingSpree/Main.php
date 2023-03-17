<?php
require_once "Person.php";
require_once "Product.php";

$personsData = array_filter(preg_split("/[=;]/", readline(), -1, PREG_SPLIT_NO_EMPTY));

$people = [];

for ($i = 0; $i < count($personsData) - 1; $i += 2) {
  $personName = $personsData[$i];
  $personMoney = floatval($personsData[$i + 1]);

  try {
    $people[$personName] = new Person($personName, $personMoney);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

$productsData = array_filter(preg_split("/[=;]/", readline(), -1, PREG_SPLIT_NO_EMPTY));

$products = [];

for ($i = 0; $i < count($productsData) - 1; $i += 2) {
  $productName = $productsData[$i];
  $productCost = $productsData[$i + 1];

  $products[$productName] = new Product($productName, $productCost);
}

$input = readline();


while ($input !== "END") {
  $data = explode(" ", $input);

  $personName = $data[0];
  $productName = $data[1];


  if (array_key_exists($personName, $people) && array_key_exists($productName, $products)) {
    $people[$personName]->buyProduct($products[$productName]);

    /** @var \Person $person */
    $person = $people[$personName];

    try {
      $person->buyProduct($products[$productName]);
    } catch (Exception $ex) {
      echo $ex->getMessage();
    }
  }

  $input = readline();
}


//$personsData = array_filter($personsData, function ($element){
//return $element !== "";
//});


//Pesho=11;Gosho=4;
//Bread=10;Milk=2;
//Pesho Bread
//Gosho Milk
//Gosho Milk
//Pesho Milk
//END