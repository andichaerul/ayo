@extends('layout')
@section('title')
    <button class="btn btn-primary" id="tambah">Tambah Organisasi</button>
@endsection
@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Logo</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Tahun</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Cabang Olahraga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organisasi as $row)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $row->organisasi_name }}</td>
                    <td class="text-center">{{ $row->organisasi_tahun }}</td>
                    <td class="text-center">{{ $row->organisasi_alamat }}</td>
                    <td class="text-center">{{ $row->toCabangOlahraga->cab_olahraga_name }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-primary" onclick="update('{{ $row->organisasi_name }}','{{ $row->organisasi_tahun }}','{{ $row->organisasi_alamat }}','{{ $row->cab_olahraga_id }}',{{ $row->organisasi_id }})">Update</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deleted('{{ $row->organisasi_name }}','{{ $row->organisasi_id }}')">Deleted</button>
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
                    <h5 class="modal-title">Tambah Organisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" placeholder="Nama Organisasi" id="nama"><br>
                    <input class="form-control" type="text" placeholder="Tahun Organisasi" id="tahun"><br>
                    <textarea rows="5" class="form-control" type="text" placeholder="Alamat Organisasi" id="alamat"></textarea><br>
                    <select class="form-control" placeholder="Cabang Olahraga" id="cab">
                        <option>Cabang Olahraga</option>
                        @foreach ($cabangOlahraga as $row)
                            <option value="{{ $row->cab_olahraga_id }}">{{ $row->cab_olahraga_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="formUpdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Organisasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="hidden" placeholder="" id="u_id_organisasi"><br>
                    <input class="form-control" type="text" placeholder="Nama Organisasi" id="u_nama"><br>
                    <input class="form-control" type="text" placeholder="Tahun Organisasi" id="u_tahun"><br>
                    <textarea rows="5" class="form-control" type="text" placeholder="Alamat Organisasi" id="u_alamat"></textarea><br>
                    <select class="form-control" placeholder="Cabang Olahraga" id="u_cab">
                        <option>Cabang Olahraga</option>
                        @foreach ($cabangOlahraga as $row)
                            <option value="{{ $row->cab_olahraga_id }}">{{ $row->cab_olahraga_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="setUpdate()" id="btnUpdate">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#tambah").click(function(e) {
            e.preventDefault();
            $("#formTambah").modal("show");
        });

        $("#simpan").click(function(e) {
            $.ajax({
                type: "post",
                url: "{!! url('/organisasi/simpan') !!}",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    organisasi_name: $("#nama").val(),
                    organisasi_tahun: $("#tahun").val(),
                    organisasi_alamat: $("#alamat").val(),
                    cab_olahraga_id: $("#cab").val()
                },
                dataType: "json",
                success: function(response) {
                    $("#simpan").removeClass("btn-progress disable");
                    $("#simpan").prop('disabled', false);
                    if (response.statusCode == "00") {
                        alert("Berhasil Menyimpan Data");
                        location.reload();
                    } else {
                        try {
                            alert(response[0]);
                        } catch (error) {
                            alert("Gagal saat menyimpan data");
                        }
                    }
                },
                beforeSend: function() {
                    $("#simpan").addClass("btn-progress disable");
                    $("#simpan").prop('disabled', true);
                },
                error: function(response) {
                    $("#simpan").removeClass("btn-progress disable");
                    $("#simpan").prop('disabled', false);
                }
            });
        });

        function update(nama, tahun, alamat, cab, id) {
            $("#u_id_organisasi").val(id);
            $("#u_nama").val(nama);
            $("#u_tahun").val(tahun);
            $("#u_alamat").val(alamat);
            $("#u_cab").val(cab);
            $("#formUpdate").modal("show");
        }

        function setUpdate() {
            $.ajax({
                type: "post",
                url: "{!! url('/organisasi/update') !!}",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    organisasi_id: $("#u_id_organisasi").val(),
                    organisasi_name: $("#u_nama").val(),
                    organisasi_tahun: $("#u_tahun").val(),
                    organisasi_alamat: $("#u_alamat").val(),
                    cab_olahraga_id: $("#u_cab").val()
                },
                dataType: "json",
                success: function(response) {
                    $("#btnUpdate").removeClass("btn-progress disable");
                    $("#btnUpdate").prop('disabled', false);
                    if (response.statusCode == "00") {
                        alert("Berhasil Mengupdate Data");
                        location.reload();
                    } else {
                        try {
                            alert(response[0]);
                        } catch (error) {
                            alert("Gagal saat menyimpan data");
                        }
                    }
                },
                beforeSend: function() {
                    $("#btnUpdate").addClass("btn-progress disable");
                    $("#btnUpdate").prop('disabled', true);
                },
                error: function(response) {
                    $("#btnUpdate").removeClass("btn-progress disable");
                    $("#btnUpdate").prop('disabled', false);
                }
            });
        }

        function deleted(nama, id) {
            if (confirm(`Apakah anda yakin ingin menghapus ${nama} dari organisasi`)) {
                $.ajax({
                    type: "post",
                    url: "{!! url('/organisasi/deleted') !!}",
                    data: {
                        '_token': '{!! csrf_token() !!}',
                        organisasi_id: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.statusCode == "00") {
                            alert("Berhasil Menghapus Data");
                            location.reload();
                        } else {
                            try {
                                alert(response[0]);
                            } catch (error) {
                                alert("Gagal saat menyimpan data");
                            }
                        }
                    },
                    beforeSend: function() {},
                    error: function(response) {}
                });
            }
        }
    </script>
@endsection
