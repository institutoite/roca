
@extends('adminlte::page')

@section('title', 'Hermanos')

@section('content')
    <h1>Crear Semana para Rol: {{ $rol->nombre }}</h1>

        <button id="agregarFila" class="btn btn-primary mb-3">Agregar Fila</button>
        <table class="table">
            <thead>
                <tr>
                <th>Fecha</th>
                <th>Dropdown 1</th>
                <th>Dropdown 2</th>
                <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="filasContainer">
                <!-- Las filas se agregarán aquí dinámicamente -->
            </tbody>
        </table>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>

$(document).ready(function() {
    // Contador para asignar IDs únicos a las filas
    let contadorFilas = 1;
  

    function agregarSemana(){
        for(i=0;i<5;i++){
            agregarFila();
        }
    }

    // Función para agregar una nueva fila
    function agregarFila() {
      const filaHtml = `
        <tr id="fila${contadorFilas}">
          <td><input type="date" class="form-control"></td>
          <td><select class="form-control" id="dropdown1-${contadorFilas}"></select></td>
          <td><select class="form-control" id="dropdown2-${contadorFilas}"></select></td>
          <td><button class="btn btn-danger btnEliminarFila" data-fila-id="${contadorFilas}">Eliminar</button></td>
        </tr>
      `;
  
      $('#filasContainer').append(filaHtml);
  
      // Llenar los dropdowns con datos obtenidos mediante AJAX (simulado)
      // Puedes reemplazar esto con llamadas AJAX reales para obtener datos dinámicos
      llenarDropdown(`#dropdown1-${contadorFilas}`, ['Opción A', 'Opción B', 'Opción C']);
      llenarDropdown(`#dropdown2-${contadorFilas}`, ['Dato 1', 'Dato 2', 'Dato 3']);
  
      contadorFilas++;
    }
  
    // Función para llenar un dropdown con opciones
    function llenarDropdown(selector, opciones) {
      const dropdown = $(selector);
      dropdown.empty();
      opciones.forEach(opcion => {
        dropdown.append(`<option value="${opcion}">${opcion}</option>`);
      });
    }
  
    // Manejador de clic para el botón "Agregar Fila"
    $('#agregarFila').on('click', agregarSemana);
  
    // Manejador de clic para los botones "Eliminar"
    $(document).on('click', '.btnEliminarFila', function() {
      const filaId = $(this).data('fila-id');
      $(`#fila${filaId}`).remove();
    });
  });
  </script>
@stop







