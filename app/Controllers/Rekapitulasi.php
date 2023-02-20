<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KasModel;
use Hermawan\DataTables\DataTable;

class Rekapitulasi extends BaseController
{
    public function __construct()
    {
        $this->KasModel = new KasModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Rekapitulasi',
            'mrekapitulasi' => 'active',
            'masterpembayaran' => 'active',
            'rekapitulasi' => $this->KasModel->findAll(),
            'filter_keterangan' => $this->KasModel->getAllKeterangan(),
            'filter_tanggal' => $this->KasModel->getAllTanggal(),
            'filter_nama' => $this->KasModel->getAllNama(),

        ];
        return view('page/rekapitulasi', $data);
    }
    public function DataRekapitulasi()
    {
        if ($this->request->isAJAX()) {
            $rekapitulasi = new KasModel();
            $rekapitulasi->select('kode_kas,keterangan_kas,tgl_kas,nama_pengguna,jumlah_kas,jenis_kas,kas_keluar,');
            return DataTable::of($rekapitulasi)
                ->addNumbering('no')
                ->filter(function ($builder, $request) {
                    if ($request->keterangan_kas and $request->tgl_kas and $request->nama_pengguna) {
                        $builder->where('keterangan_kas', $request->keterangan_kas)->where('tgl_kas', $request->tgl_kas)->where('nama_pengguna', $request->nama_pengguna);
                    } elseif ($request->keterangan_kas and $request->tgl_kas) {
                        $builder->where('keterangan_kas', $request->keterangan_kas)->where('tgl_kas', $request->tgl_kas);
                    } elseif ($request->keterangan_kas and $request->nama_pengguna) {
                        $builder->where('keterangan_kas', $request->keterangan_kas)->where('nama_pengguna', $request->nama_pengguna);
                    } elseif ($request->tgl_kas and $request->nama_pengguna) {
                        $builder->where('tgl_kas', $request->tgl_kas)->where('nama_pengguna', $request->nama_pengguna);
                    } elseif ($request->keterangan_kas) {
                        $builder->where('keterangan_kas', $request->keterangan_kas);
                    } elseif ($request->tgl_kas) {
                        $builder->where('tgl_kas', $request->tgl_kas);
                    } elseif ($request->nama_pengguna) {
                        $builder->where('nama_pengguna', $request->nama_pengguna);
                    }
                })
                ->format('jenis_kas', function ($value) {
                    return ucwords($value);
                })
                ->edit('tgl_kas', function ($row) {
                    return '<span>' . tanggal($row->tgl_kas) . '<br> Penginput : ' . $row->nama_pengguna . '</span>';
                })
                ->toJson(true);
        }
    }
}
