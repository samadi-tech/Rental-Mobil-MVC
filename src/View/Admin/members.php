<!-- Daftar Member -->
<div class="container-form">
    <h1>Data Member</h1>
    <hr />

    <div class="container-register">
        <form method="POST">
            <table>
                <tr>
                    <td>ID</td>
                    <td><input type="text" name="id" id="id" value="<?= $_POST["id"] ?? ""; ?>" autocomplete="none"></td>

                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username"></td>

                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="nama" id="nama"></td>
                </tr>
                <tr>
                    <td>Tempat Tanggal Lahir</td>
                    <td><input type="text" name="ttl" id="ttl"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" id="alamat"></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="text" name="telepon" id="telepon"></td>
                </tr>
                <tr>
                    <td>Upload Picture</td>
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
                <td>Username</td>
                <td>Nama</td>
                <td>Tempat Tanggal Lahir</td>
                <td>Alamat</td>
                <td>No Telepon</td>
            </thead>
            <tr>
                <td>Username</td>
                <td>Nama</td>
                <td>Tempat Tanggal Lahir</td>
                <td>Alamat</td>
                <td>No Telepon</td>
            </tr>
        </table>
    </div>
</div>