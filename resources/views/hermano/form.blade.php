<!-- resources/views/hermanos/form.blade.php -->

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($hermano) ? $hermano->nombre : '') }}" required>
</div>

<div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', isset($hermano) ? $hermano->apellidos : '') }}" required>
</div>

<!-- Agrega más campos según sea necesario -->

<div class="mb-3">
    <button type="submit" class="btn btn-primary">{{ isset($hermano) ? 'Actualizar' : 'Crear' }}</button>
</div>
