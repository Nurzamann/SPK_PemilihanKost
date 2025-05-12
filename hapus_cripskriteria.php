<?php

$id=$_GET['id'];

$sql = "DELETE FROM crips_kriteria WHERE idkriteria='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=cripskriteria");
}
$conn->close();
?>