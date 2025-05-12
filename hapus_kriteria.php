<?php

$kode=$_GET['kode_kriteria'];

$sql = "DELETE FROM kriteria WHERE kode_kriteria='$kode'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=kriteria");
}
$conn->close();
?>