@extends('layout')
@section('title')
    <button class="btn btn-primary" onclick="showFormTambah()">Tambah Organisasi</button>
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
                    <td class="text-center">{{ $row->nama_organisasi }}</td>
                    <td class="text-center">{{ $row->tahun_berdiri }}</td>
                    <td class="text-center">{{ $row->alamat }}</td>
                    <td class="text-center">{{ $row->cabangOlahraga->name_cab }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-primary" onclick="showFormUpdate(
                                    '{{ $row->id }}',
                                    '{{ $row->nama_organisasi }}',
                                    '{{ $row->tahun_berdiri }}',
                                    '{{ $row->alamat }}',
                                    '{{ $row->cabangOlahraga->id }}')">Update
                            </button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deletedOrganisasi(
                                    '{{ $row->nama_organisasi }}',
                                    '{{ $row->id }}')">Deleted
                            </button>
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
                    <input class="form-control update" type="hidden" id="idOrganisasi">
                    <div class="form-group">
                        <label for="">Nama Organisasi</label>
                        <input class="form-control create update" type="text" placeholder="Nama Organisasi" id="namaOrganisasi">
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Organisasi</label>
                        <input class="form-control create update" type="text" placeholder="Tahun Organisasi" id="tahunOrganisasi">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control create update" type="text" placeholder="Alamat Organisasi" id="alamatOrganisasi" style="height: 10em"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Cabang Olahraga</label>
                        <select class="form-control create update" placeholder="Cabang Olahraga" id="cabOlahraga">
                            <option>Pilih Cabang Olahraga</option>
                            @foreach ($cabangOlahraga as $row)
                                <option value="{{ $row->id }}">{{ $row->name_cab }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="createOrUpdate(this)">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var _typeForm = null;
        var _urlCreateOrUpdate = null;
        var _formCreateOrUpdate = null;

        function showFormTambah() {
            _typeForm = "create";
            $("#formTambah").modal("show");
            $("#idOrganisasi").val("");
            $("#namaOrganisasi").val("");
            $("#tahunOrganisasi").val("");
            $("#alamatOrganisasi").val("");
            $("#cabOlahraga").val("Pilih Cabang Olahraga");
        }

        function showFormUpdate(id, nama_organisasi, tahun_berdiri, alamat, cabang_olahragas_id) {
            _typeForm = "update";
            $("#formTambah").modal("show");
            $("#idOrganisasi").val(id);
            $("#namaOrganisasi").val(nama_organisasi);
            $("#tahunOrganisasi").val(tahun_berdiri);
            $("#alamatOrganisasi").val(alamat);
            $("#cabOlahraga").val(cabang_olahragas_id);
        }

        function createOrUpdate(selector) {
            switch (_typeForm) {
                case "create":
                    _urlCreateOrUpdate = "{{ url('/organisasi/simpan') }}";
                    _formCreateOrUpdate = {
                        _token: '{{ csrf_token() }}',
                        nama_organisasi: $("#namaOrganisasi").val(),
                        tahun_berdiri: $("#tahunOrganisasi").val(),
                        alamat: $("#alamatOrganisasi").val(),
                        cabang_olahragas_id: $("#cabOlahraga").val(),
                    };
                    break;
                case "update":
                    let id = $(".update[name=id]").val();
                    _urlCreateOrUpdate = `{{ url('/organisasi') }}/update`;
                    _formCreateOrUpdate = {
                        _token: '{{ csrf_token() }}',
                        id: $("#idOrganisasi").val(),
                        nama_organisasi: $("#namaOrganisasi").val(),
                        tahun_berdiri: $("#tahunOrganisasi").val(),
                        alamat: $("#alamatOrganisasi").val(),
                        cabang_olahraga_id: $("#cabOlahraga").val(),
                    };
                    break;
            }

            $.ajax({
                type: "post",
                url: _urlCreateOrUpdate,
                data: _formCreateOrUpdate,
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

        function deletedOrganisasi(namaOrganisasi, idOrganisasi) {
            if (confirm(`Apakah anda yakin ingin menghapus ${namaOrganisasi} dari organisasi`)) {
                $.ajax({
                    type: "post",
                    url: "{!! url('/organisasi/deleted') !!}",
                    data: {
                        '_token': '{!! csrf_token() !!}',
                        id: idOrganisasi,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.statusCode == "00") {
                            alert("Berhasil Menghapus Data");
                            location.reload();
                        } else {
                            try {
                                alert(response[0][0]);
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
