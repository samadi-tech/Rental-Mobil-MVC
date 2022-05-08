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
        $statement = $this->connection->prepare("INSERT INTO SamTechRental.admin(id,username,password) VALUES (?,?,?)");
        $statement->execute([
            $admin->id, $admin->username, $admin->password
        ]);
        return $admin;
    }

    public function findById(int $id): ?Admin
    {
        $statement = $this->connection->prepare("SELECT id,username,password FROM SamTechRental.admin where id=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $admin = new Admin();
                $admin->id = $row['id'];
                $admin->username = $row['username'];
                $admin->password = $row['password'];

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
