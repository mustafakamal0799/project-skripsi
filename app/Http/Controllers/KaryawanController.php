<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index () 
    {
        $karyawan = Karyawan::with('position')->paginate(10);
        $positions = Position::select('id', 'name')->get();
        
        return view('admin.karyawan.index', compact('karyawan','positions'));
    }

    public function create () 
    {        
        return view('admin.karyawan.create');
    }

    public function store(Request $request) 
    {
        $karyawan = new Karyawan();
        $karyawan->nama = $request->input('nama');
        $karyawan->position_id = $request->input('position_id');
        $karyawan->tanggal_lahir = $request->input('tanggal_lahir');
        $karyawan->jenis_kelamin = $request->input('jenis_kelamin');
        $karyawan->email = $request->input('email');

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public', $filename);

            $karyawan->foto = $path;
        }

        $karyawan->alamat = $request->input('alamat');
        $karyawan->hp = $request->input('hp');
        
        $karyawan->save();

        if ($request->create_user_account) {
            $user = new User();
            $user->name = $request->input('nama');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->position_id = $request->input('position_id');
            $user->save();

            $karyawan->user_id = $user->id;
            $karyawan->save();
        }

        return redirect('/karyawan')->with('success', 'Data Berhasil Disimpan');
    }

    public function detail($id) 
    {
        $karyawans = Karyawan::with('position')->findOrFail($id);

        return view('admin.karyawan.detail', compact('karyawans'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->nama = $request->input('nama');
        $karyawan->position_id = $request->input('position_id');
        $karyawan->tanggal_lahir = $request->input('tanggal_lahir');
        $karyawan->jenis_kelamin = $request->input('jenis_kelamin');
        $karyawan->email = $request->input('email');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto && Storage::exists($karyawan->foto)) {
                Storage::delete($karyawan->foto);
            }
            $karyawan->foto = $request->file('foto')->store('public');
        }

        $karyawan->alamat = $request->input('alamat');
        $karyawan->hp = $request->input('hp');
        
        $karyawan->update();

        return redirect('/karyawan')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id) 
    {
        $karyawan = Karyawan::findOrFail($id);

        // Hapus file foto dari storage
        if ($karyawan->foto && Storage::exists($karyawan->foto)) {
            Storage::delete($karyawan->foto);
        }
        
        $karyawan->delete();

        return redirect('/karyawan')->with('success', 'Data Berhasil Dihapus');
    }

    public function cetakKaryawan () 
    {
        $karyawan = Karyawan::with('position')->where('position_id', 2)->get();
        $positions = Position::select('id', 'name')->get();
        
        return view('admin.karyawan.cetak-karyawan', compact('karyawan','positions'));
    }
}
