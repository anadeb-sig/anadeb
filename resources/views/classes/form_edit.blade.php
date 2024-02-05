<input class="form-control id" name="id" type="hidden" id="id">
<div class="row">
    <div class="col-xl-4 mb-4 {{ $errors->has('nom_cla') ? 'has-error' : '' }}">
        <label class="form-label">Ecole</label>
        <select class="form-control nom_cla" id="nom_cla" name="nom_cla" required="true">
            <option value="" style="display: none;" disabled selected>Selectionner l'enseignement!</option>
            <option value="Pré_scolaire">{{ ('Pré_scolaire') }}</option>
            <option value="Primaire">{{ ('Primaire') }}</option>
        </select>
    </div>
    <div class="col-xl-4">
        <div class="mb-4 {{ $errors->has('effec_fil') ? 'has-error' : '' }}">
            <label class="form-label">Effectif des filles</label>
            <input class="form-control effec_fil" name="effec_fil" type="number" id="effec_fil"  placeholder="Effectif à renseigner, ex: 10"  required="true">
            {!! $errors->first('effec_fil', '<p class="help-block">:message</p>') !!}
        </div>
    </div><!-- end col -->
    <div class="col-xl-4 mb-4 {{ $errors->has('effec_fil') ? 'has-error' : '' }}">
        <label class="form-label">Effectif des garçons</label>
        <input class="form-control effec_gar" name="effec_gar" type="number" id="effec_gar"  placeholder="Effectif à renseigner, ex: 10"  required="true">
        <input class="form-control id" name="id" type="hidden" id="id">
        {!! $errors->first('effec_gar', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
</div><!-- end row -->

<div class="card mt-4">
    <div class="card-header" style="background-color: azure;">
        DONNEES DE LOCALISATION ET CANTINE
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4 {{ $errors->has('region_id') ? 'has-error' : '' }}">
                <label for="region_id" class="control-label">Région</label>
                <select class="form-control region_id" id="region_edit" name="prefecture_id" required="true">
                    <option value="" style="display: none;" disabled selected>Selectionner la région</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}">
                            {{ $region->nom_reg }}
                        </option>
                    @endforeach
                </select>        
                {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xl-4 {{ $errors->has('canton_id') ? 'has-error' : '' }}">                
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_edit" name="canton_id" required="true" disabled>
                        <option value="" disabled selected>Selectionner le canton</option>
                </select>        
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xl-4">
                <label for="ecole_id" class="control-label">Cantine</label>
                <select class="form-control" id="ecole_edit" name="ecole_id" disabled required="true">
                    <option value="" disabled selected>Selectionner l'école</option>
                </select>
            </div>
        </div>
    </div>
</div>



