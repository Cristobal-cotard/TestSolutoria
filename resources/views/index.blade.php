@extends('Plantilla/plantilla')
@section('titulo','Crud Test Solutoria')
@section('container')
  <div class="container">
    <div class="row">
        <div class="col-md-4">
            <button class="btn" id="add_uf"><i class="fa-solid fa-plus"></i>Agregar Registro</button>
            <a href="#chart_c" class="btn">Ver Grafico</a>
        </div>
        <div class="col">
            <h1 class="titulo">Listado de UF Historico</h1>
        </div>
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <table id="uf_table" class="table table-stripped">
          <thead>
            <tr>
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
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Agregar-->
  <div class="modal fade" id="add_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add_modalLabel">Agregar Uf</h5>
          <button type="button" class="btn-close" id="cancel_op" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form_datos">
            @csrf
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
              <input type="number" class="form-control" placeholder="Valor" id="val_i" name="val_i">
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
            <button type="submit" id="btnSave" class="btn btn-success float-end"><i class="fa-solid fa-check"></i> Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Editar-->
  <div class="modal fade" id="edit_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_modalLabel">Editar Registro</h5>
          <button type="button" class="btn-close" id="cancel_op" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form_update">
            @csrf
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">#ID</span>
              <input type="text" class="form-control" placeholder="ID" id="u_uf_id" name="u_uf_id" READONLY>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text  col-md-3">Nombre</span>
              <input type="text" class="form-control" placeholder="Nombre" id="u_nom_i" name="u_nom_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Codigo</span>
              <input type="text" class="form-control" placeholder="Codigo"  id="u_cod_i" name="u_cod_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Unidad Medida</span>
              <input type="text" class="form-control" placeholder="Unidad Medida"  id="u_u_medida" name="u_u_medida">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Valor</span>
              <input type="number" class="form-control" placeholder="Valor" id="u_val_i" name="u_val_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Fecha</span>
              <input type="date" class="form-control" placeholder="Fecha" id="u_fecha_i" name="u_fecha_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Tiempo</span>
              <input type="text" class="form-control" placeholder="Tiempo" id="u_tiempo_i" name="u_tiempo_i">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text col-md-3">Origen</span>
              <input type="text" class="form-control" placeholder="Origen" id="u_origen_i" name="u_origen_i">
            </div>
            <button type="submit" id="btnUpdate" class="btn btn-success float-end"><i class="fa-solid fa-check"></i> Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Cargar DataTable-->
  <script>
    $(document).ready(function () {
      var tablaUf = $('#uf_table').DataTable({
        "order": [[ 4, "desc" ]],
          processing: true,
          serverSide: true,
          lengthChange: false,
          searching: false,
          "language": {
            "info": ""
          },
          ajax: {
              url: "{{ route('ufs.index') }}",
          },
          columns: [
              { data: 'nombreIndicador', orderable: false },
              { data: 'codigoIndicador', orderable: false },
              { data: 'unidadMedidaIndicador', orderable: false },
              { data: 'valorIndicador' },
              { data: 'fechaIndicador' },
              { data: 'tiempoIndicador', orderable: false },
              { data: 'origenIndicador', orderable: false },
              { data: 'Acciones', orderable: false },
          ]
      });
  
      $('#add_uf').click(function () {
          $('#add_modal').modal('show');
      })

      $('#cancel_op').click(function(){
        limpiarmodal();
      })

    });

    function limpiarmodal(){
        $('#nom_i').val('')
        $('#cod_i').val('')
        $('#u_medida').val('')
        $('#val_i').val('')
        $('#fecha_i').val('')
        $('#tiempo_i').val('')
        $('#origen_i').val('')
        
        $('#u_nom_i').val('')
        $('#u_cod_i').val('')
        $('#u_u_medida').val('')
        $('#u_val_i').val('')
        $('#u_fecha_i').val('')
        $('#u_tiempo_i').val('')
        $('#u_origen_i').val('')
      }
  </script>

  <!-- Agregar un registro-->
  <script>
    //Crear Registro
    $('#form_datos').on('submit', function (e) {
      e.preventDefault();
      var token = $('input[name="_token"]').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: "{{ route('ufs.store') }}",
          type: "POST",
          data: $('#form_datos').serialize(),
          dataType: 'json',
          beforeSend:function(){
            $('#btnSave').html('<i class="fa-solid fa-check"></i> Guardando...')
          },
          success: function (data) {
            $('#btnSave').html('<i class="fa-solid fa-check"></i> Guardar')
            $('#uf_table').DataTable().clear().draw();
            $('#uf_table').DataTable().rows.add(data.data).draw();
            $('#add_modal').modal('hide');
            limpiarmodal()
            Swal.fire({
                title: 'Guardado Correctamente',
                text: 'El registro se ha guardado satisfactoriamente!',
                icon: 'success',
                confirmButtonText: 'Listo'
            })
          },
          error: function (data) {
              console.error('Error:', data);
          }
      });
    });
  </script>

  <!-- Eliminar un registro-->
  <script>
    //Eliminar Registro
    $(document).on('click','.delete', function(){
      id = $(this).attr('id');
      Swal.fire({
        title: '¿Está seguro?',
        text: '¿Desea eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '{{ route('ufs.destroy', ':id') }}'.replace(':id', id),
            success:function(data){
              $('#uf_table').DataTable().clear().draw();
              $('#uf_table').DataTable().rows.add(data.data).draw();
              Swal.fire({
                title: 'Eliminado Correctamente',
                text: 'El registro se ha eliminado correctamente!',
                icon: 'success',
                confirmButtonText: 'Listo'
              })
            }
          })
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          // Acciones a realizar si el usuario cancela la eliminación
          Swal.fire(
            'Cancelado',
            'No se ha eliminado el registro',
            'error'
          )
        }
      })
    })
  </script>

  <!-- Traer datos-->
  <script>
    //Mostrar Datos
    $(document).on('click','.edit', function(){
      id = $(this).attr('id');
      $.ajax({
        url: '{{ route('ufs.show', ':id') }}'.replace(':id', id),
        type: 'GET',
        dataType: 'json',
        success: function(datos) {
          $('#edit_modal').modal('show');
          $('#u_uf_id').val(datos.ufs["id"])
          $('#u_nom_i').val(datos.ufs["nombreIndicador"])
          $('#u_cod_i').val(datos.ufs["codigoIndicador"])
          $('#u_u_medida').val(datos.ufs["unidadMedidaIndicador"])
          $('#u_val_i').val(datos.ufs["valorIndicador"])
          $('#u_fecha_i').val(datos.ufs["fechaIndicador"])
          $('#u_tiempo_i').val(datos.ufs["tiempoIndicador"])
          $('#u_origen_i').val(datos.ufs["origenIndicador"])
        }
      });
    });
  </script>

  <!-- Actualizar datos-->
  <script>
    $('#form_update').on('submit', function (e) {
      e.preventDefault();
      var token = $('input[name="_token"]').val();
      $.ajax({
          url: '{{ route('ufs.update', ':id') }}'.replace(':id', id),
          type: "POST",
          data: $('#form_update').serialize(),
          dataType: 'json',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend:function(){
            $('#btnUpdate').html('<i class="fa-solid fa-check"></i> Guardando...')
          },
          success: function (data) {
            $('#btnUpdate').html('<i class="fa-solid fa-check"></i> Guardar')
            $('#uf_table').DataTable().clear().draw();
            $('#uf_table').DataTable().rows.add(data.data).draw();
            $('#edit_modal').modal('hide');
            limpiarmodal()
            Swal.fire({
                title: 'Registro Actualizado!',
                text: 'El registro se ha actualizado satisfactoriamente!',
                icon: 'success',
                confirmButtonText: 'Listo'
            })
          },
          error: function (data) {
              console.error('Error:', data);
          }
      });
    });
  </script>

