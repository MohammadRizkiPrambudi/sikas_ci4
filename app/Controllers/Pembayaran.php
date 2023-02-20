<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BulanPembayaranModel;
use App\Models\PembayaranModel;
use App\Models\AnggotaModel;
use App\Models\RekeningModel;
use App\Models\RiwayatModel;


class Pembayaran extends BaseController
{
    public function __construct()
    {
        $this->BulanPembayaranModel = new BulanPembayaranModel;
        $this->PembayaranModel = new PembayaranModel;
        $this->AnggotaModel = new AnggotaModel;
        $this->RiwayatModel = new RiwayatModel;
        $this->RekeningModel = new RekeningModel;
    }
    public function index()
    {
        $data = [
            'title' => 'Pembayaran Kas',
            'bulanbayar' => $this->BulanPembayaranModel->paginate(3),
            'pager' => $this->BulanPembayaranModel->pager,
            'masterpembayaran' => 'active',
            'mpembayaran' => 'active'
        ];
        return view('page/pembayaran', $data);
    }
    public function DetailPembayaranBulan($id_bulan_pembayaran)
    {
        $data = [
            'title' => 'Detail Pembayaran Kas',
            'masterpembayaran' => 'active',
            'mpembayaran' => 'active',
            'detail_bulan_pembayaran' => $this->BulanPembayaranModel->DetailBulanPembayaran($id_bulan_pembayaran),
            'anggota_baru' => $this->AnggotaModel->AnggotaBaru(),
            'pembayaran_kas_peranggota' => $this->PembayaranModel->PembayaranKasPerAnggota($id_bulan_pembayaran),
            'bulan_pembayaran_pertama' => $this->BulanPembayaranModel->BulanPembayaranPertama(),
            'kas_sebelum' =>  $this->PembayaranModel->KasSebelum($id_bulan_pembayaran - 1),
            'total_kasperbulan' => $this->PembayaranModel->TotalKasPerbulan($id_bulan_pembayaran),
        ];
        return view('page/pembayaran_kas_bulan', $data);
    }
    public function UpdatePembayaranMingguPertama()
    {
        $id_bulan_pembayaran = $this->request->getVar('id_bulan_pembayaran');
        $data = [
            'id_bulan_pembayaran' => $this->request->getVar('id_bulan_pembayaran'),
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'minggu_ke_1' => $this->request->getVar('minggu_ke_1'),
        ];
        $this->PembayaranModel->save($data);
        $minggu_ke_1 = $this->request->getVar('minggu_ke_1');
        $kas_sebelumnya = $this->request->getVar('kas_sebelumnya');
        $penginput = $this->request->getVar('id_user');
        $anggota =  $this->request->getVar('anggota');
        $riwayat = [
            'penginput' => $penginput,
            'keterangan' => " $penginput telah mengubah kas Sdr/Sdri $anggota pada minggu ke-1 dari $kas_sebelumnya menjadi $minggu_ke_1",
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->RiwayatModel->save($riwayat);
        session()->setFlashData('pesan', 'Data berhasil disimpan');
        return redirect()->to('Pembayaran/DetailPembayaranBulan/' . $id_bulan_pembayaran);
    }
    public function UpdatePembayaranMingguKedua()
    {
        $id_bulan_pembayaran = $this->request->getVar('id_bulan_pembayaran');
        $data = [
            'id_bulan_pembayaran' => $this->request->getVar('id_bulan_pembayaran'),
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'minggu_ke_2' => $this->request->getVar('minggu_ke_2'),
        ];
        $this->PembayaranModel->save($data);
        $minggu_ke_2 = $this->request->getVar('minggu_ke_2');
        $kas_sebelumnya = $this->request->getVar('kas_sebelumnya');
        $penginput = $this->request->getVar('id_user');
        $anggota =  $this->request->getVar('anggota');
        $riwayat = [
            'penginput' => $penginput,
            'keterangan' => " $penginput telah mengubah kas Sdr/Sdri $anggota pada minggu ke-2 dari $kas_sebelumnya menjadi $minggu_ke_2",
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->RiwayatModel->save($riwayat);
        session()->setFlashData('pesan', 'Data berhasil disimpan');
        return redirect()->to('Pembayaran/DetailPembayaranBulan/' . $id_bulan_pembayaran);
    }
    public function UpdatePembayaranMingguKetiga()
    {
        $id_bulan_pembayaran = $this->request->getVar('id_bulan_pembayaran');
        $data = [
            'id_bulan_pembayaran' => $this->request->getVar('id_bulan_pembayaran'),
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'minggu_ke_3' => $this->request->getVar('minggu_ke_3'),
        ];
        $this->PembayaranModel->save($data);
        $minggu_ke_3 = $this->request->getVar('minggu_ke_3');
        $kas_sebelumnya = $this->request->getVar('kas_sebelumnya');
        $penginput = $this->request->getVar('id_user');
        $anggota =  $this->request->getVar('anggota');
        $riwayat = [
            'penginput' => $penginput,
            'keterangan' => " $penginput telah mengubah kas Sdr/Sdri $anggota pada minggu ke-3 dari $kas_sebelumnya menjadi $minggu_ke_3",
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->RiwayatModel->save($riwayat);
        session()->setFlashData('pesan', 'Data berhasil disimpan');
        return redirect()->to('Pembayaran/DetailPembayaranBulan/' . $id_bulan_pembayaran);
    }
    public function UpdatePembayaranMingguKeempat()
    {
        $id_bulan_pembayaran = $this->request->getVar('id_bulan_pembayaran');
        $data = [
            'id_bulan_pembayaran' => $this->request->getVar('id_bulan_pembayaran'),
            'id_pembayaran' => $this->request->getVar('id_pembayaran'),
            'minggu_ke_4' => $this->request->getVar('minggu_ke_4'),
        ];
        $minggu_ke_4 = $this->request->getVar('minggu_ke_4');
        $pembayaran_perminggu = $this->request->getVar('pembayaran_perminggu');
        if ($minggu_ke_4 == $pembayaran_perminggu) {
            $data['status_lunas'] = 1;
        } else {
            $data['status_lunas'] = 0;
        }
        $this->PembayaranModel->save($data);
        $minggu_ke_4 = $this->request->getVar('minggu_ke_4');
        $kas_sebelumnya = $this->request->getVar('kas_sebelumnya');
        $penginput = $this->request->getVar('id_user');
        $anggota =  $this->request->getVar('anggota');
        $riwayat = [
            'penginput' => $penginput,
            'keterangan' => " $penginput telah mengubah kas Sdr/Sdri $anggota pada minggu ke-4 dari $kas_sebelumnya menjadi $minggu_ke_4",
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $this->RiwayatModel->save($riwayat);
        session()->setFlashData('pesan', 'Data berhasil disimpan');
        return redirect()->to('Pembayaran/DetailPembayaranBulan/' . $id_bulan_pembayaran);
    }
    public function BuktiPembayaran()
    {
        return view('page/bukti_pembayaran');
    }
    public function HistoryPembayaran()
    {
        $data = [
            'title' => 'History Pembayaran Kas',
            'kas' => $this->PembayaranModel->HistoryPembayaran(),
            'mpembayaran' => 'active'
        ];
        return view('page/history_pembayaran', $data);
    }
}
