<!-- resources/views/hermanos/form.blade.php -->

<div class="mb-3">
    <label for="papel" class="form-label">papel</label>
    <input type="text" class="form-control" id="papel" name="papel" value="{{ old('papel', isset($papel) ? $papel->papel : '') }}" required>
</div>


<div class="mb-3">
    <button type="submit" class="btn btn-primary">{{ isset($papel) ? 'Actualizar' : 'Crear' }}</button>
</div>
