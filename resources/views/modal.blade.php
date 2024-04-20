<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($pista) ? $pista->nombre : '') }}">
                        <label for="nombre" class="form-label">Titulo</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            @isset($record)
                                PORTADA ACTUAL
                            @else
                            SUBA UNA IMAGEN
                            @endisset 
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @isset($pista)
                                        <img class="" width="150" src="{{ $pista->nombre ? asset('storage/portadas/'.$pista->foto) : asset('storage/portadas/sinfoto.jpg') }}" alt="">
                                    @endisset
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <input type="file" class="form-control-file" id="foto" name="foto">
                                <label for="foto">Foto:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            @isset($pista)
                                AUDIO ACTUAL
                            @else
                                SUBA UN AUDIO
                            @endisset
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control-file" id="pista" name="pista">
                                    <label for="pista">Audio:</label>
                                </div>
                            </div>
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
        </div>
    </div>
</div>