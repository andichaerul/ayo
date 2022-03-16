@extends('layout')
@section('title')
    <button class="btn btn-primary" onclick="showFormTambah()">Tambah Team</button>
@endsection
@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Team</th>
                <th class="text-center">Organisasi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($team as $row)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $row->nama_team }}</td>
                    <td class="text-center">{{ $row->organisasi->nama_organisasi }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-primary" onclick="showFormUpdate(
                                                            '{{ $row->id }}',
                                                            '{{ $row->nama_team }}',
                                                            '{{ $row->organisasi_id }}',
                                                        )">Update</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deletedTeam(
                                        '{{ $row->nama_team }}',
                                        '{{ $row->id }}'
                                    )">Deleted</button>
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

                    <input class="form-control" type="hidden" placeholder="Nama Team" id="idTeam">
                    <div class="form-group">
                        <label for="">Nama Team</label>
                        <input class="form-control" type="text" placeholder="Nama Team" id="namaTeam">
                    </div>
                    <div class="form-group">
                        <label for="">Organisasi Team</label>
                        <select class="form-control" id="idOrganisasi">
                            <option>Pilih Organisasi</option>
                            @foreach ($organisasi as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_organisasi }}</option>
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
        var _url = null;
        var _formData = null;

        function showFormTambah() {
            _typeForm = "create";
            $("#formTambah").modal("show");
        }

        function showFormUpdate(idTeam, namaTeam, idOrganisasi) {
            _typeForm = "update";
            $("#idTeam").val(idTeam);
            $("#namaTeam").val(namaTeam);
            $("#idOrganisasi").val(idOrganisasi);
            $("#formTambah").modal("show");
        }

        function createOrUpdate(selector) {
            switch (_typeForm) {
                case "create":
                    _url = "{{ url('/team/simpan') }}";
                    _formData = {
                        _token: '{{ csrf_token() }}',
                        nama_team: $("#namaTeam").val(),
                        organisasi_id: $("#idOrganisasi").val()
                    }
                    break;
                case "update":
                    _url = "{{ url('/team/update') }}";
                    _formData = {
                        _token: '{{ csrf_token() }}',
                        id: $("#idTeam").val(),
                        nama_team: $("#namaTeam").val(),
                        organisasi_id: $("#idOrganisasi").val()
                    }
                    break;
            }
            $.ajax({
                type: "post",
                url: _url,
                data: _formData,
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

        function deletedTeam(namaTeam, idTeam) {
            if (confirm(`Apakah anda yakin ingin menghapus ${namaTeam} dari team`)) {
                $.ajax({
                    type: "post",
                    url: "{!! url('/team/deleted') !!}",
                    data: {
                        '_token': '{!! csrf_token() !!}',
                        id: idTeam,
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
