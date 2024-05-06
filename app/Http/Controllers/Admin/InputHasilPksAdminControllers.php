<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputHasilPksModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class InputHasilPksAdminControllers extends Controller
{
    public function index($id_data_spb, $id_tanggal_panen)
    {
        $inputhasilpks = InputHasilPksModels::where('id_data_spb', $id_data_spb)->get();

        if ($inputhasilpks->isNotEmpty()) {
            return view('admin.datapanenanggota.hasilpks.checkdatatruck.inputdatatruck.index', compact('inputhasilpks', 'id_data_spb', 'id_tanggal_panen'));
        } else {
            return view("admin.datapanenanggota.hasilpks.checkdatatruck.inputdatatruck.indexawal", compact('id_data_spb', 'id_tanggal_panen'));
        }
    }

    function create($id_data_spb, $id_tanggal_panen)
    {
        return view('admin.datapanenanggota.hasilpks.checkdatatruck.inputdatatruck.create', compact('id_data_spb', 'id_tanggal_panen'));
    }

    function createData(Request $request, $id_data_spb, $id_tanggal_panen)
    {
        $validator = Validator::make($request->all(), [
            'bruto' => 'required|integer',
            'tarra' => 'required|integer',
            'netto_terima' => 'required|integer',
            'sortasi' => 'required|integer',
            'netto_bersih' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect("/input-hasil-pks/{$id_data_spb}/{$id_tanggal_panen}")->with('error', 'Input hasil pks gagal ditamabahkan.');
        }

        $AdminId = Auth::user()->id;
        InputHasilPksModels::create([
            'id_superadmin' => $AdminId,
            'id_data_spb' => $id_data_spb,
            'bruto' => $request->input('bruto'),
            'tarra' => $request->input('tarra'),
            'netto_terima' => $request->input('netto_terima'),
            'sortasi' => $request->input('sortasi'),
            'netto_bersih' => $request->input('netto_bersih'),
        ]);
        return redirect("/input-hasil-pks/{$id_data_spb}/{$id_tanggal_panen}")->with('success', 'Input hasil pks berhasil ditambahkan.');
    }

    function update($id_data_spb, $id_tanggal_panen)
    {
        $inputhasilpks = InputHasilPksModels::where('tb_input_hasil_pks.id_data_spb', $id_data_spb)->first();
        return view('admin.datapanenanggota.hasilpks.checkdatatruck.inputdatatruck.update', compact('inputhasilpks', 'id_data_spb', 'id_tanggal_panen'));
        //     return view('admin.datapanenanggota.hasilpks.checkdatatruck.inputdatatruck.update', [
        //         'inputhasilpks' => $inputhasilpks,
        //         'id_data_spb' => $id_data_spb,
        //         'id_tanggal_panen' => $id_tanggal_panen,
        //     ]);
    }

    function updateData(Request $request, $id_data_spb, $id_tanggal_panen)
    {
        $validator = Validator::make($request->all(), [
            'bruto' => 'required|integer',
            'tarra' => 'required|integer',
            'netto_terima' => 'required|integer',
            'sortasi' => 'required|integer',
            'netto_bersih' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect("/input-hasil-pks/{$id_data_spb}/{$id_tanggal_panen}")->with('error', 'Input hasil pks gagal diperbarui.');
        }

        $AdminId = Auth::user()->id;
        $inputhasilpks = InputHasilPksModels::where('tb_input_hasil_pks.id_data_spb', $id_data_spb)->first();

        $inputhasilpks->update([
            'id_superadmin' => $AdminId,
            'id_data_spb' => $id_data_spb,
            'bruto' => $request->input('bruto'),
            'tarra' => $request->input('tarra'),
            'netto_terima' => $request->input('netto_terima'),
            'sortasi' => $request->input('sortasi'),
            'netto_bersih' => $request->input('netto_bersih'),
        ]);

        return redirect("/input-hasil-pks/{$id_data_spb}/{$id_tanggal_panen}")->with('success', 'Input hasil pks berhasil diperbarui.');
    }

}
