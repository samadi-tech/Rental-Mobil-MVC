<?php

function getDatabase(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3308,dbname=SamTechRental",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3308,dbname=SamTechRental",
                "username" => "root",
                "password" => ""
            ]

        ]
    ];
}
