<?php

namespace SamTech\Service;


use SamTech\Config\Database;
use SamTech\Domain\Bantuan;
use SamTech\Exceptions\ValidationPesan;
use SamTech\Model\Request\BantuanKirimRequest;
use SamTech\Model\Response\BantuanKirimResponse;
use SamTech\Repository\BantuanRepository;

class BantuanService
{

    private BantuanRepository $repo;

    public function __construct(BantuanRepository $bantuanRepo)
    {
        $this->repo = $bantuanRepo;
    }

    public function kirim(BantuanKirimRequest $request): BantuanKirimResponse
    {
        $this->ValidationBantuanKirim($request);

        try {
            Database::beginTransaction();

            $bantuan = new Bantuan();
            $bantuan->nama = $request->nama;
            $bantuan->subject = $request->subject;
            $bantuan->pesan = $request->pesan;

            $this->repo->save($bantuan);

            $response = new BantuanKirimResponse();
            $response->admin = $bantuan;

            Database::commitTransaction();

            return $response;
        } catch (\Exception $exceptions) {
            Database::rollBackTransaction();
            throw $exceptions;
        }
    }

    public function ValidationBantuanKirim(BantuanKirimRequest $request)
    {
        if ($request->nama == ""  || $request->subject == "") {
            throw new ValidationPesan("id cannot blank");
        }
    }

    public function showData(): ?array
    {
        $pesan = $this->repo->findAll();

        return $pesan;
    }
}
