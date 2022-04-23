<?php

function getDatabase(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306,dbname=SamtechSkripsi",
                "username" => "root",
                "password" => ""
            ],
            "project" => [
                "url" => "mysql:host=localhost:3306,dbname=SamtechSkripsi",
                "username" => "root",
                "password" => ""
            ]

        ]
    ];
}
