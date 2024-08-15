<!-- Modal -->
<div class="modal fade" id="addKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/karyawan-add" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <!-- Nama Karyawan -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <!-- Jabatan -->
                                <div class="mb-3">
                                    <label for="position_id" class="form-label">Jabatan</label>
                                    <select class="form-select" id="position_id" name="position_id" required>
                                        <option selected disabled>-- Pilih Jabatan --</option>
                                        @foreach ($positions as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <!-- Foto -->
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" rows="3" name="alamat" required></textarea>
                                </div>

                                <!-- No Handphone -->
                                <div class="mb-3">
                                    <label for="hp" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control" id="hp" name="hp" required>
                                </div>                                
                            </div>
                            
                            <!-- Checkbox Buat Akun User -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="createUserAccount" name="create_user_account">
                                <label class="form-check-label" for="createUserAccount">Buat akun user</label>
                            </div>
                            
                            <!-- Fields untuk User Account -->
                            <div class="mb-3" id="userFields" style="display:none;">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                                <label for="password" class="form-label mt-3">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('createUserAccount').addEventListener('change', function () {
        var userFields = document.getElementById('userFields');
        if (this.checked) {
            userFields.style.display = 'block';
        } else {
            userFields.style.display = 'none';
        }
    });
</script>
