<!-- Cards -->
<div class="container-card">
    <?php
    $data = $model['mobil'];

    foreach ($data as $mobil) :
    ?>
        <div class="cards">
            <div class="card-pic">
                <img src="<?= ASSETS; ?>/img/<?= $mobil['image']; ?>">
            </div>

            <div class="card-list">
                <h1 class="title-card"><?= $mobil['nama']; ?></h1>
                <table class="card-table">
                    <tr>
                        <td>
                    <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td><?= $mobil['merek']; ?></td>
                    </tr>
                    <tr>
                        <td>Kapasitas tangki BBM</td>
                        <td>:</td>
                        <td><?= $mobil['bbm']; ?></td>
                    </tr>
                    <tr>
                        <td>Tahun Pembuatan</td>
                        <td>:</td>
                        <td><?= $mobil['tahun']; ?></td>
                    </tr>
                    <tr>
                        <td>Kapasitas Mobil</td>
                        <td>:</td>
                        <td><?= $mobil['kapasitas']; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan Mobil</td>
                        <td>:</td>
                        <td><?= $mobil['keterangan']; ?></td>
                    </tr>
                    <tr>
                        <td>Tarif</td>
                        <td>:</td>
                        <td><span><?= $mobil['biaya']; ?> *</span></td>
                    </tr>
                    </td>
                    </tr>
                </table>

                <p>* Dalam satuan hari</p>
            </div>
            <div class="card-btn">
                <button>Book Now</button>
            </div>
        </div>

    <?php endforeach; ?>

</div>