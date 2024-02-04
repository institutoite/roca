
@extends('adminlte::page')

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@stop
@section('title', 'Hermanos')

@section('content')
    <h1>Crear Rol: {{ $rol->mes." ". $rol->gestion }}</h1>

    <div class="container mt-5">
      <button id="agregarCard" class="btn btn-primary mb-3">Agregar Card</button>
      <label id="info" for="">info</label>
      <input class="form-control" type="date" name="" id="fechabase" value="<?= Illuminate\Support\Facades\Date::now()->format('Y-m-d') ?>">
      <form action="{{ route("detallerol.store",$rol->id) }}" method="POST">
        @csrf
        <div id="cardsContainer" class="row">
        
        </div>
        <input type="number" hidden name="rol_id" id="rol_id" value="{{ $rol->id }}">
        <input type="number" hidden name="contadorCards" id="contadorCards" value="">
        <button type="submit">Guardar</button>
      </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js" integrity="sha512-4F1cxYdMiAW98oomSLaygEwmCnIP38pb4Kx70yQYqRwLVCs3DbRumfBq82T08g/4LJ/smbFGFpmeFlQgoDccgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function() {
  // Contador para asignar IDs únicos a los cards
  let contadorCards = 0;
  let contadorFilas = 0;
  let esDomingoPrimeraVez=true;
  let esDomingollenar=true;
  let fechaBase = $("#fechabase").val();
  //console.log("esDomingoPrimeraVez="+esDomingoPrimeraVez);
  informar(contadorFilas,fechaBase,contadorCards);

  // Función para agregar un nuevo card con cuatro filas de componentes
  function agregarCard() {
    const cardHtml = `
      <div id="${contadorCards}" class="col-md-12 mb-9">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-danger btnEliminarCard">Eliminar</button> 
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
    $("#contadorCards").val(contadorCards);
    contadorCards++;
    informar(contadorFilas,fechaBase,contadorCards);
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
   
  function obtenerFechaSiguiente(fechaBase) {
    const fechaBaseMoment = moment(fechaBase);
    const diaSemana = fechaBaseMoment.day();
    let diasHastaSiguiente;
    //console.log("esDomingoPrimeraVez="+esDomingoPrimeraVez);
    switch (diaSemana) {
      case 0:
        if(esDomingoPrimeraVez)
        {
          diasHastaSiguiente = 0;
          esDomingoPrimeraVez = false;
        }  
        else{
          diasHastaSiguiente = 3;
          esDomingoPrimeraVez = true;
        }
        
        break;
      case 3: 
        diasHastaSiguiente = 3; 
        break;
      case 6: 
        diasHastaSiguiente = 1; 
        break;
      default:
        diasHastaSiguiente = 0; 
    }
    const fechaSiguiente = fechaBaseMoment.add(diasHastaSiguiente, 'days');
    informar(contadorFilas,fechaBase,contadorCards);
    return fechaSiguiente.format('YYYY-MM-DD');
    
  }
  

  // Función para generar una fila de componentes
  function generarFilaComponentes() {
    contadorFilas++;
    const FilaHtml=`
      <div class="row g-2" id="${contadorFilas}">
        <div class="col-4 pb-2">
          <div class="form-floating">
            <input type="date" class="form-control" id="fecha${contadorFilas}" name="fecha${contadorFilas}" value="${fechaBase}">
            <label for="fecha">Fecha</label>
          </div>
        </div>
        <div class="col-4 pb-2">
          <div class="form-floating">
            <select class="form-control" id="preside${contadorFilas}" name="preside${contadorFilas}" aria-label="Floating label select example">
            </select>
            <label for="preside"> Preside </label>
          </div>
        </div>
        <div class="col-4 pb-2">
          <div class="form-floating">
            <select class="form-control" id="ministra${contadorFilas}" name="ministra${contadorFilas}" aria-label="Floating label select example"></select>
            <label for="ministra"> Ministra </label>
          </div>
        </div>
      </div>
    `;
    
    var fechaBaseM = moment(fechaBase);
    var dia = fechaBaseM.day();
    switch (dia) {
      case 0:
        
        console.log("Dia",dia,esDomingoPrimeraVez);
        if(esDomingoPrimeraVez==true)
          llenarDropdown(`#ministra${contadorFilas}`, '../../domingos');

        if(esDomingoPrimeraVez==false)
          llenarDropdown(`#ministra${contadorFilas}`, '../../predicadores');
          
       
        //console.log("dia"+dia+"| esDomingoPrimeraVez="+esDomingoPrimeraVez);
        
        break;
      case 3: 
      llenarDropdown(`#ministra${contadorFilas}`, '../../miercoles');
        break;
      case 6: 
      llenarDropdown(`#ministra${contadorFilas}`, '../../sabados');
        break;
      default:
        diasHastaSiguiente = 0; 
    }
    llenarDropdown(`#preside${contadorFilas}`, '../../presididores');
    

    const fechaSiguiente = obtenerFechaSiguiente(fechaBase);
    fechaBase = fechaSiguiente;
    informar(contadorFilas,fechaBase,contadorCards);
    return FilaHtml;
  }


  

  function llenarDropdown(selector, url) {
    $.ajax({
      url: url,
      method: 'GET',
      success: function(data) {
        const dropdown = $(selector);
        dropdown.empty();
        // dropdown.append(`<option value="">Seleccione un Hermano</option>`);
        data.forEach(opcion => {
          dropdown.append(`<option value="${opcion.id}">${opcion.nombre+" "+opcion.apellidos}</option>`);
        });
      },
      error: function(error) {
        console.error('Error en la llamada AJAX:', error+"selector="+selector);
      }
    });
    informar(contadorFilas,fechaBase,contadorCards);
  }



  // Manejador de clic para el botón "Agregar Card"
  $('#agregarCard').on('click', agregarCard);

  // Manejador de clic para los botones "Eliminar"
  $(document).on('click', '.btnEliminarCard', function() {
    const cardId = $(this).parent().parent().parent().prop("id");
    console.log(cardId);
    $(`#${cardId}`).remove();
    contadorCards=contadorCards-1;
    $("#contadorCards").val(contadorCards);
    contadorFilas=contadorFilas-4;
    fechaBase = $("#fechabase").val();
    informar(contadorFilas,fechaBase,contadorCards);
  });

  $("#fechabase").change(function() {
    // Obtiene el valor del campo de fecha
    fechaBase = $(this).val();
    contadorFilas=0;
    //console.log("esDomingoPrimeraVez="+esDomingoPrimeraVez);
    informar(contadorFilas,fechaBase,contadorCards);
  });


  function informar(contadorFilas,fechaBase,contadorCards){
    $("#info").text("|ContadorFilas"+contadorFilas+"|fechaBase"+fechaBase+"|contadorCards"+contadorCards);

  }

});

</script>
@stop







