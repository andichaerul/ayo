@extends('layout')
@section('title')
    <button class="btn btn-primary" onclick="showFormTambah()">Tambah Jadwal Acara</button>
@endsection

@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Organisasi</th>
                <th class="text-center">Tgl Acara</th>
                <th class="text-center">Deskripsi</th>
                <th class="text-center">Prioritas</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarAcara as $row)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $row->organisasi->nama_organisasi }}</td>
                    <td class="text-center">{{ $row->tgl_acara }}</td>
                    <td class="text-center">{{ $row->desc_acara }}</td>
                    <td class="text-center">{{ $row->prioritas_acara }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-warning" onclick="showFormAcaraSelesai('{{ $row->organisasi_id }}','{{ $row->id }}')">Selesaikan</button>

                            <button type="button" class="btn btn-info" onclick="showResumeAcara(
                                                                                                                    '{{ $row->organisasi->nama_organisasi }}',
                                                                                                                    '{{ $row->tgl_acara }}',
                                                                                                                    '{{ $row->desc_acara }}',
                                                                                                                    '{{ $row->prioritas_acara }}',
                                                                                                                    '{{ $row->id }}',
                                                                                                                )">Resume</button>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="formTambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Acara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Organisasi</label>
                        <select class="form-control" placeholder="Prioritas Acara" id="organisasi">
                            <option>Pilih Organisasi</option>
                            @foreach ($organisasi as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_organisasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Acara</label>
                        <input class="form-control" type="text" placeholder="Nama Acara" id="namaAcara">
                    </div>
                    <div class="form-group">
                        <label for="">Waktu Acara</label>
                        <input class="form-control" type="date" placeholder="Waktu Acara" id="waktuAcara">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Acara</label>
                        <textarea class="form-control" id="descAcara" placeholder="Deskripsi Acara" style="height:10em"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Prioritas Acara</label>
                        <select class="form-control" placeholder="Prioritas Acara" id="prioritas">
                            <option value="Wajib">Wajib</option>
                            <option value="Tidak wajib">Tidak wajib</option>
                            <option value="Hanya staf">Hanya staf</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="simpanAcara(this)">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="formAcaraSelesai">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Laporankan Acara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control laporkanAcara" value="{{ csrf_token() }}" name="_token">
                    <input type="hidden" class="form-control laporkanAcara" value="" name="jadwal_acara_id" id="jadwalAcaraId">
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">No</th>
                                    <th class="text-center" width="30%">Nama Anggota</th>
                                    <th class="text-center" width="30%">Kehadiran</th>
                                    <th class="text-center" width="30%">Konstribusi</th>
                                </tr>
                            </thead>
                            <tbody id="listMember"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="laporkanAcara(this)">Laporkan Acara</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="resumeAcara">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Resume Acara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>Acara kegiatan <strong id="resumeContent1"></strong></h3>
                            <h6>Prioritas <strong id="resumeContent2"></strong>, <strong id="resumeContent3"></strong></h6>
                            <p id="resumeContent4"></p>
                        </div>
                        <div class="col-12">
                            <h3>Kehadiran dan konstribusi anggota</h3>
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="10%">No</th>
                                            <th class="text-center" width="30%">Nama Anggota</th>
                                            <th class="text-center" width="30%">Kehadiran</th>
                                            <th class="text-center" width="30%">Konstribusi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kehadiranDanKonstribusiMember"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <h3>Pencapaian kegiatan acara</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="30%">Total Anggota Hadir</th>
                                        <th class="text-center" width="30%">Total konstribusi anggota</th>
                                    </tr>
                                </thead>
                                <tbody id="kehadiranDanKonstribusiMember">
                                    <tr>
                                        <td class="text-center" width="30%" id="totalHadirMember">Total Anggota Hadir</td>
                                        <td class="text-center" width="30%" id="konstribusiAnggota">Total konstribusi anggota</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showFormTambah() {
            _typeForm = "create";
            $("#formTambah").modal("show");
            $("#idOrganisasi").val("");
            $("#namaOrganisasi").val("");
            $("#tahunOrganisasi").val("");
            $("#alamatOrganisasi").val("");
            $("#cabOlahraga").val("Pilih Cabang Olahraga");
        }

        function showFormAcaraSelesai(organisasi_id, jadwalAcaraId) {
            $("#formAcaraSelesai").modal("show");
            $("#jadwalAcaraId").val(jadwalAcaraId);
            $.ajax({
                type: "post",
                url: "{!! url('jadwal-acara/get-member') !!}",
                data: {
                    _token: "{!! csrf_token() !!}",
                    organisasi_id: organisasi_id

                },
                dataType: "json",
                success: function(response) {
                    $("#listMember").html("");
                    let no = 1;
                    response.forEach(row => {
                        $("#listMember").append(`
                                <tr>
                                    <td class="text-center">${no++}</td>
                                    <td class="text-center">${row.nama}</td>
                                    <td class="text-center">
                                        <input type="hidden" value="${row.id}" class="form-control laporkanAcara" name="organisasi_member_id[]">
                                        <select class="form-control laporkanAcara" name="kehadiran_member[]">
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input class="form-control laporkanAcara" placeholder="Konstribusi Rp" id="waktuAcara" name="konstribusi_member[]">
                                    </td>
                                </tr>
                        `);
                    });
                },
                beforeSend: function() {

                },
            });

        }

        function simpanAcara(selector) {
            $.ajax({
                type: "post",
                url: "{!! url('/jadwal-acara/simpan') !!}",
                data: {
                    _token: '{!! csrf_token() !!}',
                    organisasi_id: $("#organisasi").val(),
                    tgl_acara: $("#waktuAcara").val(),
                    desc_acara: $("#descAcara").val(),
                    prioritas_acara: $("#prioritas").val(),
                },
                dataType: "json",
                success: function(response) {
                    $(selector).removeClass("btn-progress disable");
                    $(selector).prop('disabled', false);
                    if (response.statusCode == "00") {
                        alert("Berhasil Menyimpan Data");
                        location.reload();
                    } else {
                        try {
                            alert(response[0][0]);
                        } catch (error) {
                            alert("Gagal saat menyimpan data");
                        }
                    }
                },
                beforeSend: function() {
                    $(selector).addClass("btn-progress disable");
                    $(selector).prop('disabled', true);
                },
                error: function(response) {
                    let validationFail = [];
                    for (const key in response.responseJSON.errors) {
                        validationFail.push(response.responseJSON.errors[key][0]);
                    }
                    alert(validationFail.join('\n'));
                    $(selector).removeClass("btn-progress disable");
                    $(selector).prop('disabled', false);
                }
            });
        }

        function laporkanAcara(selector) {
            let form = $(".laporkanAcara").serialize();
            $.ajax({
                type: "post",
                url: "{!! url('jadwal-acara/selesai') !!}",
                data: form,
                dataType: "json",
                success: function(response) {
                    $(selector).removeClass("btn-progress disable");
                    $(selector).prop('disabled', false);
                    if (response.statusCode == "00") {
                        alert("Berhasil Menyimpan Data");
                        location.reload();
                    } else {
                        try {
                            alert(response[0][0]);
                        } catch (error) {
                            alert("Gagal saat menyimpan data");
                        }
                    }
                },
                beforeSend: function() {
                    $(selector).addClass("btn-progress disable");
                    $(selector).prop('disabled', true);
                },
                error: function(response) {
                    $(selector).removeClass("btn-progress disable");
                    $(selector).prop('disabled', false);
                    let validationFail = [];
                    for (const key in response.responseJSON.errors) {
                        validationFail.push(response.responseJSON.errors[key][0]);
                    }
                    alert(validationFail.join('\n'));
                }
            });
        }

        function showResumeAcara(namaOrganisasi, tgl, desc, prioritas, jadwalAcaraId) {
            $("#resumeAcara").modal("show");
            $("#resumeContent1").text(namaOrganisasi);
            $("#resumeContent2").text(prioritas);
            $("#resumeContent3").text(tgl);
            $("#resumeContent4").text(desc);
            $.ajax({
                type: "post",
                url: "{!! url('/jadwal-acara/get-resume') !!}",
                data: {
                    _token: '{!! csrf_token() !!}',
                    jadwal_acara_id: jadwalAcaraId,
                },
                dataType: "json",
                success: function(response) {
                    let no = 1;
                    let jumlahMemberHadir = 0;
                    let konstribusiMember = 0;
                    $('#kehadiranDanKonstribusiMember').html(``);
                    response.forEach(element => {
                        if (element.kehadiran_member == "Ya") {
                            jumlahMemberHadir = jumlahMemberHadir + 1;
                        }
                        konstribusiMember = Math.round(konstribusiMember) + Math.round(element.konstribusi_member) ;
                        $('#kehadiranDanKonstribusiMember').append(`
                        <tr>
                            <td class="text-center">${no++}</td>
                            <td class="text-center">${element.organisasi_member.nama}</td>
                            <td class="text-center">${element.kehadiran_member}</td>
                            <td class="text-center">${addCommas(element.konstribusi_member)}</td>
                        </tr>
                        `);
                    });
                    $("#totalHadirMember").text(jumlahMemberHadir);
                    $("#konstribusiAnggota").text(konstribusiMember);
                },
                beforeSend: function() {},
            });
        }

        function addCommas(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
@endsection
