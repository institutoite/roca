<div class="mb-3">
    <label for="monto" class="form-label">Monto</label>
    <input type="number" name="monto" id="monto" class="form-control" 
        value="{{ old('monto', $detalle->monto ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $detalle->descripcion ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" name="fecha" id="fecha" class="form-control" 
        value="{{ old('fecha', $detalle->fecha ?? now()->format('Y-m-d')) }}" required>
</div>
