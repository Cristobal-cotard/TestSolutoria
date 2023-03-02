<?php

namespace App\Http\Controllers;

use App\Models\Ufs;
use Illuminate\Http\Request;

class UfsController extends Controller
{

    public function index()
    {
        $datos = Ufs::all();
        return view('index',compact('datos'));
    }

    public function create()
    {
        return 'hola';
    }
    
    public function store(Request $request)
    {
        $ufs = new Ufs();

        $ufs->id = $request->post('uf_id');
        $ufs->nombreIndicador = $request->post('nom_i');
        $ufs->codigoIndicador = $request->post('cod_i');
        $ufs->unidadMedidaIndicador = $request->post('u_medida');
        $ufs->valorIndicador = $request->post('val_i');
        $ufs->fechaIndicador = $request->post('fecha_i');
        $ufs->tiempoIndicador = $request->post('tiempo_i');
        $ufs->origenIndicador = $request->post('origen_i');
        $ufs->save();

        return redirect()->route("ufs.index")->with("success","Agregado Correctamente!");
    }
    
    public function show(Ufs $ufs)
    {
        //
    }
    
    public function edit(Ufs $ufs)
    {
        //
        return 'hola';
    }

    public function update(Request $request, Ufs $ufs)
    {
        //
    }

    public function destroy(Ufs $ufs)
    {
        //
    }
}
