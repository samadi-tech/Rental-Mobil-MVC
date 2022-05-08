<!-- Daftar Member -->
<div class="container-form">
    <h1>Data Admin</h1>
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
                    <td><input type="text" name="username" id="username" value="<?= $_POST["username"] ?? ""; ?> "></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" id="password" /></td>
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
            </thead>
            <tr>
                <td>Username</td>
            </tr>
        </table>
    </div>
</div>