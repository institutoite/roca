<!-- resources/views/hermanos/form.blade.php -->

<div class="mb-3">
    <label for="mes" class="form-label">mes</label>
    <input type="text" class="form-control" id="mes" name="mes" value="{{ old('mes', isset($rol) ? $rol->mes : '') }}" required>
</div>

<div class="mb-3">
    <label for="gestion" class="form-label">gestion</label>
    <input type="text" class="form-control" id="gestion" name="gestion" value="{{ old('gestion', isset($rol) ? $rol->gestion : '') }}" required>
</div>

<!-- Agrega más campos según sea necesario -->

<div class="mb-3">
    <button type="submit" class="btn btn-primary">{{ isset($rol) ? 'Actualizar' : 'Crear' }}</button>
</div>
