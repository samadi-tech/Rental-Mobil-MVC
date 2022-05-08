<?php

namespace SamTech\Repository;

use SamTech\Domain\Member;

class MemberRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Member $member): Member
    {
        $statement = $this->connection->prepare("
        INSERT INTO SamTechRental.members (
            id,
            username,
            password,
            nama,
            ttl,
            alamat,
            telepon,
            image) VALUES (?,?,?,?,?,?,?,?)");

        $statement->execute([
            $member->id,
            $member->username,
            $member->password,
            $member->nama,
            $member->ttl,
            $member->alamat,
            $member->telepon,
            $member->image
        ]);
        return $member;
    }

    public function findById(int $id): ?Member
    {
        $statement = $this->connection->prepare("
        SELECT 
        id,
        username,
        password,
        nama,
        ttl,
        alamat,
        telepon,
        image FROM SamTechRental.members where id=?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $member = new Member();
                $member->id = $row['id'];
                $member->username = $row['username'];
                $member->password = $row['password'];
                $member->nama = $row['nama'];
                $member->ttl = $row['ttl'];
                $member->alamat = $row['alamat'];
                $member->telepon = $row['telepon'];
                $member->image = $row['image'];
                return $member;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $sql = "DELETE From SamTechRental.members";
        $this->connection->exec($sql);
    }
}