@endsection

@section('chart')
<div class="container chart_c" id="chart_c">
  <div class="row">
    <div class="col">
      <h1 class="titulo">Grafico Uf por rango de fecha</h1>
    </div>
    <div class="col d-flex">
      <form action="" method="post">
        <div class="col d-flex flex-row">
          <div class="input-group mb-3">
            <span class="input-group-text">Fecha Desde</span>
            <input type="date" class="form-control" name="f_desde" id="f_desde">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Fecha Hasta</span>
            <input type="date" class="form-control" name="f_hasta" id="f_hasta" value="<?php echo date('Y-m-d'); ?>">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card chart_back">
        <div class="card-body ">
          <div class="" style="width: 1200px; height: 600px;">
            <canvas id="myChart" ></canvas>
          </div>
        </div>
      </div>   
    </div> 
  </div>
</div>

<!-- Grafico -->
<script>

  var chart = new Chart(document.getElementById("myChart"), {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'UF',
        data: [20, 50, 80, 140, 180],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
        tension: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  $('#f_desde,#f_hasta').on('change', function(e) {
    e.preventDefault();
    var f_desde = $('#f_desde').val();
    var f_hasta = $('#f_hasta').val();

    if(f_desde > f_hasta){
      Swal.fire({
          title: 'Advertencia',
          text: 'La fecha "desde" debe ser anterior a la fecha "hasta".',
          icon: 'warning',
          confirmButtonText: 'Listo'
      })
    }else{
      $.ajax({
        url: '{{ route('ufs.chartData', ':id') }}',
          type: 'POST',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
              'f_desde': f_desde,
              'f_hasta': f_hasta,
          },
          success: function(data) {
            chart.data.datasets[0].data = data;
            chart.update();
          }
      });
    }
  })
</script>
@endsection
