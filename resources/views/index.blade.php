@extends('Plantilla/plantilla')

@section('container')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-success" id="add_uf"><i class="fa-solid fa-plus"></i>Agregar Registro</button>
            </div>
            <div class="col">
                <h1>Listado de UF Historico</h1>
            </div>
        </div>

        <hr>
        
        <div class="row">
            <div class="col">
                <table id="uf_table" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Unidad Medida</th>
                            <th>Valor</th>
                            <th>Fecha</th>
                            <th>Tiempo</th>
                            <th>Origen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->nombreIndicador}}</td>
                            <td>{{$item->codigoIndicador}}</td>
                            <td>{{$item->unidadMedidaIndicador}}</td>
                            <td>{{$item->valorIndicador}}</td>
                            <td>{{$item->fechaIndicador}}</td>
                            <td>{{$item->tiempoIndicador}}</td>
                            <td>{{$item->origenIndicador}}</td>
                            <td>
                                <button class="btn btn-warning"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="add_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add_modalLabel">Agregar Uf</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('ufs.store') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">#ID</span>
              <input type="text" class="form-control" placeholder="ID" id="uf_id" name="uf_id">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text  col-md-3">Nombre</span>
              <input type="text" class="form-control" placeholder="Nombre" id="nom_i" name="nom_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Codigo</span>
              <input type="text" class="form-control" placeholder="Codigo"  id="cod_i" name="cod_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Unidad Medida</span>
              <input type="text" class="form-control" placeholder="Unidad Medida"  id="u_medida" name="u_medida">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Valor</span>
              <input type="text" class="form-control" placeholder="Valor" id="val_i" name="val_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Fecha</span>
              <input type="date" class="form-control" placeholder="Fecha" id="fecha_i" name="fecha_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Tiempo</span>
              <input type="text" class="form-control" placeholder="Tiempo" id="tiempo_i" name="tiempo_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Origen</span>
              <input type="text" class="form-control" placeholder="Origen" id="origen_i" name="origen_i">
            </div>
            <button type="submit" class="btn btn-success float-end"><i class="fa-solid fa-check"></i> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>