<div class="card">
    <div class="card-header" style="background-color: azure;">
        LOCALISATION DE L'OUVRAGE VISITE
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 {{ $errors->has('region_id') ? 'has-error' : '' }}">
                <label for="region_id" class="control-label">Région</label>
                <select class="form-control region_id" id="region_comm" name="prefecture_id" required="true">
                    <option value="" style="display: none;" disabled selected>Selectionner la région</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}">
                            {{ $region->nom_reg }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->first('region_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xl-6 {{ $errors->has('canton_id') ? 'has-error' : '' }}">                
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_comm" name="canton_id" required="true" disabled>
                        <option value="" disabled selected>Selectionner le canton</option>
                </select>        
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
<div class="row">
    <div class="col-xl-6 {{ $errors->has('signe_id') ? 'has-error' : '' }}">
        <label for="signe_id" class="control-label">{{ __('Ouvrage visité') }}</label>
        <select class="form-control ouvrage_comm" id="ouvrage_comm" name="suivi_id" disabled required="true">
            <option value="" disabled selected>{{ __('Sélectionnez l\'ouvrage visité') }}</option>
        </select>
        {!! $errors->first('signe_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-xl-6 {{ $errors->has('date_suivi') ? 'has-error' : '' }}">
        <label for="date_suivi" class="control-label">{{ __('Date de suivi') }}</label>
        <input class="form-control" name="date_suivi" type="date" id="date_suivi">
        {!! $errors->first('date_suivi', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mb-3">
    <div class="col-xl-12">
        <div id="ouvrage_galerie">
        </div>
    </div>    
</div>
<div  id="container">
    <div class="row mt-3">
        <div class="col-xl-6 {{ $errors->has('photo') ? 'has-error' : '' }}">
            <label for="photo" class="control-label">{{ __('Photo de l\'ouvrage') }}</label>
            <input class="form-control photo" type="file" name="photo[]">
            {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="col-xl-6 {{ $errors->has('decrip') ? 'has-error' : '' }}">
            <label for="decrip" class="control-label">{{ __('Description') }}</label>
            <input class="form-control decrip" type="text" name="decrip[]">
            {!! $errors->first('decrip', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<a class="btn btn-success mt-3" onclick="ajouterChamp()">Ajouter une photo d'ouvrage</a>