<?php

namespace SamTech\Service;

use SamTech\Config\Database;
use SamTech\Domain\Transaksi;
use SamTech\Exceptions\ValidationTransaksi;
use SamTech\Model\TransaksiAddReq;
use SamTech\Model\TransaksiAddRes;
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
            $transaksi->id_member = $request->id_member;
            $transaksi->id_mobil = $request->id_mobil;
            $transaksi->tgl_pinjam = $request->tgl_pinjam;
            $transaksi->tgl_kembali = $request->tgl_kembali;
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
        if ($request->id == null || $request->id_member == null  || $request->id_mobil == null) {
            throw new ValidationTransaksi("Fill cannot blank");
        }
    }
}
