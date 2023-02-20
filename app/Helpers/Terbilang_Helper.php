<?php

// function terbilang($x)
// {
//     $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

//     if ($x < 12)
//         return " " . $angka[$x];
//     elseif ($x < 20)
//         return terbilang($x - 10) . " belas";
//     elseif ($x < 100)
//         return terbilang($x / 10) . " puluh" . terbilang($x % 10);
//     elseif ($x < 200)
//         return "seratus" . terbilang($x - 100);
//     elseif ($x < 1000)
//         return terbilang($x / 100) . " ratus" . terbilang($x % 100);
//     elseif ($x < 2000)
//         return "seribu" . terbilang($x - 1000);
//     elseif ($x < 1000000)
//         return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
//     elseif ($x < 1000000000)
//         return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
// }

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil . " Rupiah";
}
