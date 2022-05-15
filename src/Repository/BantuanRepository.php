<?php

namespace SamTech\Repository;

use PDO;
use SamTech\Domain\Bantuan;

class BantuanRepository
{
    private PDO $con;

    public function __construct(PDO $connection)
    {
        $this->con = $connection;
    }

    public function save(Bantuan $value): Bantuan
    {
        $statement = $this->con->prepare("INSERT INTO SamTechRental.pesan (nama,subject,pesan) VALUES (?,?,?)");
        $statement->execute([
            $value->nama, $value->subject, $value->pesan
        ]);

        return $value;
    }

    public function findByID(int $id): ?Bantuan
    {
        $statement = $this->con->prepare("SELECT id,nama,subject,pesan FROM SamTechRental.pesan WHERE id=?");
        $statement->execute([$id]);

        $Bantuan = new Bantuan();
        try {
            if ($row = $statement->fetch()) {
                $Bantuan = new Bantuan();
                $Bantuan->id = $row['id'];
                $Bantuan->nama = $row['nama'];
                $Bantuan->subject = $row['subject'];
                $Bantuan->Bantuan = $row['pesan'];

                return $Bantuan;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): ?array
    {
        $statement = $this->con->prepare("SELECT id,nama,subject,pesan FROM SamTechRental.pesan");
        $statement->execute();

        try {
            if ($pesan = $statement->fetchAll()) {
                return $pesan;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }



    public function deleteAll()
    {
        $sql = "DELETE FROM SamTechRental.pesan";
        $this->con->exec($sql);
    }
}
