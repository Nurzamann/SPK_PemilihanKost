<?php

$id=$_GET['id'];

$sql = "DELETE FROM penilaian WHERE idpenilaian='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=penilaian");
}
$conn->close();
?>