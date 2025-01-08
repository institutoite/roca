<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" 
        value="{{ old('nombre', $cuenta->nombre ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <select name="tipo" id="tipo" class="form-select form-control" required>
        <option value="" disabled {{ !isset($cuenta) ? 'selected' : '' }}>Seleccione un tipo</option>
        <option value="ingreso" {{ old('tipo', $cuenta->tipo ?? '') == 'ingreso' ? 'selected' : '' }}>Ingreso</option>
        <option value="egreso" {{ old('tipo', $cuenta->tipo ?? '') == 'egreso' ? 'selected' : '' }}>Egreso</option>
    </select>
</div>
