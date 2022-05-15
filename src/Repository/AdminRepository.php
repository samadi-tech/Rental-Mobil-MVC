<?php

namespace SamTech\Repository;

use SamTech\Domain\Admin;

class AdminRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Admin $admin): Admin
    {
        $statement = $this->connection->prepare("INSERT INTO SamTechRental.admin(username,password,nama) VALUES (?,?,?)");
        $statement->execute([
            $admin->username, $admin->password, $admin->nama
        ]);
        return $admin;
    }

    public function findById(int $id): ?Admin
    {
        $statement = $this->connection->prepare("SELECT id,username,password,nama FROM SamTechRental.admin where id=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $admin = new Admin();
                $admin->id = $row['id'];
                $admin->username = $row['username'];
                $admin->password = $row['password'];
                $admin->nama = $row['nama'];

                return $admin;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByUsername(string $username): ?Admin
    {
        $statement = $this->connection->prepare("SELECT id,username,password,nama FROM SamTechRental.admin where username=?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $admin = new Admin();
                $admin->id = $row['id'];
                $admin->username = $row['username'];
                $admin->password = $row['password'];
                $admin->nama = $row['nama'];

                return $admin;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): ?array
    {
        $statement = $this->connection->prepare("SELECT id,username,nama FROM SamTechRental.admin");
        $statement->execute();

        try {
            if ($admin = $statement->fetchAll()) {
                return $admin;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $sql = "DELETE From SamTechRental.admin";
        $this->connection->exec($sql);
    }
}
