$(document).ready(function () {
  $(".uang").mask("000.000.000", { reverse: true });
});

$(document).on("click", ".btn-edit", function () {
  const kode = $(this).data("kode");
  const keterangan = $(this).data("keterangan");
  const tanggal = $(this).data("tanggal");
  const jumlah = $(this).data("jumlah");
  $(".modal-edit #kode").val(kode);
  $(".modal-edit #keterangan").val(keterangan);
  $(".modal-edit #tgl").val(tanggal);
  $(".modal-edit #jumlah").val(jumlah);
  $(".modal-edit #kas_lama").val(jumlah);
});
$(document).on("click", ".btn-ubah", function () {
  const kode = $(this).data("kode");
  const keterangan = $(this).data("keterangan");
  const tanggal = $(this).data("tanggal");
  const jumlah = $(this).data("jumlah");
  $(".modal-edit #kode").val(kode);
  $(".modal-edit #keterangan").val(keterangan);
  $(".modal-edit #tgl").val(tanggal);
  $(".modal-edit #jumlah").val(jumlah);
  $(".modal-edit #kas_lama").val(jumlah);
});
$(document).ready(function () {
  $("#tabel-kasmasuk").DataTable({
    processing: true,
    serverSide: true,
    scrollY: false,
    scrollX: false,
    ajax: "/KasMasuk/DataKasMasuk",
    order: [],
    columns: [
      {
        data: "no",
        orderable: false,
      },
      {
        data: "kode_kas",
      },
      {
        data: "keterangan_kas",
      },
      {
        data: "tgl_kas",
      },
      {
        data: "jumlah_kas",
        render: $.fn.dataTable.render.number(".", ",", 2, "Rp. "),
      },
      {
        data: "aksi",
        orderable: false,
      },
    ],
  });
});

$(document).ready(function () {
  var tabel = $("#tabel-laporankas").DataTable({
    processing: true,
    serverSide: true,
    scrollY: false,
    scrollX: false,
    searching: false,
    info: false,
    destroy: true,
    ajax: {
      url: "/Laporan/DataLaporanKas",
      data: function (d) {
        d.bulan = $("#bulan").val();
        d.tahun = $("#tahun").val();
      },
    },
    order: [],
    columns: [
      {
        data: "no",
        orderable: false,
      },
      {
        data: "kode_kas",
      },
      {
        data: "keterangan_kas",
      },
      {
        data: "tgl_kas",
      },
      {
        data: "jumlah_kas",
        render: $.fn.dataTable.render.number(".", ",", 2, "Rp. "),
      },
      {
        data: "jenis_kas",
      },
      {
        data: "kas_keluar",
        render: $.fn.dataTable.render.number(".", ",", 2, "Rp. "),
      },
    ],
  });
  $(".reload").on("click", function (event) {
    tabel.ajax.reload();
  });
});

$(document).ready(function () {
  table = $("#tabel-rekapitulasi").DataTable({
    processing: true,
    serverSide: true,
    scrollY: false,
    scrollX: false,
    ajax: {
      url: "/Rekapitulasi/DataRekapitulasi",
      data: function (d) {
        d.keterangan_kas = $("#keterangan_kas").val();
        d.nama_pengguna = $("#nama_pengguna").val();
        d.tgl_kas = $("#tgl_kas").val();
      },
    },
    order: [],
    columns: [
      {
        data: "no",
        orderable: false,
      },
      {
        data: "kode_kas",
      },
      {
        data: "keterangan_kas",
      },
      {
        data: "tgl_kas",
      },
      {
        data: "jumlah_kas",
        render: $.fn.dataTable.render.number(".", ",", 2, "Rp. "),
      },
      {
        data: "jenis_kas",
      },
      {
        data: "kas_keluar",
        render: $.fn.dataTable.render.number(".", ",", 2, "Rp. "),
      },
    ],
    // footerCallback: function (row, data, start, end, display) {
    //   var api = this.api(),
    //     data;
    //   // Remove the formatting to get integer data for summation
    //   var intVal = function (i) {
    //     return typeof i === "string"
    //       ? i.replace(/[$,]/g, "") * 1
    //       : typeof i === "number"
    //       ? i
    //       : 0;
    //   };

    //   // Total over all pages
    //   totalKasMasuk = api
    //     .column(4)
    //     .data()
    //     .reduce(function (z, h) {
    //       return intVal(z) + intVal(h);
    //     }, 0);

    //   totalKasKeluar = api
    //     .column(6)
    //     .data()
    //     .reduce(function (z, h) {
    //       return intVal(z) + intVal(h);
    //     }, 0);
    //   // Update footer
    //   var NumFormat = $.fn.dataTable.render.number(".", ",", 2, "Rp. ").display;
    //   $("#kas_masuk").html(
    //     NumFormat(totalKasMasuk) +
    //       "<br/>" +
    //       " ( " +
    //       terbilang(totalKasMasuk) +
    //       " Rupiah )"
    //   );
    //   $("#kas_keluar").html(
    //     NumFormat(totalKasKeluar) +
    //       "<br/>" +
    //       " ( " +
    //       terbilang(totalKasKeluar) +
    //       " Rupiah )"
    //   );
    //   saldoakhir = totalKasMasuk - totalKasKeluar;
    //   $("#saldo_akhir").html(
    //     NumFormat(saldoakhir) +
    //       "<br/>" +
    //       " ( " +
    //       terbilang(saldoakhir) +
    //       " Rupiah )"
    //   );
    // },
  });
  $("#keterangan_kas, #nama_pengguna, #tgl_kas").on("change", function (event) {
    table.ajax.reload();
  });
});

