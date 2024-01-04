<?php 
    require '../function/functions.php';

    if (isset($_GET['filterSend'])) {
        $tgl = $_GET['filterSend'];
        $username = $_GET['username'];
        $query = "SELECT * FROM pemasukkan WHERE tanggal LIKE '%$tgl%' AND username = '$username'";
    } 

    $pemasukkan = query($query);
?>

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped table-bordered">
            <tr>
            <th>No.</th>
             <th>Tanggal</th>
             <th>Keterangan Pemasukkan</th>
              <th>Sumber Pemasukkan</th>
              <th>Jumlah Berat</th>
                <th>Jumlah pendapatan</th>
                 <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($pemasukkan as $row) : ?>
            <tr class="show" id="<?= $row["id"]; ?>">
                <td><?= $i; ?> </td>
                <td data-target="tanggal"><?= $row["tanggal"] ?></td>
                    <td data-target="keterangan"><?= $row["keterangan"] ?></td>
                    <td data-target="sumber"><?= $row["sumber"] ?></td>
                    <td data-target="JUMLAHBERAT"><?= $row["JUMLAHBERAT"] ?></td>
                    <td data-target="jumlahMasuk"><?= $row['jumlah'] ?></td>
                <td>    
                    <a href="#" id="<?= $row["id"] ?>" class="btn btn-info delete"><i class="fas fa-trash-alt"></i></a>
                    <a href="#" data-role="update" data-id="<?= $row["id"] ?>" class="btn btn-outline-secondary" id="openBtn"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            <?php
                 $jumlah3[] = $row["JUMLAHBERAT"];
                 $jumlahConvert = str_replace('.', '', $jumlah3);
                  $totali = array_sum($jumlahConvert);
                 $hasilJumlah3 = number_format($totali, 0, ',', '.');
             
                     $jumlah2[] = $row["jumlah"];
                     $jumlahConvert = str_replace('.', '', $jumlah2);
                     $totali = array_sum($jumlahConvert);
                     $hasilJumlah = number_format($totali, 0, ',', '.');
            ?>
            <?php $i++ ?>
            <?php endforeach; ?>

            <?php if ( isset($tgl) == $pemasukkan ) : ?> 
            <tr>
                <td colspan="4">Total Pemasukkan</td>
                <td> <?= $hasilJumlah3 ?></td>
                                   <td> <?= $hasilJumlah ?></td>
            </tr>
            <?php elseif ( isset($tgl) != $pemasukkan ) : ?> 
            <tr>
            </tr>
            <?php endif; ?>

        </table>
    </div>
</div>

<script src="ajax/js/deletePemasukkan.js"></script>