<?php  

$db = mysqli_connect("localhost","root","","tautanku");

function query($query){
	global $db;
	$result = mysqli_query($db, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
}

function registrasi($data){
	global $db;
	$email = $data["email"];
	$user = $data["username"];
	$password = mysqli_real_escape_string($db, $data["password"]);
	$password2 = mysqli_real_escape_string($db, $data["password2"]);

	$result = mysqli_query($db, "SELECT email FROM user WHERE email = '$email'");
	$result2 = mysqli_query($db, "SELECT username FROM user WHERE username = '$user'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script> alert('Email sudah terdaftar!');</script>";
		return false;
	}

	if (mysqli_fetch_assoc($result2)) {
		echo "<script> alert('Username sudah terdaftar!');</script>";
		return false;
	}

	if (!preg_match('/^[a-z0-9]{3,16}$/', $user)) {
        echo "<script> alert('Username tidak dapat digunakan!\\nUsername hanya bisa berisi huruf dan angka (3-16 karakter)');</script>";
        return false;
    }

	if($password !== $password2){
		echo "<script> alert('Konfirmasi password tidak sesuai!'); </script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO user VALUES('$user', '$email', '$password','default270501.jpg')";
	mysqli_query($db, $query);
	return mysqli_affected_rows($db);
}

function tambah($data){
	global $db;
	$user = $data["user"];
	$nama = $data["nama_url"];
	$link = $data["link_url"];

	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
       echo "<script> alert('Link yang dimasukkan salah!'); </script>";
       return false;
	}

	$query = "INSERT INTO link VALUES('','$user','$nama', '$link')";
	mysqli_query($db, $query);

	return mysqli_affected_rows($db);
}

function hapus($data)
{
	global $db;
	$id = $data["id"];

	$query = "DELETE FROM link WHERE id = '$id'";
	mysqli_query($db, $query);
}

function ubah($data){
	global $db;
	$id = $data["id"];
	$link_url = $data["link_url"];
	$nama_url = $data["nama_url"];

	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link_url)) {
       echo "<script> alert('Link yang dimasukkan salah!'); </script>";
       return false;
	}

	$query = "UPDATE link SET link_url = '$link_url', nama_url = '$nama_url' WHERE id = '$id'";
	mysqli_query($db, $query);	
	return mysqli_affected_rows($db);
}

function komen($data){
	global $db;
	$email = $data["email"];
	$komen = $data["saran"];

	$query = "INSERT INTO saran VALUES('$email','$komen')";
	mysqli_query($db, $query);
}

function gantiProfile($data){
	global $db;
	$namafile = $_FILES["ganti"]["name"];
	$ukuranfile = $_FILES["ganti"]["size"];
	$error = $_FILES["ganti"]["error"];
	$tmpname = $_FILES["ganti"]["tmp_name"];

	$ekstensivalid = ["jpg","jpeg","png"];
	$ekstensi = explode(".", $namafile);
	$ekstensi = strtolower(end($ekstensi));

	if($error === 4){
		echo "<script> alert('Pilih gambar jika ingin mengganti foto profil!') </script>";
		return false;
	}
	if (!in_array($ekstensi, $ekstensivalid)) {
		echo "<script> alert('Silahkan upload file gambar!') </script>";
		return false;
	}
	if ($ukuranfile > 3000000) {
		echo "<script> alert('Ukuran file maksimal 3Mb!!') </script>";
		return false;
	}

	$namafilebaru = uniqid();
	$namafilebaru .= ".";
	$namafilebaru .= $ekstensi;

	move_uploaded_file($tmpname, "img/" . $namafilebaru);

	$user = $data["user"];
	$query = "UPDATE user SET foto = '$namafilebaru' WHERE username = '$user'";
	mysqli_query($db, $query);
	return mysqli_affected_rows($db);
}
?>
