@extends('adminlte::page')

@section('title', 'Crear carta')

@section('content_header')
    <h1>Crear carta</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('cartas.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo">Tipo de carta</label>
                            <select id="tipo" name="tipo" class="form-control select2-general" required>
                                <option value="">-- Seleccione --</option>
                                <option value="multiple" {{ old('tipo') === 'multiple' ? 'selected' : '' }}>Varios hermanos</option>
                                <option value="hermano" {{ old('tipo') === 'hermano' ? 'selected' : '' }}>Un hermano</option>
                                <option value="hermana" {{ old('tipo') === 'hermana' ? 'selected' : '' }}>Una hermana</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input id="fecha" type="date" name="fecha" class="form-control" value="{{ old('fecha', now()->toDateString()) }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lugar">Lugar</label>
                            <input id="lugar" type="text" name="lugar" class="form-control" value="{{ old('lugar', 'Santa Cruz') }}" required>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iglesia_destino_id">Iglesia destino (de la base de datos)</label>
                            <select id="iglesia_destino_id" name="iglesia_destino_id" class="form-control select2-general" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($iglesias as $iglesia)
                                    <option value="{{ $iglesia->id }}" {{ (string)old('iglesia_destino_id') === (string)$iglesia->id ? 'selected' : '' }}>
                                        {{ $iglesia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="carta_motivo_id">Motivo (catálogo)</label>
                            <select id="carta_motivo_id" name="carta_motivo_id" class="form-control select2-general" required>
                                <option value="">-- Seleccione --</option>
                                @foreach($motivos as $motivo)
                                    <option value="{{ $motivo->id }}" {{ (string)old('carta_motivo_id') === (string)$motivo->id ? 'selected' : '' }}>
                                        {{ $motivo->motivo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_personas" for="personas_ids">Hermano(s)/Hermana(s)</label>
                            <select id="personas_ids" name="personas_ids[]" class="form-control select2-personas" multiple required data-placeholder="Buscar y seleccionar...">
                                @foreach($hermanos as $h)
                                    <option value="{{ $h->id }}" data-genero="{{ $h->genero ?? 'M' }}" {{ in_array($h->id, old('personas_ids', [])) ? 'selected' : '' }}>
                                        {{ $h->nombre }} {{ $h->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="help_personas" class="text-muted">Selecciona la(s) persona(s) que aparecerán en el PDF.</small>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Guardar y descargar PDF</button>
                    <a class="btn btn-secondary" href="{{ route('cartas.index') }}">Volver al listado</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('plugins.Select2', true)

@section('css')
    <style>
        /*
         |------------------------------------------------------------------
         | Select2 (AdminLTE) - legibilidad de seleccionados
         |------------------------------------------------------------------
         | En algunos temas, los "chips" seleccionados pueden verse con texto
         | muy claro. Forzamos texto oscuro para mejor contraste.
         */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #111;
            background: #e9ecef;
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            color: #111;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #111;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #111;
        }
    </style>
@stop

@section('js')
<script>
    (function () {
        function initSelect2General() {
            if (!window.jQuery || !jQuery.fn || !jQuery.fn.select2) {
                return;
            }

            $('.select2-general').select2({
                width: '100%',
                allowClear: true,
            });
        }

        function initSelect2Personas(options) {
            if (!window.jQuery || !jQuery.fn || !jQuery.fn.select2) {
                return;
            }

            var select = $('#personas_ids');
            if (!select.length) return;

            // Re-init limpio solo del select de personas.
            if (select.data('select2')) {
                select.select2('destroy');
            }

            var placeholder = select.data('placeholder') || 'Buscar y seleccionar...';

            var cfg = {
                width: '100%',
                allowClear: true,
                placeholder: placeholder,
                // En tipo "multiple" conviene mantener abierto para ir agregando uno por uno.
                closeOnSelect: (options && options.closeOnSelect !== undefined) ? options.closeOnSelect : true,
            };

            // IMPORTANTE: si pasamos maximumSelectionLength: undefined,
            // Select2 puede conservar el valor previo (ej: 1) y bloquear la multiselección.
            if (options && typeof options.maximumSelectionLength === 'number') {
                cfg.maximumSelectionLength = options.maximumSelectionLength;
            }

            select.select2(cfg);
        }

        function aplicarReglasPersonas(tipo) {
            var select = $('#personas_ids');
            if (!select.length) return;

            // Config de selección: 1 para hermano/hermana, N para multiple.
            var isMultiple = (tipo === 'multiple');
            var max = isMultiple ? 0 : 1;

            // Filtro por género (solo aplica a carta hermano/hermana).
            var genero = null;
            if (tipo === 'hermano') genero = 'M';
            if (tipo === 'hermana') genero = 'F';

            select.find('option').each(function () {
                var isPlaceholder = !this.value;
                if (isPlaceholder) return;
                var g = this.dataset.genero || 'M';
                var invalida = (genero !== null && g !== genero);
                this.disabled = invalida;
                // Oculta opciones que no aplican (así “solo se muestran” las válidas).
                this.hidden = invalida;
            });

            // Si hay seleccionados inválidos, los quitamos.
            var selected = (select.val() || []).filter(Boolean);
            var filtered = [];
            selected.forEach(function (v) {
                var opt = select.find('option[value="' + v + '"]');
                if (opt.length && !opt.prop('disabled')) {
                    filtered.push(v);
                }
            });
            // Aplicar límite de 1 si corresponde.
            if (max === 1 && filtered.length > 1) {
                filtered = [filtered[0]];
            }
            select.val(filtered);

            // Re-inicializar SOLO el select de personas para aplicar máximo y refrescar filtro.
            initSelect2Personas({
                maximumSelectionLength: max === 0 ? undefined : 1,
                closeOnSelect: !isMultiple,
            });

            var label = document.getElementById('label_personas');
            var help = document.getElementById('help_personas');
            if (tipo === 'multiple') {
                label.textContent = 'Hermanos/Hermanas (varios)';
                help.textContent = 'Selecciona varios para que aparezcan en el PDF en la lista.';
            } else if (tipo === 'hermano') {
                label.textContent = 'Hermano (uno)';
                help.textContent = 'Solo varones (género M).';
            } else if (tipo === 'hermana') {
                label.textContent = 'Hermana (una)';
                help.textContent = 'Solo mujeres (género F).';
            } else {
                label.textContent = 'Hermano(s)/Hermana(s)';
                help.textContent = 'Selecciona la(s) persona(s) que aparecerán en el PDF.';
            }
        }

        function toggle() {
            var tipo = document.getElementById('tipo').value;

            aplicarReglasPersonas(tipo);
        }

        // Con Select2 es más fiable enganchar el change vía jQuery también.
        document.getElementById('tipo').addEventListener('change', toggle);
        if (window.jQuery) {
            $('#tipo').on('change', toggle);
            $('#tipo').on('select2:select', toggle);
            $('#tipo').on('select2:clear', toggle);
        }

        initSelect2General();
        initSelect2Personas({
            maximumSelectionLength: undefined,
            closeOnSelect: true,
        });
        toggle();
    })();
</script>
@stop
