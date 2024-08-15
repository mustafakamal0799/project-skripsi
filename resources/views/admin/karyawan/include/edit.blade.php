<!-- Modal -->
<div class="modal fade" id="editKaryawan{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/karyawan-edit/{{$data->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="nama" value="{{$data->nama}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                                    <select name="position_id" id="position_id" class="form-control" required>
                                        <option value="{{$data->position->id}}">{{$data->position->name}}</option>
                                        @foreach ($positions as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" value="{{$data->tanggal_lahir}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="{{$data->jenis_kelamin}}">
                                            @if ($data->jenis_kelamin == 'L')
                                                Laki - Laki
                                            @else
                                                Perempuan
                                            @endif
                                        </option>
                                        @if ($data->jenis_kelamin == 'L')
                                            <option value="P">Perempuan</option>
                                        @else
                                            <option value="L">Laki - Laki</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="email" value="{{$data->email}}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto">
                                    @if ($data->foto)
                                        <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Karyawan" class="img-thumbnail mt-2" style="width: 100px;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat">{{$data->alamat}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="hp" value="{{$data->hp}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>