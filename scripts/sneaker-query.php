<?php 
    include("../connection.php");

    $query = "SELECT * from stock
    INNER JOIN sneaker
    ON stock.sneaker_id = sneaker.sneaker_id
    WHERE stock.deleted_at IS NULL";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die('Query Error' . mysqli_error($connection));
    }
    
    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'imagen_url' => $row['imagen_url'],
            'sneaker_id' => $row["sneaker_id"],
            'sneaker_name' => $row['sneaker_name'],
            'brand_name' => $row['brand_name'],
            'size_number' => $row['size_number'],
            'price'=> $row['price'],
            'stock_quantity'=> $row['stock_quantity'],
            'id_stock'=> $row['id_stock']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>