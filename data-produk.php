<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login"</script>';
    }
    $kontak = mysqli_query($conn, "SELECT telp_admin, email_admin, address_admin FROM tb_admin WHERE id_admin = 1");
    $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            HANTU THRIFT
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
    </head>
    <body>
       <!--header-->
       <header>
           <div class="container">
                <h1><a href="dashboard">HANTU THRIFT</a></h1>
                <ul>
                    <li><a href="dashboard">Dashboard</a></li>
                    <li><a href="profile">Profile</a></li>
                    <li><a href="data-kategori">Data Kategori</a></li>
                    <li><a href="data-produk">Data Produk</a></li>
                    <li><a href="keluar">Keluar</a></li>
                </ul>
           </div>
       </header>

       <!-- Content -->
       <div class="section">
           <div class="container">
               <h3>Data Produk</h3>
               <div class="box">
                   <p><a href="tambah-produk">Tambah Data</a></p>
                   <table border="1" cellspacing="0" class="table">
                       <thead>
                           <tr>
                               <th width="60px">No</th>
                               <th>Kategori</th>
                               <th>Nama Produk</th>
                               <th>Harga</th>
                               <th>Gambar</th>
                               <th>Status</th>
                               <th width="150px">Aksi</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                           $no = 1;
                           $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (id_category) ORDER BY id_product DESC");
                           if(mysqli_num_rows($produk) > 0){
                           
                           while($row = mysqli_fetch_Array($produk)){
                           ?>
                           <tr>
                               <td><?php echo $no++ ?></td>
                               <td><?php echo $row['name_category'] ?></td>
                               <td><?php echo $row['name_product'] ?></td>
                               <td>Rp. <?php echo number_format($row['price_product']) ?></td>     
                               <td><a href="produkk/<?php echo $row['image_product'] ?>" target="_blank"><img src="produkk/<?php echo $row['image_product'] ?>" width="50px"></a></td>
                               <td><?php echo ($row['status_product'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                               <td>
                                   <a href="edit-produk?id=<?php echo $row['id_product']?>">Edit</a> || <a href="hapus-kategori?idp=<?php echo $row['id_product'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                               </td>
                           </tr>
                           <?php }} else{ ?>

                            <tr>
                                <td colspan="7">Tidak Ada Data</td>
                            </tr>

                            <?php } ?>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
 
       <!-- Footer -->
       <div class="footer">
            <div class="col-6">
                <h3>Hubungi Kami</h3>
                    <ul class="address">
                        <li><i class="fas fa-map-marker-alt"></i>Yogyakarta, Indonesia</li>
                        <li><i class="fas fa-envelope"></i><a href="mailto:info@email">info@email</a></li>
                        <li><i class="fas fa-phone"></i><a href="https://api.whatsapp.com/send?phone=<?php echo $a->telp_admin ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">+62 8157 5900 148</a></li>
                    </ul>
            </div>
            <div class="col-6">
                <h3>Tentang Kami</h3>
                    <ul class="address">
                        <li><i class="fas fa-arrow-right"></i><a href="about">About Us</a></li>
                    </ul>
            </div>
        </div>
    </body>
</html>