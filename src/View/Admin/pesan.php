<!-- Daftar Member -->

<div class="container-form">
    <h1>Data Pesan</h1>
    <div class="data-items">
        <table cellspacing="0">
            <thead>
                <td>Nama</td>
                <td>Subject</td>
            </thead>
            <?php
            $data = $model['pesan'];

            foreach ($data as $pesan) :
            ?>
                <tr>
                    <td><?= $pesan['nama']; ?></td>
                    <td><?= $pesan['subject']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>