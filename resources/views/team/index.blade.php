@extends('layout')
@section('title')
    <button class="btn btn-primary" id="tambah">Tambah Team</button>
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
                    <td class="text-center">{{ $row->team_name ?? "" }}</td>
                    <td class="text-center">{{ $row->toOrganisasi->organisasi_name ?? "" }}</td>
                    <td class="text-center">
                        <span>
                            <a href="{{ url("/list-member/") }}/{{ $row->team_id }}" type="button" class="btn btn-primary" onclick="">Member</a>
                        </span>
                        <span>
                            <button type="button" class="btn btn-primary" onclick="update()">Update</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deleted()">Deleted</button>
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
                    <input class="form-control" type="text" placeholder="Nama Team" id="nama"><br>
                    <select class="form-control" id="organisasi_id">
                        <option>Pilih Organisasi</option>
                        @foreach ($organisasi as $row)
                            <option value="{{ $row->organisasi_id }}">{{ $row->organisasi_name }}</option>
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
                url: "{!! url('/team/simpan') !!}",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    organisasi_id: $("#organisasi_id").val(),
                    team_name: $("#nama").val(),
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
                            alert(response[0][0]);
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
    </script>
@endsection
