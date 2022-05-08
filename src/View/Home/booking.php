<!-- Transaksi -->
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
                <button type="submit" name="pesan" id="pesan">Pesan</button>
            </div>
        </form>
    </div>
</div>