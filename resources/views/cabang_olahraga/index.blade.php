@extends('layout')
@section('title')
    <button class="btn btn-primary" id="tambah">Tambah Cabang Olahraga</button>
@endsection
@section('body')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Cabang</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cabOlahraga as $row)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $row->cab_olahraga_name }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-primary" onclick="update('{{ $row->cab_olahraga_name }}','{{ $row->cab_olahraga_id }}')">Update</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deleted('{{ $row->cab_olahraga_name }}','{{ $row->cab_olahraga_id }}')">Deleted</button>
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
                    <h5 class="modal-title">Tambah Cabang Olahraga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" placeholder="Nama Cabang Olahraga" id="cab_olahraga_name">
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
                    <h5 class="modal-title">Update Cabang Olahraga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="hidden" placeholder="Nama Cabang Olahraga" id="update_cab_olahraga_id">
                    <input class="form-control" type="text" placeholder="Nama Cabang Olahraga" id="update_cab_olahraga_name">
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
                url: "{!! url('/cabang-olahraga/simpan') !!}",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    cab_olahraga_name: $("#cab_olahraga_name").val(),
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

        function update(nama, id) {
            $("#formUpdate").modal("show");
            $("#update_cab_olahraga_name").val(nama);
            $("#update_cab_olahraga_id").val(id);
        }

        function setUpdate() {
            $.ajax({
                type: "post",
                url: "{!! url('/cabang-olahraga/update') !!}",
                data: {
                    '_token': '{!! csrf_token() !!}',
                    cab_olahraga_id: $("#update_cab_olahraga_id").val(),
                    cab_olahraga_name: $("#update_cab_olahraga_name").val(),
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
            if (confirm(`Apakah anda yakin ingin menghapus ${nama} dari cabang olahraga`)) {
                $.ajax({
                    type: "post",
                    url: "{!! url('/cabang-olahraga/deleted') !!}",
                    data: {
                        '_token': '{!! csrf_token() !!}',
                        cab_olahraga_id: id,
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
