<!-- Daftar Member -->
<div class="container-form">
    <h1>Data Admin</h1>
    <hr />

    <div class="container-register">
        <form method="POST">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" id="username" value="<?= $_POST["username"] ?? ""; ?>" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><input type="text" name="nama" id="nama" autocomplete="off" /></td>
                </tr>

            </table>
            <div class="form-btn">
                <button type="submit" name="tambah">Tambah</button>
                <button type="submit" name="ubah">Ubah</button>
                <button type="submit" name="hapus">Hapus</button>
            </div>
        </form>
    </div>

    <div class="data-items">
        <table cellspacing="0">
            <thead>
                <td>Username</td>
                <td>Nama Lengkap</td>
            </thead>
            <?php
            $data = $model['data'];

            foreach ($data as $admin => $value) :
            ?>
                <tr>
                    <td><?= $value['username']; ?></td>
                    <td><?= $value['nama']; ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </div>
</div>