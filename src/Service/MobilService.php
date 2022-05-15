<?php

namespace SamTech\Service;

use SamTech\Config\Database;
use SamTech\Domain\Mobil;
use SamTech\Exceptions\ValidationMobilException;
use SamTech\Model\Request\MobilAddRequest;
use SamTech\Model\Response\MobilAddResponse;
use SamTech\Repository\MobilRepository;

class MobilService
{

    private MobilRepository $repo;

    public function __construct(MobilRepository $mobilRepo)
    {
        $this->repo = $mobilRepo;
    }

    public function add(MobilAddRequest $request): MobilAddResponse
    {
        $this->validationMobilAdd($request);

        try {
            Database::beginTransaction();
            $mobil = $this->repo->findById($request->id);

            if ($mobil != null) {
                throw new ValidationMobilException("Mobil is not null !");
            }

            $mobil = new Mobil();
            $mobil->id = $request->id;
            $mobil->nama = $request->nama;
            $mobil->merek = $request->merek;
            $mobil->bbm = $request->bbm;
            $mobil->tahun = $request->tahun;
            $mobil->kapasitas = $request->kapasitas;
            $mobil->keterangan = $request->keterangan;
            $mobil->biaya = $request->biaya;
            $mobil->image = $request->image;


            $this->repo->save($mobil);

            $response = new MobilAddResponse();
            $response->mobil = $mobil;

            Database::commitTransaction();

            return $response;
        } catch (ValidationMobilException $exceptions) {
            Database::rollBackTransaction();
            throw new ValidationMobilException("Mobil is wrong !");
        }
    }

    public function validationMobilAdd(MobilAddRequest $request)
    {
        if ($request->id == null || $request->id == ""  || trim($request->id) == "" || $request->nama == null || $request->nama == ""  || trim($request->nama) == "") {
            throw new ValidationMobilException("ID, Nama can't blank !");
        }
    }

    public function showData(): ?array
    {
        $mobil = $this->repo->findAll();

        return $mobil;
    }
}
