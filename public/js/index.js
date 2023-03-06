$(document).ready(function () {
    var tablaUf = $('#uf_table').DataTable({
        processing: true,
        serverSide: true,
        lengthChange: false,
        searching: false,
        ajax: {
            url: "{{ route('ufs.index') }}",
        },
        columns: [
            { data: 'id' },
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
            success: function (data) {
                $('#uf_table').DataTable().clear().draw();
                $('#uf_table').DataTable().rows.add(data.data).draw();
                $('#add_modal').modal('hide');
                Swal.fire({
                    title: 'Guardado Correctamente',
                    text: 'El registro se ha guardado satisfactoriamente!',
                    icon: 'success',
                    confirmButtonText: 'Listo'
                })
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});