@extends('layout')
@section('title')
    <button class="btn btn-primary" id="tambah">Tambah Member</button>
@endsection

@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Tinggi</th>
                <th class="text-center">Berat</th>
                <th class="text-center">Posisi</th>
                <th class="text-center">Cabang Olahraga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($member as $row)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $row->member_name ?? '' }}</td>
                    <td class="text-center">{{ $row->member_height ?? '' }}</td>
                    <td class="text-center">{{ $row->member_weight ?? '' }}</td>
                    <td class="text-center">{{ $row->member_position ?? '' }}</td>
                    <td class="text-center">{{ $row->toCabangOlahraga->cab_olahraga_name }}</td>
                    <td class="text-center">

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
                    <h5 class="modal-title">Tambah Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" placeholder="Nama" id="nama"><br>
                    <input class="form-control" type="text" placeholder="Tinggi" id="tinggi"><br>
                    <input class="form-control" type="text" placeholder="Berat" id="berat"><br>
                    <input class="form-control" type="text" placeholder="Posisi" id="posisi"><br>
                    <select class="form-control" id="cab_olahraga_id">
                        <option>Pilih Cabang Olahraga</option>
                        @foreach ($cabOlahraga as $row)
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
                url: "{!! url('/member/simpan') !!}",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    member_name: $("#nama").val(),
                    member_height: $("#tinggi").val(),
                    member_weight: $("#berat").val(),
                    member_position: $("#posisi").val(),
                    cab_olahraga_id: $("#cab_olahraga_id").val(),
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
