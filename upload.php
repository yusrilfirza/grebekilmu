<?php
require_once("koneksi.php");

   if(isset($_FILES['file'])){
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size = $_FILES['file']['size'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $file_type = $_FILES['file']['type'];
      $keterangan= filter_input(INPUT_POST,'deskripsi',FILTER_SANITIZE_STRING);
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
      
      $expensions= array("doc","docx","pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Format file salah. Upload file doc, docx, atau pdf";
         $ket= "Format file salah. Upload file doc, docx, atau pdf";
      }
      
      if($file_size > 2097152) {
         $errors[]='Ukuran terlalu besar. (max 2 mb)';
         $ket= "Ukuran terlalu besar. (Max 2mb)";
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"file/".$file_name);
         $status="Success";
         $sql = "INSERT INTO upload (file_name, keterangan) 
            VALUES (0, :nama, :keterangan)";
         $stmt = $db->prepare($sql);

        $params = array(
        ":nama" => $file_name,
        ":keterangan" => $keterangan,
        );

        $saved = $stmt->execute($params);

      }else{
         $status= $ket;
      }
   }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md fixed-top visible" data-aos="flip-up" data-aos-delay="900" style="background-color:#72aeda;color:rgb(205,207,208);">
        <div class="container-fluid"><a class="navbar-brand" href="#" style="color:#ffffff;">Grebek<strong>Ilmu</strong></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse justify-content-end" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="kontak.html" style="color:#ffffff;"></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="beranda_admin.html" style="color:rgba(255,255,255,0.9);">Beranda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="user_admin.html" style="color:#ffffff;">User</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="upload.html" style="color:#ffffff;">Soal</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="buku_admin.html" style="color:#ffffff;">Buku</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:#ffffff;">Persetujuan</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#"><button class="btn btn-primary" type="button">Keluar</button></a></li>
                </ul>
        </div>
        </div>
    </nav>
    <h1 class="text-center" style="padding:96px;"></h1>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" enctype="multipart/form-data">
                        <h1>Upload Soal</h1><input class="form-control" type="text" placeholder="Deskripsi" name="deskripsi"><input type="file" style="padding:0px;" name="file">
                        <button class="btn btn-primary" type="submit" name="submit">Upload</button></form>
                        <a>
                        <li>Status : <?php echo $status; ?> </li>
                        <li>File Terkirim: <?php echo $_FILES['file']['name'];  ?> </li>
                        <li>Ukuran File: <?php echo $_FILES['file']['size'];  ?> </li>
                        </a>
                </div>
                <div class="col-md-6">
                    <p style="font-size:24px;"><br>"Education is the most powerful weapon which you can use to change the world."<br></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="text-center">File Terupload</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama File</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cell 1</td>
                        <td>Cell 2</td>
                        <td><button class="btn btn-primary" type="button">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>