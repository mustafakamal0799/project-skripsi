@extends('template.layout')

@section('title','Karyawan')

@section('content')

<style>
    .card-body{
        padding: 20px;
    }
    .title {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .image {
        margin-top: 20px;
        margin-left: 50px;
        width: 250px;
        height: 350px;
        box-shadow: 5px 5px 10px rgb(0, 0, 0, 0.5);
    }
    .image img {
        width: 250px;
        height: 350px;
        display: block;
        border-radius: 10px;
        
    }
</style>

<div class="card">
    <div class="card-header">
        <h4>Detail Karyawan</h4>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="row mb-2">
                        <div class="title">
                            <h1>{{$karyawans->nama}}</h1>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <label for="nama" class="form-label col-3"><h4>Jenis Kelamin </h4></label> :
                        <div class="col-8">
                            <h4>
                                @if ($karyawans->jenis_kelamin == 'L')
                                    Laki - laki
                                @else
                                    Perempuan
                                @endif
                            </h4>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="form-label col-3"><h4>Tanggal Lahir</h4></label> :
                        <div class="col-8">
                            <div class="input-group">
                                <h4>{{$karyawans->tanggal_lahir}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="form-label col-3"><h4>Email</h4></label> :
                        <div class="col-8">
                            <div class="input-group">
                                <h4>{{$karyawans->email}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="form-label col-3"><h4>No. Handphone</h4></label> :
                        <div class="col-8">
                            <div class="input-group">
                                <h4>{{$karyawans->hp}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="form-label col-3"><h4>Alamat</h4></label> :
                        <div class="col-8">
                            <div class="input-group">
                                <h4>{{$karyawans->alamat}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="form-label col-3"><h4>Jabatan</h4></label> :
                        <div class="col-8">
                            <div class="input-group">
                                <h4>{{$karyawans->position->name}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="image">
                        @if ($karyawans->foto)
                        <img src="{{asset('storage/' . $karyawans->foto)}}" alt="" style="overflow: hidden;">
                        @else
                        <img src="{{asset('image/011.jpeg')}}" alt="">    
                        @endif
                    </div>
                </div>
                <div>
                    <a href="/karyawan" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection