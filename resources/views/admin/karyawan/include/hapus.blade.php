<!-- Modal -->
<div class="modal fade" id="deleteKaryawan{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <h5 class="modal-title" id="delete{{$data->id}}">Peringatan !!!</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <center>
                <div class="mb-4">
                    <i class="fa-solid fa-circle-exclamation" style="font-size: 100px"></i>
                </div>
                <h6>Apakah kamu yakin ingin menghapus data ini?</h6>
            </center>
        </div>
        <div class="modal-footer">
            <form action="/karyawan-delete/{{$data->id}}" method="POST">
                @csrf
                @method ('DELETE')
                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </form>
        </div>
    </div>
    </div>
</div>