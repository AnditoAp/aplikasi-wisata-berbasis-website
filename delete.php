<?php
include 'configdata.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idwisata = $_POST['idwisata'];

    $sql = "DELETE FROM wisata WHERE idwisata=$idwisata";

    if ($conn->query($sql)) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
