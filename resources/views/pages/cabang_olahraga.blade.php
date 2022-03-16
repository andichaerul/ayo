@extends('layout')
@section('title')
    <button class="btn btn-primary" onclick="showFormTambah()">Tambah Cabang Olahraga</button>
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
                    <td class="text-center">{{ $row->name_cab }}</td>
                    <td class="text-center">
                        <span>
                            <button type="button" class="btn btn-primary" onclick="showFormUpdate('{{ $row->name_cab }}','{{ $row->id }}')">Update</button>
                        </span>
                        <span>
                            <button type="button" class="btn btn-danger" onclick="deleted('{{ $row->name_cab }}','{{ $row->id }}')">Deleted</button>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('modal')
    {{-- Modal Add New --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="form">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Cabang Olahraga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="create update" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" class="update" name="id" id="id">
                    <input class="form-control create update" name="name_cab" type="text" placeholder="Nama Cabang Olahraga" id="name_cab">
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
        class CabangOlahraga {
            constructor(typeForm) {
                this.typeForm = null;
                this.ajax = {
                    url: null,
                    form: null
                }
            }
        }
        var cabangOlahraga = new CabangOlahraga();

        function showFormTambah() {
            cabangOlahraga.typeForm = "create";
            $("#form").modal("show");
            resetForm();
        }

        function showFormUpdate(namaCab, idCab) {
            cabangOlahraga.typeForm = "update";
            $('#name_cab').val(namaCab);
            $("#id").val(idCab);
            $("#form").modal("show");
        }

        function resetForm() {
            $('#name_cab').val("");
            $("#id").val("");
        }

        function deleted(nama, id) {
            if (confirm(`Apakah anda yakin ingin menghapus ${nama} dari cabang olahraga`)) {
                $.ajax({
                    type: "post",
                    url: `{!! url('/cabang-olahraga/deleted') !!}/${id}`,
                    data: {
                        '_token': '{!! csrf_token() !!}'
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

        function createOrUpdate(selector) {
            switch (cabangOlahraga.typeForm) {
                case 'create':
                    cabangOlahraga.ajax.url = "{{ url('/cabang-olahraga/simpan') }}";
                    cabangOlahraga.ajax.form = $(".create").serialize();
                    break;
                case 'update':
                    let idCab = $("#id").val();
                    cabangOlahraga.ajax.url = `{{ url('/cabang-olahraga/') }}/${idCab}/update`;
                    cabangOlahraga.ajax.form = $(".update").serialize();
                    break;
            }
            $.ajax({
                type: "post",
                url: cabangOlahraga.ajax.url,
                data: cabangOlahraga.ajax.form,
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
                    for (const key in response.responseJSON.errors) {
                        alert(response.responseJSON.errors[key][0]);
                    }
                    $(selector).removeClass("btn-progress disable");
                    $(selector).prop('disabled', false);
                }
            });
        }
    </script>
@endsection
