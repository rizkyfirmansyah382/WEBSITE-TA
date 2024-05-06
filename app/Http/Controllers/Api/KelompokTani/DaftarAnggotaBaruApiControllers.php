<?php

namespace App\Http\Controllers\Api\KelompokTani;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\DaftarAnggotaBaruModels;
use App\Models\KelompokAdminModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DaftarAnggotaBaruApiControllers extends Controller
{
    public function index($id_superadmin)
    {
        $anggotabaru = DaftarAnggotaBaruModels::select('tb_daftar_anggota_baru.*', 'tb_kelompok.nama_kelompok', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_kelompok', 'tb_daftar_anggota_baru.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_anggota_tervalidasi', 'tb_daftar_anggota_baru.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('tb_daftar_anggota_baru.id_superadmin', $id_superadmin)
            ->orderBy('tb_daftar_anggota_baru.id_daftar_anggota_baru', 'desc')
            ->get();

        return response()->json(['anggotabaru' => $anggotabaru]);
    }

    public function getKelompok($id_superadmin)
    {
        $kelompok = KelompokAdminModels::where('id_superadmin', $id_superadmin)->get();
        return response()->json(['kelompok' => $kelompok]);
    }
    public function getAnggotaLama($id_kelompok)
    {
        $anggota = AnggotaTervalidasiAdminModels::where('id_kelompok', $id_kelompok)->get();
        return response()->json(['anggota' => $anggota]);
    }

    public function createData(Request $request, $id_superadmin)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_superadmin' => 'required',
            'id_kelompok' => 'required',
            'id_anggota_tervalidasi' => 'required',
            'nama_anggota_baru' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'photo' => 'required|max:2048',
            'KkPdf' => 'required|mimes:pdf|max:2048',
            'SertifPdf' => 'required|mimes:pdf|max:2048',
            'JBPdf' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Daftar anggota gagal ditambahkan.'], 400);
        }

        $status = 'Proses Verifikasi';
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

        // Simpan data ke database
        DaftarAnggotaBaruModels::create([
            'id_superadmin' => $id_superadmin,
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

        return response()->json(['success' => 'Daftar anggota berhasil ditambahkan.'], 200);
    }

    public function update($id_daftar_anggota_baru)
    {
        // $tanggal = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $anggotabaru = DaftarAnggotaBaruModels::where('id_daftar_anggota_baru', $id_daftar_anggota_baru)->first();
        return response()->json(['anggotabaru' => $anggotabaru], 200);
    }

    public function updateData(Request $request, $id_daftar_anggota_baru, $id_superadmin)
    {
        // try {
        $status = 'Proses Verifikasi';
        $kkPdfPath = null;
        $sertifPdfPath = null;
        $jbPdfPath = null;

        // Cek dan simpan file foto jika ada
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'photos/' . $photoName;
            $photo->move(public_path('photos'), $photoName);
        }

        // Cek dan simpan file KK jika ada
        if ($request->hasFile('KkPdf')) {
            $kkPdf = $request->file('KkPdf');
            $kkPdfName = time() . '_kk_' . $kkPdf->getClientOriginalName();
            $kkPdfPath = 'daftaranggotaterbaru/' . $kkPdfName;
            $kkPdf->move(public_path('daftaranggotaterbaru'), $kkPdfName);
        }

        // Cek dan simpan file Sertifikat jika ada
        if ($request->hasFile('SertifPdf')) {
            $sertifPdf = $request->file('SertifPdf');
            $sertifPdfName = time() . '_sertif_' . $sertifPdf->getClientOriginalName();
            $sertifPdfPath = 'daftaranggotaterbaru/' . $sertifPdfName;
            $sertifPdf->move(public_path('daftaranggotaterbaru'), $sertifPdfName);
        }

        // Cek dan simpan file JBPdf jika ada
        if ($request->hasFile('JBPdf')) {
            $jbPdf = $request->file('JBPdf');
            $jbPdfName = time() . '_jb_' . $jbPdf->getClientOriginalName();
            $jbPdfPath = 'daftaranggotaterbaru/' . $jbPdfName;
            $jbPdf->move(public_path('daftaranggotaterbaru'), $jbPdfName);
        }

        // Simpan data ke database
        DaftarAnggotaBaruModels::where('id_daftar_anggota_baru', $id_daftar_anggota_baru)
            ->where('id_superadmin', $id_superadmin)
            ->update([
                'id_kelompok' => $request->input('id_kelompok'),
                'id_anggota_tervalidasi' => $request->input('id_anggota_tervalidasi'),
                'nama_anggota_baru' => $request->input('nama_anggota_baru'),
                'nik' => $request->input('nik'),
                'alamat' => $request->input('alamat'),
                'pekerjaan' => $request->input('pekerjaan'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'status' => $status,
                'photo' => $photoPath !== null ? $photoPath : DB::raw('photo'),
                'KkPdf' => $kkPdfPath !== null ? $kkPdfPath : DB::raw('KkPdf'),
                'SertifPdf' => $sertifPdfPath !== null ? $sertifPdfPath : DB::raw('SertifPdf'),
                'JBPdf' => $jbPdfPath !== null ? $jbPdfPath : DB::raw('JBPdf'),
            ]);

        return response()->json(['success' => 'Daftar anggota berhasil diperbarui.'], 200);
    }
    // catch (\Exception $e) {
    //     \Log::error('Error during updateData: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
    //     return response()->json(['error' => 'Terjadi kesalahan saat memperbarui data. ' . $e->getMessage()], 500);
    // }





    function delete($id_daftar_anggota_baru)
    {
        DaftarAnggotaBaruModels::where('id_daftar_anggota_baru', $id_daftar_anggota_baru)
            ->delete();
        return response()->json(['success' => 'Daftar Anggota Baru Berhasil Dihapus.']);
    }
}
