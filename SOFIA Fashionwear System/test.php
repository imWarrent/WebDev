<?php
  require('./config.php');
  //for cart count
  $offset = 0;
  $query = "SELECT * FROM product_data LIMIT 2 OFFSET $offset";
  $sql = mysqli_query($sqlcon,$query);
  while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
    $id = $row['product_id']; $name = $row['product_name'];
    echo "<p>$id | $name</p>";

    $offset++;
  }

  $query1 = "SELECT count(*) as 'total' FROM product_data";
  $sql1 = mysqli_query($sqlcon,$query1);
  $rows = mysqli_fetch_array($sql1, MYSQLI_ASSOC);
  $total = $rows['total'];

  $temppages = $total / 2;
  $pages = floor($temppages);

  if(floor($temppages) != $temppages){
    $pages++;
  }

  echo ($pages);
?>