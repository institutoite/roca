
@extends('adminlte::page')

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop
@section('title', 'Hermanos')

@section('content')
    <h1>Crear Semana para Rol: {{ $rol->nombre }}</h1>

    <div class="container mt-5">
      <button id="agregarCard" class="btn btn-primary mb-3">Agregar Card</button>
      
      <div id="cardsContainer" class="row">
        
      </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
  // Contador para asignar IDs únicos a los cards
  let contadorCards = 1;
  let contadorFilas = 0;
  const fechaInicio = new Date('2024-01-01');

  // Función para agregar un nuevo card con cuatro filas de componentes
  function agregarCard() {
    const cardHtml = `
      <div id="${contadorCards}" class="col-md-9 mb-9">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-danger btnEliminarCard">Eliminar</button> 
            <span class="text-right">SEMANA ${contadorCards}</span> 
          </div>
          <div class="card-body">
            ${generarFilaComponentes()}
            ${generarFilaComponentes()}
            ${generarFilaComponentes()}
            ${generarFilaComponentes()}  
          </div>
        </div>
      </div>
    `;

    $('#cardsContainer').append(cardHtml);
    contadorCards++;
  }

  async function obtenerOpciones(){
    try {
      const response = await fetch('presididores'); // Reemplaza 'tu_endpoint_aqui' con la URL de tu API
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error al obtener opciones:', error);
      return [];
    }
  }
   

  // Función para generar una fila de componentes
  function generarFilaComponentes() {
    contadorFilas++;

    fechaInicio.setDate(fechaInicio.getDate()+contadorFilas);
    const FilaHtml=`
      <div class="row g-2" id="${contadorFilas}">
        <div class="col-4 pb-2">
          <div class="form-floating">
            <input type="date" class="form-control" id="fecha${contadorFilas}" value="${fechaInicio.toISOString().split('T')[0]}">
            <label for="fecha">Fecha</label>
          </div>
        </div>
        <div class="col-4 pb-2">
          <div class="form-floating">
            <select class="form-control" id="preside${contadorFilas}" aria-label="Floating label select example">
            </select>
            <label for="preside"> Preside </label>
          </div>
        </div>
        <div class="col-4 pb-2">
          <div class="form-floating">
            <select class="form-control" id="ministra${contadorFilas}" aria-label="Floating label select example"></select>
            <label for="ministra"> Ministra </label>
          </div>
        </div>
      </div>
    `;
    
    // fechaInicio.setDate(fechaInicio.getDate());
    // const inputFecha = $(`#fecha${contadorFilas}`);
    // inputFecha.val(fechaInicio.toISOString().split('T')[0]);
    
    llenarDropdown(`#preside${contadorFilas}`, '../../presididores');
    llenarDropdown(`#ministra${contadorFilas}`, '../../presididores');
   
    return FilaHtml;
  }


  function generarFechas(fechaInicio, cantidadDias) {
      $('#contenedorFechas').empty();

    for (let i = 0; i < cantidadDias; i++) {
      const fecha = new Date(fechaInicio);
      fecha.setDate(fechaInicio.getDate() + i);

      const inputFecha = $('<input type="date" class="form-control mb-2">');
      inputFecha.val(fecha.toISOString().split('T')[0]);

      $('#contenedorFechas').append(inputFecha);
    }
    
  }

  function llenarDropdown(selector, url) {
    console.log(url);
    $.ajax({
      url: url,
      method: 'GET',
      success: function(data) {
        const dropdown = $(selector);
        dropdown.empty();
        dropdown.append(`<option value="">Seleccione un Hermano</option>`);
        data.forEach(opcion => {
          dropdown.append(`<option value="${opcion}">${opcion.nombre+" "+opcion.apellidos}</option>`);
        });
      },
      error: function(error) {
        console.error('Error en la llamada AJAX:', error);
      }
    });
  }



  // Manejador de clic para el botón "Agregar Card"
  $('#agregarCard').on('click', agregarCard);

  // Manejador de clic para los botones "Eliminar"
  $(document).on('click', '.btnEliminarCard', function() {
    const cardId = $(this).parent().parent().parent().prop("id");
    console.log(cardId);
    $(`#${cardId}`).remove();
  });
});

</script>
@stop







