<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Hermawan\DataTables\DataTable;
use App\Models\KasModel;
use App\Models\PembayaranModel;
use App\Models\PengaturanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->KasModel = new KasModel;
        $this->PembayaranModel = new PembayaranModel;
        $this->PengaturanModel = new PengaturanModel;
    }
    public function DataLaporanKas()
    {
        if ($this->request->isAJAX()) {
            $Kas = new KasModel();
            $Kas->select('kode_kas,keterangan_kas,tgl_kas,nama_pengguna,jumlah_kas,jenis_kas,kas_keluar');
            return DataTable::of($Kas)
                ->addNumbering('no')
                ->edit('tgl_kas', function ($row) {
                    return '<span>' . tanggal($row->tgl_kas) . '<br> Penginput : ' . $row->nama_pengguna . '</span>';
                })
                ->edit('jenis_kas', function ($row) {
                    return ucwords($row->jenis_kas);
                })
                ->filter(function ($builder, $request) {
                    if ($request->bulan and $request->tahun) {
                        $builder->where('MONTH(tgl_kas)', $request->bulan)
                            ->where('YEAR(tgl_kas)', $request->tahun);
                    }
                })
                ->toJson(true);
        }
    }
    public function LaporanKas()
    {
        $data = [
            'title' => 'Laporan Kas',
            'masterlaporan' => 'active',
            'mlaporankas' => 'active',
        ];
        return view('page/lap_kas', $data);
    }
    public function LaporanPembayaranKas()
    {
        $data = [
            'title' => 'Laporan Pembayaran',
            'masterlaporan' => 'active',
            'mlaporanpembayaran' => 'active',
        ];
        return view('page/lap_pembayarankas', $data);
    }

    public function ViewLaporanKas()
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'cetak_pdf' => "/Laporan/CetakKasPDF?bulan=$bulan&tahun=$tahun",
            'cetak_excel' => "/Laporan/CetakKasEXCEL?bulan=$bulan&tahun=$tahun",
        ];
        $response =  [
            'data' => view('page/cetak_kas', $data)
        ];
        echo json_encode($response);
    }

    public function CetakKasPDF()
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $laporan = $this->KasModel->where('MONTH(tgl_kas)', $bulan)->where('YEAR(tgl_kas)', $tahun)->findAll();
        $pengaturan = $this->PengaturanModel->first();
        $pdf     = new TCPDF('P', 'mm', 'A4');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->Image('/back-end/img/icon/logo-login.jpeg', 10, 1, 29);
        $pdf->SetTitle('Cetak Laporan Kas');
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(190, 5, 'Laporan Kas ' . $pengaturan['nama_organisasi'], 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(190, 5, $pengaturan['alamat_organisasi'], 0, 1, 'C');
        $pdf->SetLineWidth(1);
        $pdf->Line(10, 30, 200, 30);
        $pdf->SetLineWidth(0);
        $pdf->Line(10, 31, 200, 31);
        $pdf->ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(190, 5, 'Laporan Kas', 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $pdf->ln(1);
        $pdf->Cell(190, 5, 'Periode ' . Bulan($bulan) . ' ' . $tahun, 0, 1, 'C');
        $pdf->ln();
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Kode Kas', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Keterangan', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Kas Masuk', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Kas Keluar', 1, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $no = 1;
        $total_kasmasuk = 0;
        $total_kaskeluar = 0;
        if ($laporan) {
            foreach ($laporan as $d) {
                $pdf->Cell(10, 6, $no++, 1, 0, 'C');
                $pdf->Cell(30, 6, $d['kode_kas'], 1, 0, 'C');
                $pdf->Cell(60, 6, $d['keterangan_kas'], 1, 0);
                $pdf->Cell(30, 6, tanggal($d['tgl_kas']), 1, 0, 'C');
                $pdf->Cell(30, 6, 'Rp. ' . number_format($d['jumlah_kas']), 1, 0, 'R');
                $pdf->Cell(30, 6, 'Rp. ' . number_format($d['kas_keluar']), 1, 1, 'R');
                $total_kasmasuk += $d['jumlah_kas'];
                $total_kaskeluar += $d['kas_keluar'];
                $saldoakhir = $total_kasmasuk - $total_kaskeluar;
            }
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(130, 6, 'Kas Masuk', 1, 0, 'L');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(30, 6, 'Rp. ' . number_format($total_kasmasuk), 1, 0, 'R');
            $pdf->Cell(30, 6, '', 1, 1, 'C');
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(160, 6, 'Kas Keluar', 1, 0, 'L');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(30, 6, 'Rp. ' . number_format($total_kaskeluar), 1, 1, 'R');
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(80, 6, 'Saldo Akhir', 1, 0, 'L');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(80, 6, 'Rp. ' . number_format($saldoakhir), 1, 0, 'L');
            $pdf->Cell(30, 6, '', 1, 1, 'C');
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(80, 6, 'Terbilang', 1, 0, 'L');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(80, 6, '(' . ucwords(terbilang($saldoakhir)) . ')', 1, 0, 'L');
            $pdf->Cell(30, 6, '', 1, 1, 'C');
            $pdf->ln(10);
            $pdf->Cell(190, 4, 'Kendal, ' . tanggal(date('Y-m-d')), 0, 1, 'C');
            $pdf->ln(10);
            $pdf->Cell(70, 5, 'Bendahara', 0, 0, 'R');
            $pdf->Cell(70, 5, 'Ketua Pambrasta', 0, 0, 'R');
            $pdf->ln(30);
            $pdf->Cell(80, 5, 'Melinda Mulyanigrum', 0, 0, 'R');
            $pdf->Cell(65, 5, 'Yusril Deva Mahendra', 0, 0, 'R');
        } else {
            $pdf->Cell(190, 6, 'Data tidak ditemukan', 1, 1, 'C');
        }
        $this->response->setContentType('application/pdf');
        $bulan_indo = bulan($bulan);
        $pdf->Output("Laporan Kas Bulan $bulan_indo Tahun $tahun.pdf", 'I');
    }
    public function CetakKasEXCEL()
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $laporan = $this->KasModel->where('MONTH(tgl_kas)', $bulan)->where('YEAR(tgl_kas)', $tahun)->findAll();
        $pengaturan = $this->PengaturanModel->first();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Laporan Kas " . $pengaturan['nama_organisasi']);
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(15);

        $sheet->setCellValue('A4', "No");
        $sheet->setCellValue('B4', "Kode Kas");
        $sheet->setCellValue('C4', "Keterangan");
        $sheet->setCellValue('D4', "Tanggal");
        $sheet->setCellValue('E4', "Kas Masuk");
        $sheet->setCellValue('F4', "Kas Keluar");

        $no = 1;
        $row = 5;

        foreach ($laporan as $lap) :
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $lap['kode_kas']);
            $sheet->setCellValue('C' . $row, $lap['keterangan_kas']);
            $sheet->setCellValue('D' . $row, $lap['tgl_kas']);
            $sheet->setCellValue('E' . $row, $lap['jumlah_kas']);
            $sheet->setCellValue('F' . $row, $lap['kas_keluar']);
            $no++;
            $row++;
        endforeach;

        $sheet->setTitle("Laporan Kas " . $pengaturan['nama_organisasi']);
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Kas Bulan ' . Bulan($bulan) . ' Tahun ' . $tahun . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function ViewLaporanPembayaran()
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'cetak_pdf' => "/Laporan/CetakPembayaranPDF?bulan=$bulan&tahun=$tahun",
            'cetak_excel' => "/Laporan/CetakPembayaranEXCEL?bulan=$bulan&tahun=$tahun",
            'lap_pembayaran' => $this->PembayaranModel->LaporanPembayaran($bulan, $tahun),
        ];
        $response =  [
            'data' => view('page/cetak_pembayaran', $data)
        ];
        echo json_encode($response);
    }
    public function CetakPembayaranPDF()
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $laporan = $this->PembayaranModel->LaporanPembayaran($bulan, $tahun);
        $total_perbulan = $this->PembayaranModel->TotalCetakKasPerbulan($bulan, $tahun);
        $pengaturan = $this->PengaturanModel->first();
        $pdf     = new TCPDF('P', 'mm', 'A4');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->Image('/back-end/img/icon/logo-login.jpeg', 10, 1, 29);
        $pdf->SetTitle('Cetak Laporan Pembayaran');
        $pdf->SetFont('times', 'B', 16);
        $pdf->Cell(190, 5, 'Laporan Pembayaran Kas ' . $pengaturan['nama_organisasi'], 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(190, 5, $pengaturan['alamat_organisasi'], 0, 1, 'C');
        $pdf->SetLineWidth(1);
        $pdf->Line(10, 30, 200, 30);
        $pdf->SetLineWidth(0);
        $pdf->Line(10, 31, 200, 31);
        $pdf->ln(10);
        $pdf->SetFont('times', 'B', 14);
        $pdf->Cell(190, 5, 'Laporan Pembayaran Kas', 0, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $pdf->ln(1);
        $pdf->Cell(190, 5, 'Periode ' . $bulan . ' ' . $tahun, 0, 1, 'C');
        $pdf->ln();
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Nama Anggota', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Minggu-ke-1', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Minggu-ke-2', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Minggu-ke-3', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Minggu-ke-4', 1, 1, 'C');
        $pdf->SetFont('times', '', 12);
        $no = 1;
        if ($laporan) {
            foreach ($laporan as $d) {
                $pdf->Cell(10, 6, $no++, 1, 0, 'C');
                $pdf->Cell(60, 6, $d['nama_anggota'], 1, 0, 'C');
                $pdf->Cell(30, 6, 'Rp. ' . number_format($d['minggu_ke_1']), 1, 0, 'R');
                $pdf->Cell(30, 6, 'Rp. ' . number_format($d['minggu_ke_2']), 1, 0, 'R');
                $pdf->Cell(30, 6, 'Rp. ' . number_format($d['minggu_ke_3']), 1, 0, 'R');
                $pdf->Cell(30, 6, 'Rp. ' . number_format($d['minggu_ke_4']), 1, 1, 'R');
            }
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(70, 6, 'Total Pemasukkan', 1, 0, 'L');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(120, 6, 'Rp. ' . number_format($total_perbulan['total_perbulan']), 1, 1, 'C');
            $pdf->SetFont('times', 'B', 12);
            $pdf->Cell(70, 6, 'Terbilang', 1, 0, 'L');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(120, 6, ucwords(Terbilang($total_perbulan['total_perbulan'])), 1, 0, 'L');
            $pdf->ln(10);
            $pdf->Cell(190, 4, 'Kendal, ' . tanggal(date('Y-m-d')), 0, 1, 'C');
            $pdf->ln(10);
            $pdf->Cell(70, 5, 'Bendahara', 0, 0, 'R');
            $pdf->Cell(70, 5, 'Ketua Pambrasta', 0, 0, 'R');
            $pdf->ln(30);
            $pdf->Cell(80, 5, 'Melinda Mulyanigrum', 0, 0, 'R');
            $pdf->Cell(65, 5, 'Yusril Deva Mahendra', 0, 0, 'R');
        } else {
            $pdf->Cell(190, 6, 'Data tidak ditemukan', 1, 1, 'C');
        }
        $this->response->setContentType('application/pdf');
        $pdf->Output("Laporan Pembayaran Kas Bulan $bulan Tahun $tahun.pdf", 'I');
    }
    public function CetakPembayaranEXCEL()
    {
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $laporan = $this->PembayaranModel->LaporanPembayaran($bulan, $tahun);
        $pengaturan = $this->PengaturanModel->first();
        $total_perbulan = $this->PembayaranModel->TotalCetakKasPerbulan($bulan, $tahun);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Laporan Pembayaran Kas " . $pengaturan['nama_organisasi']);
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(15);

        $sheet->setCellValue('A2', "Bulan" . " " . $bulan . " " . $tahun);
        $sheet->mergeCells('A2:F2');
        $sheet->getStyle('A1')->getFont()->setSize(12);

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A4:F4')->applyFromArray($borderStyle);
        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A4:F4')->applyFromArray($styleArray);
        $sheet->getStyle('A4:F4')->getFont()->setBold(true);
        $sheet->setCellValue('A4', "No");
        $sheet->setCellValue('B4', "Nama Anggota");
        $sheet->setCellValue('C4', "Minggu Ke 1");
        $sheet->setCellValue('D4', "Minggu Ke 2");
        $sheet->setCellValue('E4', "Minggu Ke 3");
        $sheet->setCellValue('F4', "Minggu Ke 4");



        $no = 1;
        $row = 5;

        foreach ($laporan as $lap) :
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $lap['nama_anggota']);
            $sheet->setCellValue('C' . $row, $lap['minggu_ke_1']);
            $sheet->setCellValue('D' . $row, $lap['minggu_ke_2']);
            $sheet->setCellValue('E' . $row, $lap['minggu_ke_3']);
            $sheet->setCellValue('F' . $row, $lap['minggu_ke_4']);

            $sheet->getStyle('A' . $row)->applyFromArray($borderStyle);
            $sheet->getStyle('A' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('B' . $row)->applyFromArray($borderStyle);
            $sheet->getStyle('C' . $row)->applyFromArray($borderStyle);
            // $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0.00');
            $sheet->getStyle('D' . $row)->applyFromArray($borderStyle);
            $sheet->getStyle('E' . $row)->applyFromArray($borderStyle);
            $sheet->getStyle('F' . $row)->applyFromArray($borderStyle);



            $no++;
            $row++;

        endforeach;

        $sheet->setCellValue('A' . $row, "Total");

        $sheet->mergeCells('A' . $row . ':' . 'B' . $row);
        $sheet->getStyle('A' . $row)->getFont()->setBold(true);
        $sheet->setCellValue('C' . $row, $total_perbulan["total_perbulan"]);
        $sheet->mergeCells('C' . $row . ':' . 'F' . $row);

        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':' . 'F' . $row)->applyFromArray($borderStyle);
        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':' . 'F' . $row)->applyFromArray($styleArray);

        $sheet->setTitle("Laporan Pembayaran " . $pengaturan['nama_organisasi']);
        $sheet->getColumnDimension('A')->setWidth(30, 'pt');
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Pembayaran Bulan ' . $bulan . ' Tahun ' . $tahun . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
