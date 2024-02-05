<input class="form-control id" name="id" type="hidden" id="id">
<div class="row mb-4 {{ $errors->has('nom_cla') ? 'has-error' : '' }}">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header" style="background-color: azure;">
                NOMBRE DE PLATS FOURNIS (PRE-SCOLAIRE)
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="{{ $errors->has('effec_fil_0') ? 'has-error' : '' }}">
                        <label class="form-label">Plats des filles</label>
                        <input class="form-control effect_fil_0" name="effect_fil_0" type="number" placeholder="Nombre à renseigner, ex: 10"  required="true">
                        {!! $errors->first('effec_fil_0', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="{{ $errors->has('effect_fil_0') ? 'has-error' : '' }}">
                        <label class="form-label">Plats des garçons</label>
                        <input class="form-control effect_gar_0" name="effect_gar_0" type="number" placeholder="Nombre à renseigner, ex: 10"  required="true">
                        <input class="form-control id" name="id" type="hidden" id="id">
                        {!! $errors->first('effec_gar_1', '<p class="help-block">:message</p>') !!}
                    </div><!-- end col -->
                </div>
            </div>
            <!-- end card body -->
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header" style="background-color: azure;">
                NOMBRE DE PLATS FOURNIS (PRIMAIRE)
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="{{ $errors->has('effect_fil_1') ? 'has-error' : '' }}">
                        <label class="form-label">Plats des filles</label>
                        <input class="form-control effect_fil_1" name="effect_fil_1" type="number"  placeholder="Nombre à renseigner, ex: 10"  required="true">
                        {!! $errors->first('effec_fil_2', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="{{ $errors->has('effect_fil_1') ? 'has-error' : '' }}">
                        <label class="form-label">Plats des garçons</label>
                        <input class="form-control effect_gar_1" name="effect_gar_1" type="number"  placeholder="Nombre à renseigner, ex: 10"  required="true">
                        <input class="form-control id" name="id" type="hidden" id="id">
                        {!! $errors->first('effec_gar_2', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">    
    <div class="col-xl-12 {{ $errors->has('date_rep1') ? 'has-error' : '' }}">
        <label for="date_rep" class="control-label">Date de fourniture de repas</label>
        <input class="form-control date_rep1" name="date_rep1" type="date" required="true">
        {!! $errors->first('date_rep1', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="row mb-3">
    <div class="col-xl-12">
        <div id="classe_comm_2">
        </div>
    </div>
    
</div>


<div class="card mt-4">
    <div class="card-header" style="background-color: azure;">
        DONNEES DE LOCALISATION ET CANTINE
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-xl-4 {{ $errors->has('region_id') ? 'has-error' : '' }}">
                <label for="region_id" class="control-label">Région</label>
                <select class="form-control region_id" id="region_comm_2" name="id" required="true">
                    <option value="" style="display: none;" disabled selected>Selectionner la région</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" data-reg="{{ $region->nom_reg }}">
                            {{ $region->nom_reg }}
                        </option>
                    @endforeach
                </select>        
                {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xl-4 {{ $errors->has('canton_id') ? 'has-error' : '' }}">
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_comm_2" name="canton_id" disabled>
                    <option value="" disabled selected>Selectionner le canton</option>
                </select>
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xl-4">
                <label for="ecole_id" class="control-label">Cantine</label>
                <select class="form-control ecole_id" id="ecole_comm_2" name="ecole_id" disabled  required="true">
                    <option value="" disabled selected>Selectionner la cantine</option>
                </select>
            </div>
        </div>
    </div>
</div>




