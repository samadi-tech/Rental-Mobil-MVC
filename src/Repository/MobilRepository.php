<?php

namespace SamTech\Repository;

use SamTech\Domain\Mobil;

class MobilRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Mobil $mobil): Mobil
    {
        $statement = $this->connection->prepare("
        INSERT INTO SamTechRental.mobil (
            id,
            nama,
            merek,
            bbm,
            tahun,
            kapasitas,
            keterangan,
            biaya,
            image) VALUES (?,?,?,?,?,?,?,?,?)");

        $statement->execute([
            $mobil->id,
            $mobil->nama,
            $mobil->merek,
            $mobil->bbm,
            $mobil->tahun,
            $mobil->kapasitas,
            $mobil->keterangan,
            $mobil->biaya,
            $mobil->image
        ]);
        return $mobil;
    }

    public function findById(string $id): ?mobil
    {
        $statement = $this->connection->prepare("SELECT 
        id,
        nama,
        merek,
        bbm,
        tahun,
        kapasitas,
        keterangan,
        biaya,
        image FROM SamTechRental.mobil where id=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $mobil = new Mobil();
                $mobil->id = $row['id'];
                $mobil->nama = $row['nama'];
                $mobil->merek = $row['merek'];
                $mobil->bbm = $row['bbm'];
                $mobil->tahun = $row['tahun'];
                $mobil->kapasitas = $row['kapasitas'];
                $mobil->keterangan = $row['keterangan'];
                $mobil->biaya = $row['biaya'];
                $mobil->image = $row['image'];
                return $mobil;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): ?array
    {
        $statement = $this->connection->prepare("SELECT id,nama,merek,bbm,tahun,kapasitas,keterangan,biaya,image FROM SamTechRental.mobil");
        $statement->execute();

        try {
            if ($mobil = $statement->fetchAll()) {
                return $mobil;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $sql = "DELETE From SamTechRental.mobil";
        $this->connection->exec($sql);
    }
}
