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
        $sql = $this->connection->prepare("
        INSERT INTO SamTechRental.transaksi (
            id,
            id_member,
            id_mobil,
            tgl_pinjam,
            tgl_kembali,
            tarif_total) VALUES (?,?,?,?,?,?)");

        $sql->execute([
            $transaksi->id,
            $transaksi->idmember,
            $transaksi->idmobil,
            $transaksi->tglpinjam,
            $transaksi->tglkembali,
            $transaksi->tarif
        ]);

        return $transaksi;
    }

    public function findById(string $id): ?Transaksi
    {
        $statement = $this->connection->prepare("
        SELECT id,
        id_member,
        id_mobil,
        tgl_pinjam,
        tgl_kembali,
        tarif_total FROM SamTechRental.transaksi where id=?");

        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $transaksi = new Transaksi();
                $transaksi->id = $row['id'];
                $transaksi->idmember = $row['id_member'];
                $transaksi->idmobil = $row['id_mobil'];
                $transaksi->tglpinjam = $row['tgl_pinjam'];
                $transaksi->tglkembali = $row['tgl_kembali'];
                $transaksi->tarif = $row['tarif_total'];

                return $transaksi;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }


    public function findAll(): ?array
    {
        $statement = $this->connection->prepare("
        SELECT id,
        id_member,
        id_mobil,
        tgl_pinjam,
        tgl_kembali,
        tarif_total FROM SamTechRental.transaksi");

        $statement->execute();

        try {
            if ($transaksi = $statement->fetchAll()) {

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
