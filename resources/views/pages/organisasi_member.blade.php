@extends('layout')
@section('title')
    <button class="btn btn-primary" onclick="showFormTambah()">Tambah Member</button>
@endsection

@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">No Handphone</th>
                <th class="text-center">Tinggi</th>
                <th class="text-center">Berat</th>
                <th class="text-center">Posisi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($organisasiMember as $row)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $row->nama }}</td>
                    <td class="text-center">{{ $row->no_phone }}</td>
                    <td class="text-center">{{ $row->tinggi }}</td>
                    <td class="text-center">{{ $row->berat }}</td>
                    <td class="text-center">{{ $row->posisi }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-primary" onclick="showFormUpdate(
                                                    '{{ $row->id }}',
                                                    '{{ $row->nama }}',
                                                    '{{ $row->tinggi }}',
                                                    '{{ $row->berat }}',
                                                    '{{ $row->no_phone }}',
                                                    '{{ $row->posisi }}'
                                                )">Update
                            </button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deletedMember('{{ $row->nama }}','{{ $row->id }}')">Deleted
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
                    <h5 class="modal-title">Tambah Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="hidden" id="idAnggota">
                    <div class="form-group">
                        <label for="">Nama Anggota</label>
                        <input class="form-control" type="text" placeholder="Nama Anggota" id="namaAnggota">
                    </div>
                    <div class="form-group">
                        <label for="">Tinggi Badan</label>
                        <input class="form-control" type="text" placeholder="Tinggi Badan" id="tinggiBadan">
                    </div>
                    <div class="form-group">
                        <label for="">Berat Badan</label>
                        <input class="form-control" type="text" placeholder="Berat Badan" id="beratBadan">
                    </div>
                    <div class="form-group">
                        <label for="">No Phone</label>
                        <input class="form-control" type="text" placeholder="No Phone" id="noPhone">
                    </div>
                    <div class="form-group">
                        <label for="">Posisi Anggota</label>
                        <select class="form-control" id="posisiAnggota">
                            <option value="">Pilih Posisi</option>
                            <option value="Anggota">Anggota</option>
                            <option value="Ketua">Ketua</option>
                            <option value="Staf">Staf</option>
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
            $("#namaAnggota").val("");
            $("#tinggiBadan").val("");
            $("#beratBadan").val("");
            $("#noPhone").val("");
            $("#posisiAnggota").val("");
        }

        function showFormUpdate(idAnggota, namaAnggota, tinggiBadan, beratBadan, noPhone, posisiAnggota) {
            _typeForm = "update";
            $("#formTambah").modal("show");
            $("#idAnggota").val(idAnggota);
            $("#namaAnggota").val(namaAnggota);
            $("#tinggiBadan").val(tinggiBadan);
            $("#beratBadan").val(beratBadan);
            $("#noPhone").val(noPhone);
            $("#posisiAnggota").val(posisiAnggota);
        }



        function createOrUpdate(selector) {
            switch (_typeForm) {
                case "create":
                    _urlCreateOrUpdate = "{{ url('/member/simpan') }}";
                    _formCreateOrUpdate = {
                        _token: '{{ csrf_token() }}',
                        nama: $("#namaAnggota").val(),
                        tinggi: $("#tinggiBadan").val(),
                        berat: $("#beratBadan").val(),
                        no_phone: $("#noPhone").val(),
                        organisasi_id: '{!! $idOrganisasi !!}',
                        posisi: $("#posisiAnggota").val(),
                    };
                    break;
                case "update":
                    let id = $(".update[name=id]").val();
                    _urlCreateOrUpdate = `{{ url('/member/update') }}`;
                    _formCreateOrUpdate = {
                        _token: '{{ csrf_token() }}',
                        id: $("#idAnggota").val(),
                        nama: $("#namaAnggota").val(),
                        tinggi: $("#tinggiBadan").val(),
                        berat: $("#beratBadan").val(),
                        no_phone: $("#noPhone").val(),
                        organisasi_id: '{!! $idOrganisasi !!}',
                        posisi: $("#posisiAnggota").val(),
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

        function deletedMember(namaMember, idMember) {
            if (confirm(`Apakah anda yakin ingin menghapus ${namaMember} dari organisasi`)) {
                $.ajax({
                    type: "post",
                    url: "{!! url('/member/deleted') !!}",
                    data: {
                        '_token': '{!! csrf_token() !!}',
                        id: idMember,
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