$(document).ready(function () {
  $("#tabel").DataTable({
    destroy: true,
    lengthChange: true,
    scrollY: false,
    scrollX: false,
  });
});
$(document).ready(function () {
  $("#frmKas").validate({
    rules: {
      keterangan: {
        required: true,
      },
      jumlah: {
        required: true,
      },
      tgl: {
        required: true,
      },
    },
    messages: {
      keterangan: {
        required: "Keterangan harus diisi",
      },
      jumlah: {
        required: "Jumlah harus diisi",
      },
      tgl: {
        required: "Tanggal harus diisi",
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
  });
});

$(document).ready(function () {
  const flashData = $(".flash-data").data("flash");
  if (flashData) {
    var Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    Toast.fire({
      icon: "success",
      title: flashData,
    });
  }
});

$(document).ready(function () {
  const flashError = $(".flash-error").data("error");
  if (flashError) {
    var Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    Toast.fire({
      icon: "error",
      title: flashError,
    });
  }
});

// popup hapus
$(document).on("click", ".hapus", function (e) {
  e.preventDefault();
  var getLink = $(this).attr("href");
  Swal.fire({
    title: "Hapus Data?",
    text: "Data akan dihapus permanen",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  });
});

$(document).on("click", ".konfirmasi", function (e) {
  e.preventDefault();
  var getLink = $(this).attr("href");
  Swal.fire({
    title: "Konfirmasi Pembayaran",
    text: "Apakah anda yakin ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Konfirmasi",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  });
});

function previewGambar() {
  const foto = document.querySelector("#foto");
  const labelfoto = document.querySelector(".custom-file-label");
  const imgPreview = document.querySelector(".img-preview");

  labelfoto.textContent = foto.files[0].name;
  const oFReader = new FileReader();
  oFReader.readAsDataURL(foto.files[0]);
  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

function ViewLaporan() {
  let bulan = $("#bulan").val();
  let tahun = $("#tahun").val();
  if (bulan == "" && tahun == "") {
    var Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    Toast.fire({
      icon: "error",
      title: "Bulan Harus Diisi",
    });
  } else {
    $.ajax({
      type: "POST",
      url: "/Laporan/ViewLaporanKas",
      data: {
        bulan: bulan,
        tahun: tahun,
      },
      dataType: "JSON",
      success: function (response) {
        if (response.data) {
          $("#laporan-kas").html(response.data);
        }
      },
    });
  }
}

function ViewLaporanPembayaran() {
  let bulan = $("#bulan").val();
  let tahun = $("#tahun").val();
  if (bulan == "" && tahun == "") {
    var Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
    });
    Toast.fire({
      icon: "error",
      title: "Bulan dan tahun Harus Diisi",
    });
  } else {
    $.ajax({
      type: "POST",
      url: "/Laporan/ViewLaporanPembayaran",
      data: {
        bulan: bulan,
        tahun: tahun,
      },
      dataType: "JSON",
      success: function (response) {
        if (response.data) {
          $("#laporan-pembayaran").html(response.data);
        }
      },
    });
  }
}
