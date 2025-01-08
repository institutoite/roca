

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" 
           value="{{ old('nombre', isset($hermano) ? $hermano->nombre : '') }}" required>
</div>

<div class="mb-3">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" 
           value="{{ old('apellidos', isset($hermano) ? $hermano->apellidos : '') }}" required>
</div>

<div class="mb-3">
    <label for="iglesia_id" class="form-label">Iglesia</label>
    <select class="form-control select2" id="iglesia_id" name="iglesia_id" required>
        <option value="" disabled {{ !isset($hermano) ? 'selected' : '' }}>Seleccione una iglesia</option>
        @foreach ($iglesias as $iglesia)
            <option value="{{ $iglesia->id }}" 
                {{ isset($hermano) && $hermano->iglesia_id == $iglesia->id ? 'selected' : '' }}>
                {{ $iglesia->nombre }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <button type="submit" class="btn btn-primary">{{ isset($hermano) ? 'Actualizar' : 'Crear' }}</button>
</div>
