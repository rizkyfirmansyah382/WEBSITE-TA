<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\BlokAdminModels;
use App\Models\KelompokAdminModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AnggotaTervalidasiAdminControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id;
        $anggotaterValidasi = AnggotaTervalidasiAdminModels::select('tb_anggota_tervalidasi.*', 'tb_kelompok.nama_kelompok', 'tb_blok.blok')
            ->join('tb_kelompok', 'tb_anggota_tervalidasi.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_blok', 'tb_anggota_tervalidasi.id_blok', '=', 'tb_blok.id_blok')
            ->where('tb_anggota_tervalidasi.id_superadmin', $adminId)
            ->get();
        return view('admin.dataanggota.anggotatervalidasi.index', compact('anggotaterValidasi'));
    }

    function create()
    {
        $AdminId = Auth::user()->id;
        $blok = BlokAdminModels::where('id_superadmin', $AdminId)->get();
        $kelompok = KelompokAdminModels::where('id_superadmin', $AdminId)->get();
        return view('admin.dataanggota.anggotatervalidasi.create', compact('blok', 'kelompok'));
    }

    function createData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kelompok' => 'required',
            'id_blok' => 'required',
            'nama_anggota' => 'required',
            'pekerjaan' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {
            return redirect('/anggota-tervalidasi')->with('success', 'Data Gagal Disimpan');
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;
            $photo->move(public_path('photos'), $photoName);
        }


        $AdminId = Auth::user()->id;
        AnggotaTervalidasiAdminModels::create([
            'id_superadmin' => $AdminId,
            'id_kelompok' => $request->input('id_kelompok'),
            'id_blok' => $request->input('id_blok'),
            'nama_anggota' => $request->input('nama_anggota'),
            'luas_lahan' => $request->input('luas_lahan'),
            'nik' => $request->input('nik'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'pekerjaan' => $request->input('pekerjaan'),
            'alamat_tinggal' => $request->input('alamat_tinggal'),
            'tgl_masuk_anggota' => $request->input('tgl_masuk_anggota'),
            'no_anggota' => $request->input('no_anggota'),
            'photo' => $photoPath,
        ]);
        return redirect('/anggota-tervalidasi')->with('success', 'Anggota tervalidasi berhasil ditambahkan.');
    }
    public function checkNoAnggota(Request $request)
    {
        $no_anggota = $request->input('no_anggota');
        $userId = $request->input('userId');

        $isUnique = AnggotaTervalidasiAdminModels::where('no_anggota', $no_anggota)
            ->where('id_anggota_tervalidasi', '!=', $userId) // Hindari memeriksa keunikan username untuk pengguna dengan ID yang sedang diupdate
            ->doesntExist();

        return response()->json(['isUnique' => $isUnique]);
    }

    function update($id_anggota_tervalidasi)
    {
        $anggota = AnggotaTervalidasiAdminModels::find($id_anggota_tervalidasi);
        $kelompok = KelompokAdminModels::all();
        $blok = BlokAdminModels::all();
        return view('admin.dataanggota.anggotatervalidasi.update', compact('anggota', 'blok', 'kelompok'));
    }

    function updateData(Request $request, $id_anggota_tervalidasi)
    {
        $validator = Validator::make($request->all(), [
            'id_kelompok' => 'required',
            'id_blok' => 'required',
            'nama_anggota' => 'required',
            'pekerjaan' => 'required',
            // 'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('/anggota-tervalidasi')->with('success', 'Data Gagal Disimpan');
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;
            $photo->move(public_path('photos'), $photoName);
        }

        $anggota = AnggotaTervalidasiAdminModels::find($id_anggota_tervalidasi);
        $anggota->id_kelompok = $request->input('id_kelompok');
        $anggota->id_blok = $request->input('id_blok');
        $anggota->nama_anggota = $request->input('nama_anggota');
        $anggota->luas_lahan = $request->input('luas_lahan');
        $anggota->nik = $request->input('nik');
        $anggota->tgl_lahir = $request->input('tgl_lahir');
        $anggota->jenis_kelamin = $request->input('jenis_kelamin');
        $anggota->pekerjaan = $request->input('pekerjaan');
        $anggota->alamat_tinggal = $request->input('alamat_tinggal');
        $anggota->tgl_masuk_anggota = $request->input('tgl_masuk_anggota');
        $anggota->no_anggota = $request->input('no_anggota');

        if ($photoPath) {
            $anggota->photo = $photoPath;
        }

        $anggota->save();

        return redirect("/anggota-tervalidasi")->with('success', 'Anggota tervalidasi berhasil diperbarui.');
    }


    function delete(Request $request, $id_anggota_tervalidasi)
    {
        $anggota = AnggotaTervalidasiAdminModels::find($id_anggota_tervalidasi);
        $anggota->delete();
        return redirect("/anggota-tervalidasi")->with('success', 'Anggota tervalidasi berhasil dihapus.');
    }
}
