<?php
//fetch.php
    require_once "../../_config/config.php";
    $request = mysqli_real_escape_string($con, $_POST["query"]);
    $query = "
        SELECT * FROM barang WHERE nama_barang LIKE '%".$request."%'
    ";

    $result = mysqli_query($con, $query);

    $data = array();

    if(mysqli_num_rows($result) > 0)
    {
    while($row = mysqli_fetch_assoc($result))
    {
        $data[] = $row["nama_barang"];
    }
    echo json_encode($data);
    }

?>
