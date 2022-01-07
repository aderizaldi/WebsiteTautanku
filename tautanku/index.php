<?php 
require "fungsi.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon270501.ico">
    <title>TAUTANKU</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body{
            font-family: 'Quicksand',sans-serif;
            width: 100%;
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
        .contents{
            background-color: #FFFFFF;
            height: 1000px;
            overflow: hidden;
            width: 100%;
            background-image: url('img/pattern270501.png');
            user-select: none;
        }
        .contents2{
            background-color: #FFFFFF;
            height: 1250px;
            overflow: hidden;
            width: 100%;
            background-image: url('img/pattern270501.png');
            user-select: none;
        }
        .teks{
            width: 200px;
            text-align: center;
            font-size: 50px;
            margin: auto;
            margin-top: 50px;
        }
        .contents .container-banner {
            width: 100%;
            height: 300px;
            background-color: #063A5B;
        }
        .contents .banner{
            position: relative;
            width: 100%;
            height: 300px;
        }
        .contents .banner:before{
            content: ' ';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-image: url('img/banner270501.jpg');
            background-repeat: no-repeat;
            background-position: 0px -350px;
            opacity: 0.3;
        }
        .contents .banner .teks{
            position: relative;
            width: 100%;
            margin: 0px;
            color: white;
        }  
        .contents .banner .teks h5{
            padding: 20px 0px 0px 20px;
            font-size: 64px;
            width: 50%;
            text-align: left;
            user-select: none;
        }
        .contents .banner .teks p{
            padding: 10px 0px 0px 25px;
            font-size: 16px;
            width: 30%;
            text-align: justify;
            user-select: none;
        }
        .contents .isikonten{
            color: #063A5B;
            width: 60%;
            height: 70  0px;
            margin: 50px auto;
        }
        .isikonten h5{
            font-size: 32px;
            text-align: center;
        }
        .isikonten p{
            font-size: 16px;
            text-align: center;
            letter-spacing: 2px;
        }
        .kalimat1, .kalimat2, .kalimat3{
            padding: 50px;
        }
        .kalimat3 a{
            color: blue;
            text-decoration: none;
        }
        .footer{
            color: white;
            background-color: #063A5B;
            width: 100%;
            height: 225px;
            border-top: 5px solid #FF7A8B;
        }
        .kontak{
            padding: 20px;
            float: left;
            height: 150px;
            width: calc(30% - 40px);
            user-select: none;
        }
        .kontak a{
            color: #FF7A8B;
        }
        .comment{
            padding: 20px;
            float: left;
            width: calc(70% - 40px);          
            height: 150px;
            user-select: none;
        }
        .comment .kirim{
            display: block;
        }
        .comment .isi{
            float: left;
        }
        .comment .email{
            float: left;
            margin-left: 20px;
        }
        .comment .kirim{
            float: left;
            margin-left: 20px;
        }
        .comment input{
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid #848484;
            outline:0;
            height:25px;
            width: 250px;
            padding: 5px;
        }
        .comment textarea{
            resize: none;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 1px solid #848484;
            outline:0;
            padding: 5px;
        }
        .copyright{
            height: 25px;
            text-align: center;
            margin-left: auto;
            opacity: 0.25;
            float: left;
            width: 100%;
            user-select: none;
        }
        .comment button{
            background-color: #FF7A8B;
            border-radius: 8px;
            border-style: none;
            color: #FFFFFF;
            cursor: pointer;
            height: 36px;
            width: 75px;
            line-height: 20px;
            list-style: none;
            margin: 0;
            outline: none;
            padding: 10px 16px;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: color 100ms;
            vertical-align: baseline;
            user-select: none;
        }
        .comment button:hover,
        .comment button:focus {
            background-color: #F082AC;
        }
        .table{
            width: 60%;
            min-height: 100px ;
            overflow: hidden;
            margin: 50px auto;
        }
        .table table{
            color: white;
            width: 100%;
            border-spacing: 20px;
        }
        .table table .about{
            display: flex;
            justify-content: center;
            flex-direction: column;
            margin: auto;
            width: 100%;
            height: 100%;
            background-color: #063A5B;
            border-radius: 20px;
        }
        .table table .about h5{
            font-size: 20px;
            width: 80%;
            margin: 5px auto;
            text-align: center;
        }
        .table table .about p{
            margin: 5px auto;
            width: 80%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <nav>
            <h3>TAUTANKU</h3>
            <ul>
                <form action="" method="get">
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="index.php?about">ABOUT</a></li>           
                    <li><a href="index.php">HOME</a></li>       
                </form>                       
            </ul>
        </nav>
    </div>
    <?php if(isset($_GET["about"])){ ?>
    <div class="contents2">
        <div class="table">
            <table>
                <tr>
                    <td style="width: 50%; height: 250px;"><div class="about"><h5>LOGIN</h5><p>"Masuk ke dalam akun TAUTANKU untuk mengatur profil"</p></div></td>
                    <td style="width: 50%; height: 250px;"><div class="about"><h5>ABOUT</h5><p>"Tentang apa saja yang ada di website ini"</p></div></td>
                </tr>
                <tr>
                    <td style="width: 50%; height: 150px;"><div class="about"><h5>REGISTER</h5><p>"Mendaftar akun TAUTANKU agar bisa login"</p></div></td>
                    <td rowspan="2" style="width: 50%; height: 150px;"><div class="about"><h5>SARAN</h5><p>"Memberikan saran ataupun pertanyaan kepada pembuat website TAUTANKU"</p></div></td>
                </tr>
                <tr>
                    <td style="width: 50%; height: 150px;"><div class="about"><h5>HOME</h5><p>"Halaman utama website TAUTANKU"</p></div></td>                   
                </tr>
                <tr>
                    <td colspan="2" style="width: 100%; height: 125px;"><div class="about"><h5>KONTAK</h5><p>Kontak pembuat website TAUTANKU agar bisa dihubung secara langsung"</p></div></td>
                </tr>
                <tr>
                    <td rowspan="3" style="width: 50%; height: 300px;"><div class="about"><h5>GANTI PROFILE</h5><p>"Mengganti foto profil akun TAUTANKU menjadi foto yang diinginkan"</p></div></td>
                    <td style="width: 50%; height: 100px;"><div class="about"><h5>TAMBAH</h5><p>"Menambah link profil TAUTANKU"</p></div></td>
                </tr>
                <tr>
                    <td style="width: 50%; height: 100px;"><div class="about"><h5>UBAH</h5><p>"Mengubah link profil TAUTANKU"</p></div></td>
                </tr>
                <tr>
                    <td style="width: 50%; height: 100px;"><div class="about"><h5>HAPUS</h5><p>"Menghapus link profil TAUTANKU"</p></div></td>
                </tr>

            </table>
        </div>
    </div>
    <?php } else { ?>
    <div class="contents">
        <div class="container-banner">
            <div class="banner">
                <div class="teks">
                    <h5>BAGIKAN AKUN SOSMEDMU</h5>
                    <p>Hanya dengan satu link kamu dapat membagikan semua akun sosial media yang kamu punya</p>
                </div>
            </div>
            <div class="isikonten">
                <div class="kalimat1">
                    <h5>Easy to Use</h5>
                    <p>Kamu hanya perlu memasukkan link profile media sosial kamu lalu tekan "Tambah" dan profil TAUTAN kamu siap untuk dibagikan. Kamu juga dapat dengan mudah mengubah ataupun menghapus link yang sudah kamu tambahkan sebelumnya, kamu hanya perlu menekan tombol "Ubah" untuk mengubah dan "Hapus" untuk menghapus.</p>
                </div>
                <div class="kalimat2">
                    <h5>Share Your Link</h5>
                    <p>Persiapkan akun TAUTAN kamu lalu bagikan ke orang sekitar kamu. Dengan satu link, orang disekitar anda dapat mengetahui semua profil sosial media kamu.</p>
                </div>
                <div class="kalimat3">
                    <h5>Sign up Now</h5>
                    <p>Jangan sampai ketinggalan, coba sekarang juga. Buat akun TAUTAN anda sekarang dengan menekan tombol <a href="login.php?signup">sign up</a>.</p>
                </div>
            </div>
        </div> 
    </div>
    <?php } ?>
    <div class="footer" border>     
        <div class="comment">
            <?php 
            if(isset($_POST["kirim"])){ ?>
                Terima kasih <b><?php echo $_POST["email"]; ?></b><br> 
                Saran anda telah terkirim! 
                <?php komen($_POST); ?>
            <?php } 
            else{ ?>
                <h4>Berikan Saran</h4><br>
                <form action="" method="post">
                    <div class="isi">
                        <p>Comment: </p>
                        <textarea name="saran" id="saran" cols="65" rows="5"></textarea>
                    </div>
                    <div class="email">
                        <p>Email: </p>
                        <input type="email" name="email" placeholder="abcd@example.com" required>
                    </div> 
                    <div class="kirim">
                        <br><button type="submit" name="kirim">Kirim</button>   
                    </div>
                </form>
            <?php } ?>
        </div>

        <div class="kontak">
            <h4>Kontak</h4><br>
             <p>Email:</p>
             <a href="mailto:ade.rizaldi@student.untan.ac.id">ade.rizaldi@student.untan.ac.id</a>
             <br><br><p>Nomor telepon:</p>
             <a href="tel:+62-896-6556-5388">+62-896-6556-5388</a>
        </div>
        <div class="copyright"><footer><small>&copy; Copyright 2021, Ade Rizaldi</small></footer></div>
    </div>
</body>
</html>