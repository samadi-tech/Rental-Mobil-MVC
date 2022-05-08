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
        $statement = $this->connection->prepare("INSERT INTO SamTechRental.mobil(id,nama,dimensi,bbm,merek,mesin,tahun,tarif,image) VALUES (?,?,?,?,?,?,?,?,?)");
        $statement->execute([
            $mobil->id, $mobil->nama, $mobil->merek, $mobil->dimensi, $mobil->bbm, $mobil->mesin, $mobil->tahun, $mobil->tarif, $mobil->image
        ]);
        return $mobil;
    }

    public function findById(int $id): ?mobil
    {
        $statement = $this->connection->prepare("SELECT id,nama,dimensi,bbm,merek,mesin,tahun,tarif,image FROM SamTechRental.mobil where id=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $mobil = new Mobil();
                $mobil->id = $row['id'];
                $mobil->nama = $row['nama'];
                $mobil->dimesi = $row['dimensi'];
                $mobil->bbm = $row['bbm'];
                $mobil->merek = $row['merek'];
                $mobil->mesin = $row['mesin'];
                $mobil->tahun = $row['tahun'];
                $mobil->tarif = $row['tarif'];
                $mobil->image = $row['image'];
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
