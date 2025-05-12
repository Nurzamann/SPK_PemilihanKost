<?php

$kode=$_GET['code_alternatif'];

$sql = "DELETE FROM alternatif_kost WHERE code_alternatif='$kode'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=kost");
}
$conn->close();
?>