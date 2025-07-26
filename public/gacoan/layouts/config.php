<?php 
$koneksi = mysqli_connect("localhost","root","4kud4t4base","employees");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>