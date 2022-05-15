<!-- Daftar Member -->

<div class="container-form">
    <h1>Data Member</h1>
    <hr />

    <div class="container-register">
        <form method="POST" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username" autocomplete="off" value="<?= $_POST["username"] ?? ""; ?>"></td>

                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="nama" id="nama" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Tempat Tanggal Lahir</td>
                    <td><input type="text" name="ttl" id="ttl" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" id="alamat" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td><input type="text" name="telepon" id="telepon" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Upload Picture</td>
                    <td><input type="file" name="image" id="image"></td>
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
                <td>No Telepon</td>
            </thead>
            <?php
            $data = $model['member'];

            foreach ($data as $member) :
            ?>
                <tr>
                    <td><?= $member['username']; ?></td>
                    <td><?= $member['nama']; ?></td>
                    <td><?= $member['telepon']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>