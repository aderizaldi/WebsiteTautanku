<?php 
require "fungsi.php";
session_start();
$kon = false;
$kon1 = false;
$foto = "default270501.jpg";


//logout
if(isset($_GET["logout"])){
	$_SESSION = [];
	session_unset();
	session_destroy();
	header("Location: login.php");
	exit();
}

//cek session dan link yang dimasukkan
if(!isset($_SESSION["login"]) and !isset($_GET["user"])){
	header("Location: login.php");
	exit();
}
else if(!isset($_SESSION["login"]) and isset($_GET["user"])){
	$user = $_GET["user"];
	$link = query("SELECT * FROM link WHERE username = '$user'");
	$result = mysqli_query($db,"SELECT * FROM user WHERE username = '$user'");
	if(mysqli_num_rows($result) === 1){
		$datauser = mysqli_fetch_assoc($result);
		$foto = $datauser["foto"];
	}
	$kon = true;
}
else if(isset($_SESSION["login"]) and !isset($_GET["user"])){
		$identified = $_SESSION["user"];
		header("Location: profile.php?user=$identified");
		exit();
}
else if(isset($_SESSION["login"]) and isset($_GET["user"])){
	if($_SESSION["username"] == $_GET["user"]){
		$kon1 = true;
	}	
	if($_GET["user"]==""){
		header("Location: login.php");
		exit();
	}
	$user = $_GET["user"];
	$link = query("SELECT * FROM link WHERE username = '$user'");
	$result = mysqli_query($db,"SELECT * FROM user WHERE username = '$user'");
	if(mysqli_num_rows($result) === 1){
		$datauser = mysqli_fetch_assoc($result);
		$foto = $datauser["foto"];
	}
}

//tambah link
if(isset($_POST["tambah"])){
	$_POST["user"] = $_SESSION["username"];
	if(tambah($_POST) > 0){
		header("Location: profile.php");
		exit();
	}	
}

//hapus link
if(isset($_GET["hapus"])){
	hapus($_GET);
	header("Location: profile.php");
	exit();
}

//batal saat ingin ubah link
if(isset($_POST["batal"])){
	header("Location: profile.php");
	exit();
}

//ubah link
if(isset($_POST["okubah"])){
	$_POST["id"] = $_GET["id"];;
	if(ubah($_POST) > 0){
		header("Location: profile.php");
		exit();
	}	
}

