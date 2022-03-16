@extends('layout')
@section('title')
    <button class="btn btn-primary" id="tambah">Tambah Jadwal Acara</button>
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
                    <select class="form-control" placeholder="Prioritas Acara" id="organisasi">
                        <option>Pilih Organisasi</option>
                        @foreach ($organisasi as $row)
                            <option value="{{ $row->organisasi_id }}">{{ $row->organisasi_name }}</option>
                        @endforeach
                    </select><br>
                    <input class="form-control" type="text" placeholder="Nama Acara" id="nama"><br>
                    <input class="form-control" type="date" placeholder="Waktu Acara" id="waktu"><br>
                    <textarea rows="10" class="form-control" id="descAcara" placeholder="Deskripsi Acara"></textarea><br>
                    <select class="form-control" placeholder="Prioritas Acara" id="prioritas">
                        <option>Wajib</option>
                        <option>Tidak Wajib</option>
                        <option>Hanya Staf</option>
                    </select><br>
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
    </script>
@endsection
