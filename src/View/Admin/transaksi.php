<!-- Daftar Member -->
<div class="container-form">
    <h1>Transaksi</h1>
    <hr />

    <div class="container-register">
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID Transaksi</td>
                    <td><input type="text" name="id" id="id" /></td>
                </tr>
                <tr>
                    <td>ID Member</td>
                    <td><input type="text" name="idmember" id="idmember" /></td>
                </tr>
                <tr>
                    <td>ID Mobil</td>
                    <td><input type="text" name="idmobil" id="idmobil" /></td>
                </tr>
                <tr>
                    <td>Tanggal Pinjam</td>
                    <td><input type="date" name="tglpinjam" id="tglpinjam" /></td>
                </tr>
                <tr>
                    <td>Tanggal Kembali</td>
                    <td><input type="date" name="tglkembali" id="tglkembali" /></td>
                </tr>
                <tr>
                    <td>Total Tarif</td>
                    <td><input type="text" name="tarif" id="tarif" /></td>
                </tr>
            </table>
            <div class="form-btn">
                <button type="submit" name="tambah" id="tambah">Tambah</button>
                <button type="submit">Ubah</button>
                <button type="submit">Hapus</button>
            </div>
        </form>
    </div>

    <div class="data-items">
        <table cellspacing="0">
            <thead>
                <td>ID Transaksi</td>
                <td>Nama Peminjam</td>
                <td>Jenis Mobil</td>
                <td>Tanggal Pesan</td>
                <td>Tanggal Kembali</td>
                <td>Total</td>
            </thead>
            <tr>
                <td>ID Transaksi</td>
                <td>Nama Peminjam</td>
                <td>Jenis Mobil</td>
                <td>Tanggal Pesan</td>
                <td>Tanggal Kembali</td>
                <td>Total</td>
            </tr>
        </table>
    </div>
</div>