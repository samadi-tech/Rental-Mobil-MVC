<!-- Daftar Member -->
<div class="container-form">
    <h1>Data Mobil</h1>
    <hr />

    <div class="container-register">
        <form method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID</td>
                    <td><input type="text" name="id" id="id" value="<?= $_POST["id"] ?? ""; ?>" autocomplete="off"></td>

                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" id="nama" autocomplete="off"></td>

                </tr>
                <tr>
                    <td>Merek</td>
                    <td><input type="text" name="merek" id="merek" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Kapasitas BBM</td>
                    <td><input type="text" name="bbm" id="bbm" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td><input type="text" name="tahun" id="tahun" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Kapasitas</td>
                    <td><input type="text" name="kapasitas" id="kapasitas" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><input type="text" name="keterangan" id="keterangan" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Biaya</td>
                    <td><input type="text" name="biaya" id="biaya" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
            </table>
            <div class="form-btn">
                <button type="submit" name="add">Tambah</button>
                <button type="submit">Ubah</button>
                <button type="submit">Hapus</button>
            </div>
        </form>
    </div>

    <div class="data-items">
        <table cellspacing="0">
            <thead>
                <td>ID Mobil</td>
                <td>Nama</td>
                <td>Biaya</td>
            </thead>
            <?php
            $data = $model['data'];

            foreach ($data as $i => $mobil) :

            ?>
                <tr>
                    <td><?= $mobil['id']; ?></td>
                    <td><?= $mobil['nama']; ?></td>
                    <td><?= $mobil['biaya']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>