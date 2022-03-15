@extends('layout')
@section('title')
    <button class="btn btn-primary" id="tambah">Tambah Member</button>
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
                    <select class="form-control" id="member_id">
                        <option>Pilih Member</option>
                        @foreach ($member as $row)
                            <option value="{{ $row->member_id }}">{{ $row->member_name }}</option>
                        @endforeach
                    </select><br>
                    <input class="form-control" type="text" placeholder="No Telp" id="telp"><br>
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
                url: "{!! url('/list-member') !!}/{!! $teamId !!}/simpan",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    member_id: $("#member_id").val(),
                    team_member_phone: $("#telp").val(),
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
