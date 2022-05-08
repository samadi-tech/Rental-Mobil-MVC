<!-- Daftar Member -->
<div class="container-form">
    <h1>Data Mobil</h1>
    <hr />

    <div class="container-register">
        <form method="POST">
            <table>
                <tr>
                    <td>ID</td>
                    <td><input type="text" name="id" id="id" value="<?= $_POST["id"] ?? ""; ?>" autocomplete="none"></td>

                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" id="nama"></td>

                </tr>
                <tr>
                    <td>Merek</td>
                    <td><input type="text" name="merek" id="merek"></td>
                </tr>
                <tr>
                    <td>Kapasitas BBM</td>
                    <td><input type="text" name="bbm" id="bbm"></td>
                </tr>
                <tr>
                    <td>Dimensi</td>
                    <td><input type="text" name="dimensi" id="dimensi"></td>
                </tr>
                <tr>
                    <td>Mesin</td>
                    <td><input type="text" name="mesin" id="mesin"></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td><input type="text" name="tahun" id="tahun"></td>
                </tr>
                <tr>
                    <td>Biaya</td>
                    <td><input type="text" name="biaya" id="biaya"></td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td><input type="text" name="image" id="image"></td>
                </tr>
            </table>
            <div class="form-btn">
                <button type="submit" name="tambah">Tambah</button>
                <button type="submit">Ubah</button>
                <button type="submit">Hapus</button>
            </div>
        </form>
    </div>

    <div class="data-items">
        <table cellspacing="0">
            <thead>
                <td>ID Mobil</td>
                <td>Nama Mobil</td>
                <td>Merek</td>
                <td>Tahun Pembuatan</td>
                <td>Biaya</td>
            </thead>
            <tr>
                <td>ID Mobil</td>
                <td>Nama Mobil</td>
                <td>Merek</td>
                <td>Tahun Pembuatan</td>
                <td>Biaya</td>
            </tr>
        </table>
    </div>
</div>