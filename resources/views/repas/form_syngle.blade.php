<input class="form-control id" name="id" type="hidden" id="id">
<div class="row mb-4">
    <div class="col-md-4 {{ $errors->has('date_rep') ? 'has-error' : '' }}">
        <label for="date_rep" class="control-label">Date de fourniture de repas</label>
        <input class="form-control date_rep" name="date_rep" type="date" placeholder="Date de fourniture de repas..."  required="true">
        {!! $errors->first('date_rep', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4 {{ $errors->has('effec_fil') ? 'has-error' : '' }}">
        <label class="form-label">Nombre de plats des filles</label>
        <input class="form-control effect_fil" name="effect_fil" type="number" placeholder="Effectif à renseigner, ex: 10"  required="true">
        {!! $errors->first('effec_fil', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-4 {{ $errors->has('effect_fil') ? 'has-error' : '' }}">
        <label class="form-label">Nombre de plats des garçons</label>
        <input class="form-control effect_gar" name="effect_gar" type="number" placeholder="Effectif à renseigner, ex: 10"  required="true">
        <input class="form-control id" name="id" type="hidden" id="id">
        {!! $errors->first('effec_gar', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="card mt-4">
    <div class="card-header" style="background-color: azure;">
        DONNEES DE LOCALISATION ET CANTINE
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6 {{ $errors->has('region_id') ? 'has-error' : '' }}">
                <label for="region_id" class="control-label">Région</label>
                <select class="form-control region_id" id="region_comm" name="id" required="true">
                    <option value="" style="display: none;" disabled selected>Selectionner la région</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" data-reg="{{ $region->nom_reg }}">
                            {{ $region->nom_reg }}
                        </option>
                    @endforeach
                </select>        
                {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-md-6 {{ $errors->has('canton_id') ? 'has-error' : '' }}">
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_comm" name="canton_id" disabled>
                    <option value="" disabled selected>Selectionner le canton</option>
                </select>        
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="ecole_id" class="control-label">Cantine</label>
                <select class="form-control ecole_id" id="ecole_comm" name="ecole_id" disabled  required="true">
                    <option value="" disabled selected>Selectionner la cantine</option>
                </select>
            </div>
            <div class="col-md-6  {{ $errors->has('nom_cla') ? 'has-error' : '' }}">
                <label class="form-label">Ecole</label>
                <select class="form-control classe_id" id="classe_c" name="classe_id" disabled>
                    <option value="" disabled selected>Selectionner l'école!</option>
                </select>
            </div>
        </div>
    </div>
</div>