//ganti foto
if (isset($_POST["simpan"])) {
	if (gantiProfile($_GET)) {
		echo "<script> alert('Berhasil mengganti foto profil') </script>";
		header("Location: profile.php");
		exit();
	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img/favicon270501.ico">
	<title>TAUTANKU - <?= $_GET["user"] ?></title>
	<style>
		 *{
            padding: 0;
            margin: 0;
        }
        body{
            font-family: 'Quicksand',sans-serif;
            width: 100%;
            background-image: url('img/pattern270501.png');  
        }
        .header{
            color: white;
            background-color: #FF7A8B;
            height: 70px;
            border-bottom: 5px solid #063A5B;
        }
        nav ul li{
            list-style: none;
            float: right;
        }
        nav ul li a:hover {
            background-color: #063A5B;
        }
        li a {
            font-size: 16px;
            display: inline-block;
            color: white;
            text-align: center;
            padding: 25px 20px 30px 20px;
            text-decoration: none;
            user-select: none;
        }
        h3{
            margin: 20px;
            float: left;
            user-select: none;
        }
        .container{
        	width: 100%;
        	min-height: 600px;
        	overflow: hidden;
        }
        .left{
        	color: white;
        	width: 30%;
        	height: 45%;
        	position: absolute;
        	float: left;
        	user-select: none;
        }
        .right{
        	color: white;
        	width: 70%;
        	float: right;
        	margin-top: 0;
        	user-select: none;
        }
        .center{
        	width: 100%;
        	color: white;
        	user-select: none;
        }
        .tambahubah{
        	border-radius: 20px;
        	background-color: #063A5B;
        	width: 80%;
        	height: 100%;
        	margin-top: 10%;
        	margin-left: 10%;
        }
        .tambahubah ul li{
        	list-style: none;
        }
        .formtambahubah{
        	margin: auto;
        	width: 80%;
        }
        .formtambahubah h5{
        	widows:100%;
        	text-align: center;
        	font-size: 20px;
        	padding-top: 20px;
        	padding-bottom: 20px;
        }
        .formtambahubah input{
        	border-radius: 5px;
            border: 1px solid #063A5B;
            outline: 0px;
            height: 25px;
            width: calc(100% - 12px);
            padding: 5px;
        }
        .tombol{
        	width: 100%;
        	margin: auto;
        	display: flex;
			justify-content: center;
			align-items: center;
        }
        .formtambahubah button{
        	background-color: #FF7A8B;
            border-radius: 8px;
            border-style: none;
            color: #FFFFFF;
            cursor: pointer;
            height: 40px;
            width: 100px;
            margin: 20px 10px;
            outline: none;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            padding: 10px;
        }
        .formtambahubah button:hover,
        .formtambahubah button:focus {
            background-color: #F082AC;
        }
        .right-container{
        	margin: auto;
        	margin-top: 40px;
        	width: 80%;
        	background-color: #063A5B;
        	min-height: 200px;
        	border-radius: 20px;

        }
        .foto{
        	margin: auto;
        	padding-top: 50px;
        	margin-bottom: 50px;
        	height: 150px;
        	width: 150px;
        	border-radius: 16px;
        }
        .foto img{
        	display: block;
        	margin: auto;
    		max-height: 100%;
    		max-width: 100%;
    		border-radius: 15px;
        }
        .ganti-foto{
        	display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
        	margin: auto;
        	margin-top: -30px;
        	margin-bottom: 30px; 	
        }
        .nama{
        	width: 100%;
        	margin-bottom: 20px;
        }
        .nama h5{
        	text-align: center;
        	font-size: 24px;
        }
        .ok{
        	float: right;
        	margin: 10px;

        }
        .ok button{
        	background-color: #FF7A8B;
            border-radius: 8px;
            border-style: none;
            color: #FFFFFF;
            cursor: pointer;
            outline: none;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            height: 40px;
            width: 70px;
        }
        .ok button:hover,
        .ok button:focus {
            background-color: #F082AC;
        }
        .inputfile{
        	position: relative;
        	float: left;
        	margin: 10px;
        }
        .inputfile input {
			position: relative;
			height: 40px;
			width: 200px;
			border-radius: 8px;
		}

		.inputfile input:before {
			background: #FF7A8B;
			content: 'Upload File...';
			color: white;
			font-weight: bold;
		 	display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
		}

		.inputfile input:invalid:before { content: 'Ganti foto profil'; }
		.inputfile input:valid:before { content: 'Foto telah diupload'; background: #2fd148; }
		.link{
			width: 80%;
			margin: auto;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.link table{
			width: 100%;
		}
		.link .linkbutton{
			width: 70%;
			text-align: center;
		}
		.link .linkedit{
			width: 30%;
			text-align: center;
		}
		.link .fulllink{
			width: 100%;
			text-align: center;
		}
		.link button{
			background-color: #FF7A8B;
            border-radius: 8px;
            border-style: none;
            color: #FFFFFF;
            cursor: pointer;
            outline: none;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
            height: 40px;
            width: 90%;
            margin: 10px;
		}
		.link button:hover,
        .link button:focus {
            background-color: #F082AC;
        }
        .linkedit a{
        	margin: auto;
        	background-color: #FF7A8B;
        	border-radius: 8px;
        	padding: 5px;
        	text-decoration: none;
        }
        .kosong{
        	height: 50px;
        	width: 100%;
        }
        .bodykosong{
        	height: 50px;
        	width: 100%;
        }
        .center{
        	width: 70%;
        	margin: auto;
        	margin-top: 40px;
        	background-color: #063A5B;
        	border-radius: 20px;
        }
        .link .icon{
        	display: inline-block;
        	float: left;
        	height: 20px;
        	width: 20px;
        	margin: 8px;
        	margin-left: 20px;
        }
        .link p{
        	font-size: 16px;
        	text-align: center;
        	margin: 8px auto;
        	width: 50%;
        }
	</style>
</head>
<body>
	<div class="container">
		<div class="header">
	        <nav>
	            <h3>TAUTANKU</h3>
	            <ul>
	                <form action="" method="get">
	                    <?php if($kon) {?><li><a href="login.php">LOGIN</a></li>
	                	<?php } else{ ?><li><a href="profile.php?logout">LOGOUT</a></li>
	                	<?php } ?>
	                    <li><a href="index.php?about">ABOUT</a></li>  
	                    <li><a href="index.php">HOME</a></li>
	                    <?php if(isset($_SESSION["login"])) {
	                    	$identified = $_SESSION["username"];
	                    ?><li><a href="profile.php?user=<?=$identified?>">PROFILE</a></li>
	                	<?php } ?>
	                </form>                       
	            </ul>
	        </nav>
	    </div>
	    <?php if($kon1) { 
	    	$identified = $_SESSION["username"]; ?>
		<div class="left">
			<?php if(isset($_GET["ubah"])){ 
				$id = $_GET["id"];
				$datalink = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM link WHERE id='$id'"));
				$link_url = $datalink["link_url"];
				$nama_url = $datalink["nama_url"];
			?>
			<div class="tambahubah">
				<div class="formtambahubah">
					<h5>Ubah Sosial Media</h5>
					<form action="" method="post">
					<ul>
		                <li>
		                    <label for="nama_url">Nama Web :</label><br>
		                    <input type="text" name="nama_url" id="nama_url" value="<?php echo"$nama_url"; ?>" required>
		                </li>
		                <li>
		                    <label for="link_url">Link :</label><br>
		                    <input type="text" name="link_url" id="link_url"  value="<?php echo"$link_url"; ?>" required>
		                </li>
		            </ul>
		            <div class="tombol">
		            <button type="submit" name="okubah">Ubah</button>
		            <button type="submit" name="batal">Batal</button>
		            </div>
					</form>
				</div>
			</div>
			<?php }else{ ?>
			<div class="tambahubah">
				<div class="formtambahubah">
					<h5>Tambah Sosial Media</h5>
					<form action="" method="post">
					<ul>
		                <li>
		                    <label for="nama_url">Nama Web :</label><br>
		                    <input type="text" name="nama_url" id="nama_url" required>
		                </li>
		                <li>
		                    <label for="link_url">Link :</label><br>
		                    <input type="text" name="link_url" id="link_url" required>
		                </li>
		            </ul>
		            <div class="tombol"><button type="submit" name="tambah">Tambah</button></div>
					</form>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="right">
			<div class="right-container">
				<div class="foto">
					<img src="img/<?= $foto ?>" alt="">
				</div>
				<div class="ganti-foto">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="inputfile"><input type="file" name="ganti" id="ganti" required></div>
						<div class="ok"><button type="submit" name="simpan">Simpan</button></div>
				</div>
				<div class="nama">
					<h5> <?= $_GET["user"]?> </h5>
				</div>
				<div class="link">
					<table>	
						<?php foreach ($link as $l) { 
							$url = $l["link_url"];
							$url_info = parse_url($url);?>
						<tr>
							<td class="linkbutton">
								<button onclick="window.open('<?= $l["link_url"] ?>','_blank')"><div class="icon"><img src="http://www.google.com/s2/favicons?domain=<?=$url_info['host']?>" alt="" style="height: 20px;"></div><p><?= $l["nama_url"] ?></p></button>
							</td>
							<td class="linkedit">
								<a href="profile.php?ubah&id=<?= $l["id"] ?>&user=<?= $identified ?>"><span style="color:white">Ubah</span></a> | 
								<a href="profile.php?hapus&id=<?= $l["id"] ?>&user=<?= $identified ?>"><span style="color:red">Hapus</span></a> 
							</td>
						</tr>	
						<?php } ?>
					</table>	
				</div>
				<div class="kosong">
					
				</div>
			</div>
		</div>
		<?php } else {?>
		<div class="center">
			<div class="foto">	
				<img src="img/<?= $foto ?>" alt="">
			</div>
			<div class="nama">
				<h5> <?= $_GET["user"]?> </h5>
			</div>
			<div class="link">
				<table>	
					<?php foreach ($link as $l) { 
						$url = $l["link_url"];
						$url_info = parse_url($url);?>
					<tr>
						<td class="fulllink">
							<button onclick="window.open('<?= $l["link_url"] ?>','_blank')"><div class="icon"><img src="http://www.google.com/s2/favicons?domain=<?=$url_info['host']?>" alt="" style="height: 20px;"></div><p><?= $l["nama_url"] ?></p></button>
						</td>
					</tr>	
					<?php } ?>
				</table>	
			</div>
			<div class="kosong">
					
			</div>
		</div>
	</div>
		<?php } ?>
	</div>
	<div class="bodykosong">
				
	</div>
</body>
</html>