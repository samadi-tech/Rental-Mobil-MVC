<?php

namespace SamTech\Repository;

use PDO;
use SamTech\Domain\Transaksi;

class TransaksiRepository
{
    private PDO $connection;

    public function __construct(PDO $conn)
    {
        $this->connection = $conn;
    }

    public function save(Transaksi $transaksi): Transaksi
    {
        $sql = $this->connection->prepare("INSERT INTO SamTechRental.transaksi (id_transaksi,id_member,id_mobil,tgl_pinjam,tgl_kembali,tarif_total) VALUES (?,?,?,?,?,?)");
        $sql->execute([$transaksi->id, $transaksi->id_member, $transaksi->id_mobil, $transaksi->tgl_pinjam, $transaksi->tgl_kembali, $transaksi->tarif]);

        return $transaksi;
    }

    public function findById(int $id): ?Transaksi
    {
        $statement = $this->connection->prepare("SELECT id_transaksi,id_member,id_mobil,tgl_pinjam,tgl_kembali,tarif_total FROM SamTechRental.transaksi where id_transaksi=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $transaksi = new Transaksi();
                $transaksi->id = $row['id_transaksi'];
                $transaksi->id_member = $row['id_member'];
                $transaksi->id_mobil = $row['id_mobil'];
                $transaksi->tgl_pinjam = $row['tgl_pinjam'];
                $transaksi->tgl_kembali = $row['tgl_kembali'];
                $transaksi->tarif = $row['tarif_total'];

                return $transaksi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $sql = "DELETE From SamTechRental.transaksi";
        $this->connection->exec($sql);
    }
}
