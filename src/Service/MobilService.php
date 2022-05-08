<?php

namespace SamTech\Service;

use SamTech\Config\Database;
use SamTech\Domain\Mobil;
use SamTech\Exceptions\ValidationMobil;
use SamTech\Model\Request\MobilRegisterReq;
use SamTech\Model\Response\MobilRegisterRes;
use SamTech\Repository\MobilRepository;

class MobilService
{

    private MobilRepository $mobilRepo;

    public function __construct(MobilRepository $mobilRepo)
    {
        $this->mobilRepo = $mobilRepo;
    }

    public function register(MobilRegisterReq $request): MobilRegisterRes
    {
        $this->validateMobilRegisterReq($request);

        try {
            Database::beginTransaction();
            $mobil = $this->mobilRepo->findById($request->id);

            if ($mobil != null) {
                throw new ValidationMobil("cars is not null");
            }

            $mobil = new Mobil();
            $mobil->id = $request->id;
            $mobil->nama = $request->nama;
            $mobil->merek = $request->merek;
            $mobil->bbm = $request->bbm;
            $mobil->dimensi = $request->dimensi;
            $mobil->mesin = $request->mesin;
            $mobil->tahun = $request->tahun;
            $mobil->biaya = $request->biaya;
            $mobil->image = $request->image;


            $this->mobilRepo->save($mobil);

            $response = new mobilRegisterRes();
            $response->mobil = $mobil;

            Database::commitTransaction();

            return $response;
        } catch (\Exception $exceptions) {
            Database::rollBackTransaction();
            throw $exceptions;
        }
    }

    public function validateMobilRegisterReq(mobilRegisterReq $request)
    {
        if ($request->id == null || $request->nama == ""  || $request->merek == "") {
            throw new ValidationMobil("cars cannot blank");
        }
    }
}
