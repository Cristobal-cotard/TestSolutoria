<?php

namespace App\Http\Controllers;

use App\Models\Ufs;
use Illuminate\Http\Request;
use DataTables;


class UfsController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            $datos = Ufs::all();
            return DataTables::of($datos)
                ->addColumn('Acciones',function($datos){
                    $acciones = '<button class="btn edit" id="'.$datos->id.'"><i class="fa-solid fa-edit"></i></button>';
                    $acciones .= '&nbsp;<button class="btn delete" id="'.$datos->id.'"><i class="fa-solid fa-trash"></i></button>';
                    return $acciones;
                })
                ->rawColumns(['Acciones'])
                ->toJson();
        }
        return view('index');
    }
    
    public function store(Request $request)
    {
        $ufs = new Ufs();

        $ufs->nombreIndicador = $request->post('nom_i');
        $ufs->codigoIndicador = $request->post('cod_i');
        $ufs->unidadMedidaIndicador = $request->post('u_medida');
        $ufs->valorIndicador = $request->post('val_i');
        $ufs->fechaIndicador = $request->post('fecha_i');
        $ufs->tiempoIndicador = $request->post('tiempo_i');
        $ufs->origenIndicador = $request->post('origen_i');
        $ufs->save();

        return back();
    }
    
    public function show($id)
    {
        $ufs = Ufs::find($id);
        return compact('ufs');
    }

    public function update(Request $request, $id)
    {
        $ufs = Ufs::findOrFail($id);
        $ufs->id = $id;
        $ufs->nombreIndicador = $request->post('u_nom_i');
        $ufs->codigoIndicador = $request->post('u_cod_i');
        $ufs->unidadMedidaIndicador = $request->post('u_u_medida');
        $ufs->valorIndicador = $request->post('u_val_i');
        $ufs->fechaIndicador = $request->post('u_fecha_i');
        $ufs->tiempoIndicador = $request->post('u_tiempo_i');
        $ufs->origenIndicador = $request->post('u_origen_i');

        $ufs->save();

        return back();
    }

    public function destroy($id)
    {
        $ufs = Ufs::findOrFail($id);
        if ($ufs) {
            $ufs->delete();
            return back();
        } else {
            return response()->json(['success' => false, 'message' => 'No se pudo encontrar el registro.']);
        }
    }

    public function chartData(Request $request)
    {
        $f_desde = $request->input('f_desde');
        $f_hasta = $request->input('f_hasta');
    
        $data = Ufs::whereBetween('fechaIndicador', [$f_desde, $f_hasta])
                    ->orderBy('fechaIndicador', 'asc')
                    ->get();
    
        $chartData = [];
    
        foreach ($data as $item) {
            $chartData[] = [
                'x' => $item->fechaIndicador,
                'y' => $item->valorIndicador,
            ];
        }
    
        return response()->json($chartData);
    }
}
