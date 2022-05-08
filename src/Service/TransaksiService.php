<?php

namespace SamTech\Service;

use SamTech\Config\Database;
use SamTech\Domain\Transaksi;
use SamTech\Exceptions\ValidationTransaksi;
use SamTech\Model\Request\TransaksiAddReq;
use SamTech\Model\Response\TransaksiAddRes;
use SamTech\Repository\TransaksiRepository;

class TransaksiService
{

    private TransaksiRepository $transRepo;

    public function __construct(TransaksiRepository $transRepo)
    {
        $this->transRepo = $transRepo;
    }

    public function add(TransaksiAddReq $request): TransaksiAddRes
    {
        $this->validateTransAddReq($request);

        try {
            Database::beginTransaction();
            $transaksi = $this->transRepo->findById($request->id);

            if ($transaksi != null) {
                throw new ValidationTransaksi("transaksi is not null");
            }

            $transaksi = new Transaksi();
            $transaksi->id = $request->id;
            $transaksi->idmember = $request->idmember;
            $transaksi->idmobil = $request->idmobil;
            $transaksi->tglpinjam = $request->tglpinjam;
            $transaksi->tglkembali = $request->tglkembali;
            $transaksi->tarif = $request->tarif;


            $this->transRepo->save($transaksi);

            $response = new TransaksiAddRes();
            $response->transaksi = $transaksi;

            Database::commitTransaction();

            return $response;
        } catch (\Exception $exceptions) {
            Database::rollBackTransaction();
            throw $exceptions;
        }
    }

    public function validateTransAddReq(TransaksiAddReq $request)
    {
        if ($request->id == "" || $request->idmember == ""  || $request->idmobil == "") {
            throw new ValidationTransaksi("Fill cannot blank");
        }
    }
}
