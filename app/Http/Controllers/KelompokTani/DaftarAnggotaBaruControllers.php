<?php

namespace App\Http\Controllers\KelompokTani;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\BlokAdminModels;
use App\Models\DaftarAnggotaBaruModels;
use App\Models\KelompokAdminModels;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class DaftarAnggotaBaruControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id_superadmin;
        $anggotabaru = DaftarAnggotaBaruModels::select('tb_daftar_anggota_baru.*', 'tb_kelompok.nama_kelompok', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_kelompok', 'tb_daftar_anggota_baru.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_anggota_tervalidasi', 'tb_daftar_anggota_baru.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('tb_daftar_anggota_baru.id_superadmin', $adminId)
            ->orderBy('tb_daftar_anggota_baru.id_daftar_anggota_baru', 'desc')
            ->get();
        return view('kelompoktani.daftaranggotabaru.index', compact('anggotabaru'));
    }

    function create()
    {
        $adminId = Auth::user()->id_superadmin;
        $kelompok = KelompokAdminModels::where('id_superadmin', $adminId)->get();
        return view('kelompoktani.daftaranggotabaru.create', compact('kelompok'));
    }

    public function createData(Request $request)
    {

        // dd($request->all());
        $status = 'Proses Verifikasi';
        $adminId = Auth::user()->id_superadmin;

        $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:jpeg,jpg|max:2048', // Maksimum 2 MB
            'KkPdf' => 'required|mimes:pdf|max:2048', // Maksimum 2 MB
            'SertifPdf' => 'required|mimes:pdf|max:2048',
            'JBPdf' => 'required|mimes:pdf|max:2048',
            'id_kelompok' => 'required',
            'id_anggota_tervalidasi' => 'required',
            'nama_anggota_baru' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("/daftar-anggota-baru")->with('error', 'Daftar anggota gagal ditambahkan.');
        }

        $kkPdfPath = null;
        $sertifPdfPath = null;
        $jbPdfPath = null;
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;
            $photo->move(public_path('photos'), $photoName);
        }
        if ($request->hasFile('KkPdf')) {
            $kkPdf = $request->file('KkPdf');
            $kkPdfName = time() . '_kk_' . $kkPdf->getClientOriginalName();
            $kkPdfPath = 'daftaranggotaterbaru/' . $kkPdfName;
            $kkPdf->move(public_path('daftaranggotaterbaru'), $kkPdfName);
        }

        if ($request->hasFile('SertifPdf')) {
            $sertifPdf = $request->file('SertifPdf');
            $sertifPdfName = time() . '_sertif_' . $sertifPdf->getClientOriginalName();
            $sertifPdfPath = 'daftaranggotaterbaru/' . $sertifPdfName;
            $sertifPdf->move(public_path('daftaranggotaterbaru'), $sertifPdfName);
        }

        if ($request->hasFile('JBPdf')) {
            $jbPdf = $request->file('JBPdf');
            $jbPdfName = time() . '_jb_' . $jbPdf->getClientOriginalName();
            $jbPdfPath = 'daftaranggotaterbaru/' . $jbPdfName;
            $jbPdf->move(public_path('daftaranggotaterbaru'), $jbPdfName);
        }

        DaftarAnggotaBaruModels::create([
            'id_superadmin' => $adminId,
            'id_kelompok' => $request->input('id_kelompok'),
            'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
            'nama_anggota_baru' => $request->input('nama_anggota_baru'),
            'nik' => $request->input('nik'),
            'alamat' => $request->input('alamat'),
            'pekerjaan' => $request->input('pekerjaan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'status' => $status,
            'KkPdf' => $kkPdfPath,
            'SertifPdf' => $sertifPdfPath,
            'JBPdf' => $jbPdfPath,
            'photo' => $photoPath,
        ]);

        return redirect('/daftar-anggota-baru')->with('success', 'Daftar anggota berhasil ditambahkan.');
    }
    function update($id_daftar_anggota_baru)
    {
        $adminId = Auth::user()->id_superadmin;
        $kelompok = KelompokAdminModels::where('id_superadmin', $adminId)->get();

        $anggota = DaftarAnggotaBaruModels::find($id_daftar_anggota_baru);

        // dd($anggota);
        return view('kelompoktani.daftaranggotabaru.update', compact('kelompok', 'anggota'));
    }

    public function updateData(Request $request, $id_daftar_anggota_baru)
    {
        // dd($request->all());
        $status = 'Proses Verifikasi';
        $adminId = Auth::user()->id_superadmin;

        $validator = Validator::make($request->all(), [
            'id_kelompok' => 'required',
            'id_anggota_tervalidasi' => 'required',
            'nama_anggota_baru' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect("/daftar-anggota-baru")->with('error', 'Daftar anggota gagal diperbarui.');
        }

        $kkPdfPath = null;
        $sertifPdfPath = null;
        $jbPdfPath = null;
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;
            $photo->move(public_path('photos'), $photoName);
        }

        if ($request->hasFile('KkPdf')) {
            $kkPdf = $request->file('KkPdf');
            $kkPdfName = time() . '_kk_' . $kkPdf->getClientOriginalName();
            $kkPdfPath = 'daftaranggotaterbaru/' . $kkPdfName;
            $kkPdf->move(public_path('daftaranggotaterbaru'), $kkPdfName);
        }

        if ($request->hasFile('SertifPdf')) {
            $sertifPdf = $request->file('SertifPdf');
            $sertifPdfName = time() . '_sertif_' . $sertifPdf->getClientOriginalName();
            $sertifPdfPath = 'daftaranggotaterbaru/' . $sertifPdfName;
            $sertifPdf->move(public_path('daftaranggotaterbaru'), $sertifPdfName);
        }

        if ($request->hasFile('JBPdf')) {
            $jbPdf = $request->file('JBPdf');
            $jbPdfName = time() . '_jb_' . $jbPdf->getClientOriginalName();
            $jbPdfPath = 'daftaranggotaterbaru/' . $jbPdfName;
            $jbPdf->move(public_path('daftaranggotaterbaru'), $jbPdfName);
        }

        $updateData = [
            'id_superadmin' => $adminId,
            'id_kelompok' => $request->input('id_kelompok'),
            'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
            'nama_anggota_baru' => $request->input('nama_anggota_baru'),
            'nik' => $request->input('nik'),
            'alamat' => $request->input('alamat'),
            'pekerjaan' => $request->input('pekerjaan'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'status' => $status,
        ];

        // Hanya mengatur path jika file ada
        if ($kkPdfPath) {
            $updateData['KkPdf'] = $kkPdfPath;
        }
        if ($sertifPdfPath) {
            $updateData['SertifPdf'] = $sertifPdfPath;
        }
        if ($jbPdfPath) {
            $updateData['JBPdf'] = $jbPdfPath;
        }
        if ($photoPath) {
            $updateData['photo'] = $photoPath;
        }

        DaftarAnggotaBaruModels::where('id_daftar_anggota_baru', $id_daftar_anggota_baru)
            ->update($updateData);

        return redirect('/daftar-anggota-baru')->with('success', 'Daftar anggota berhasil diperbarui.');
    }
    public function delete($id_daftar_anggota_baru)
    {
        $anggota = DaftarAnggotaBaruModels::find($id_daftar_anggota_baru);
        $anggota->delete();

        return redirect('/daftar-anggota-baru')->with('success', 'Daftar anggota berhasil dihapus.');
    }


    public function getMembers($id_kelompok)
    {
        $members = AnggotaTervalidasiAdminModels::where('id_kelompok', $id_kelompok)->get(['id_anggota_tervalidasi', 'nama_anggota']);
        return response()->json($members);
    }
}
