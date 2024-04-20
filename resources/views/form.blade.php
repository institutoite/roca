<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($pista) ? $pista->nombre : '') }}">
            <label for="nombre" class="form-label">Titulo</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-floating mb-3">
            <div class="mb-3">
                <label for="foto" class="form-label">Seleccione Imagen</label>
                <input type="file" class="form-control form-control-file" id="foto" name="foto">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-floating mb-3">
            
            <div class="mb-3">
                <label for="pista" class="form-label">Seleccione Audio</label>
                <input type="file" class="form-control form-control-file" id="pista" name="pista">
              </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-floating mb-3">
            <select class="form-control select2" id="hermano_id" name="hermano_id">
                <option value="">Selecciona un hermano</option>
                @foreach ($ministros as $ministro)
                <option value="{{ $ministro->id }}">{{ $ministro->nombre." ".$ministro->apellidos }}</option>
                @endforeach
            </select>
            <label for="hermano_id">Ministro:</label>
        </div>
    </div>
</div>

<div class="text-center">
    <div class="mb-3">
        <button type="submit" class="btn btn-outline-info fondoTurqueza">{{ isset($pista) ? 'Actualizar' : 'Guardar' }}</button>
    </div>
</div>