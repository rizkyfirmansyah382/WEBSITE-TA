<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\DaftarAnggotaBaruModels;
use App\Models\DataAnggotaLamaModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VerifikasiAnggotaBaruControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id;
        $anggotabaru = DaftarAnggotaBaruModels::select('tb_daftar_anggota_baru.*', 'tb_kelompok.nama_kelompok', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_kelompok', 'tb_daftar_anggota_baru.id_kelompok', '=', 'tb_kelompok.id_kelompok')
            ->join('tb_anggota_tervalidasi', 'tb_daftar_anggota_baru.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('tb_daftar_anggota_baru.id_superadmin', $adminId)
            ->orderBy('tb_daftar_anggota_baru.id_daftar_anggota_baru', 'desc')
            ->get();
        return view('admin.dataanggota.verifikasianggotabaru.index', compact('anggotabaru'));
    }

    function verifikasi($id_anggota_tervalidasi, $id_daftar_anggota_baru)
    {
        return view('admin.dataanggota.verifikasianggotabaru.verifikasi', compact('id_anggota_tervalidasi', 'id_daftar_anggota_baru'));
    }

    function verifikasiData(Request $request, $id_anggota_tervalidasi, $id_daftar_anggota_baru)
    {
        $tanggalkeluarmasuk = $request->input('tanggalkeluarmasuk');
        $no_anggota = $request->input('no_anggota');

        DB::beginTransaction();

        try {
            $adminId = Auth::user()->id;
            // Proses dataAnggotaLama terlebih dahulu
            $dataAnggotaLama = AnggotaTervalidasiAdminModels::find($id_anggota_tervalidasi);
            DataAnggotaLamaModels::create([
                'id_blok' => $dataAnggotaLama->id_blok,
                'id_kelompok' => $dataAnggotaLama->id_kelompok,
                'id_anggota_lama' => $dataAnggotaLama->id_anggota_tervalidasi,
                'photo' => $dataAnggotaLama->photo,
                'nama_anggota_lama' => $dataAnggotaLama->nama_anggota,
                'nik' => $dataAnggotaLama->nik,
                'alamat' => $dataAnggotaLama->alamat_tinggal,
                'pekerjaan' => $dataAnggotaLama->pekerjaan,
                'tanggal_lahir' => $dataAnggotaLama->tgl_lahir,
                'jenis_kelamin' => $dataAnggotaLama->jenis_kelamin,
                'no_anggota' => $dataAnggotaLama->no_anggota,
                'tanggal_keluar' => $tanggalkeluarmasuk,
                'id_superadmin' => $adminId,
            ]);

            // Gunakan findOrFail untuk memastikan dataAnggotaBaru ditemukan
            $dataAnggotaBaru = DaftarAnggotaBaruModels::findOrFail($id_daftar_anggota_baru);

            // Periksa apakah $dataAnggotaBaru bukan null sebelum mengakses propertinya
            if ($dataAnggotaBaru) {
                $anggotaTervalidasi = AnggotaTervalidasiAdminModels::find($id_anggota_tervalidasi);

                // Perbarui atribut menggunakan instance model
                $anggotaTervalidasi->update([
                    'photo' => $dataAnggotaBaru->photo,
                    'nama_anggota' => $dataAnggotaBaru->nama_anggota_baru,
                    'nik' => $dataAnggotaBaru->nik,
                    'alamat' => $dataAnggotaBaru->alamat,
                    'pekerjaan' => $dataAnggotaBaru->pekerjaan,
                    'jenis_kelamin' => $dataAnggotaBaru->jenis_kelamin,
                    'tgl_lahir' => $dataAnggotaBaru->tanggal_lahir,
                    'tgl_masuk_anggota' => $tanggalkeluarmasuk,
                    'no_anggota' => $no_anggota,
                ]);

                // Perbarui status menggunakan where
                DaftarAnggotaBaruModels::where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
                    ->update([
                        'status' => 'Selesai Verifikasi',
                    ]);

                DB::commit();
                // dd(\DB::getQueryLog());

                return redirect("/verifikasi-anggota-baru")->with('success', 'Anggota berhasil diverifikasi');
            } else {
                // Handle the case where $dataAnggotaBaru is null
                throw new ModelNotFoundException('Data Anggota Baru not found');
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            return redirect("/verifikasi-anggota-baru")->with('error', 'Data tidak ditemukan: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect("/verifikasi-anggota-baru")->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // function verifikasiData(Request $request, $id_anggota_tervalidasi)
    // {

    //     $tanggalkeluarmasuk = $request->input('tanggalkeluarmasuk');
    //     $no_anggota = $request->input('no_anggota');

    //     DB::beginTransaction();

    //     try {
    //         // Proses dataAnggotaLama terlebih dahulu
    //         $dataAnggotaLama = AnggotaTervalidasiAdminModels::find($id_anggota_tervalidasi);
    //         DataAnggotaLamaModels::create([
    //             'id_blok' => $dataAnggotaLama->id_blok,
    //             'id_kelompok' => $dataAnggotaLama->id_kelompok,
    //             'id_anggota_lama' => $dataAnggotaLama->id_anggota_tervalidasi,
    //             'photo' => $dataAnggotaLama->photo,
    //             'nama_anggota_lama' => $dataAnggotaLama->nama_anggota,
    //             'nik' => $dataAnggotaLama->nik,
    //             'alamat' => $dataAnggotaLama->alamat_tinggal,
    //             'pekerjaan' => $dataAnggotaLama->pekerjaan,
    //             'tanggal_lahir' => $dataAnggotaLama->tgl_lahir,
    //             'jenis_kelamin' => $dataAnggotaLama->jenis_kelamin,
    //             'no_anggota' => $dataAnggotaLama->no_anggota,
    //             'tanggal_keluar' => $tanggalkeluarmasuk,
    //         ]);

    //         $dataAnggotaBaru = DaftarAnggotaBaruModels::find($id_anggota_tervalidasi);
    //         AnggotaTervalidasiAdminModels::update([
    //             'nama_anggota' => $dataAnggotaBaru->nama_anggota_baru,
    //             'nik' => $dataAnggotaBaru->nik,
    //             'alamat' => $dataAnggotaBaru->alamat,
    //             'pekerjaan' => $dataAnggotaBaru->pekerjaan,
    //             'jenis_kelamin' => $dataAnggotaBaru->jenis_kelamin,
    //             'tgl_lahir' => $dataAnggotaBaru->tanggal_lahir,
    //             'tgl_masuk_anggota' => $tanggalkeluarmasuk,
    //             'no_anggota' => $no_anggota,
    //         ]);


    //         DaftarAnggotaBaruModels::where('id_anggota_tervalidasi', $id_anggota_tervalidasi)
    //             ->update([
    //                 'status' => 'Selesai Verifikasi',
    //             ]);

    //         DB::commit();
    //         dd(\DB::getQueryLog());

    //         return redirect("/verifikasi-anggota-baru")->with('success', 'Anggota berhasil diverifikasi');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return redirect("/verifikasi-anggota-baru")->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }
}
