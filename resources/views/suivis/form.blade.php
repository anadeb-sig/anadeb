<input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
<div class="row">
    <div class="col-xl-6 {{ $errors->has('date_suivi') ? 'has-error' : '' }}">
        <label for="date_suivi" class="control-label">{{ __('Date de suivi') }}</label>
        <input class="form-control" name="date_suivi" type="date" id="date_suivi">
        {!! $errors->first('date_suivi', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-xl-6 {{ $errors->has('conf_plan') ? 'has-error' : '' }}">
        <label for="conf_plan" class="control-label">{{ __('Confirmation du plan en cours d\'exécution') }}</label>
        <div class="form-check">
            <input class="form-check-input" id="conf_plan1" type="radio" value="Oui" name="conf_plan">
            <label class="form-check-label" for="conf_plan1">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" id="conf_plan2" type="radio" value="Non" name="conf_plan" checked>
            <label class="form-check-label" for="conf_plan2">Non</label>
        </div>        
        {!! $errors->first('conf_plan', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-xl-6 {{ $errors->has('niveau_exe') ? 'has-error' : '' }}">
        <label for="niveau_exe" class="control-label">{{ __('Niveau d\'exécution de l\'ouvrage') }}</label>
        <textarea class="form-control majuscules" name="niveau_exe" type="text" id="niveau_exe" maxlength="250" placeholder="{{ __('Niveau d\'exécution') }}"></textarea>
        {!! $errors->first('niveau_exe', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-xl-6 {{ $errors->has('recomm') ? 'has-error' : '' }}">
        <label for="recomm" class="control-label">{{ __('Les recommandations') }}</label>
        <textarea class="form-control majuscules" name="recomm" type="text" id="recomm" maxlength="250" placeholder="{{ __('Entrer les recommandations') }}"></textarea>
        {!! $errors->first('recomm', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="card mt-3">
    <div class="card-header" style="background-color: azure;">
        LOCALISATION DE L'OUVRAGE VISITE
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4 {{ $errors->has('region_id') ? 'has-error' : '' }}">
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
            <div class="col-xl-4 {{ $errors->has('canton_id') ? 'has-error' : '' }}">                
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_comm" name="canton_id" required="true" disabled>
                        <option value="" disabled selected>Selectionner le canton</option>
                </select>        
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="col-xl-4 {{ $errors->has('signe_id') ? 'has-error' : '' }}">
                <label for="signe_id" class="control-label">{{ __('Ouvrage visité') }}</label>
                <select class="form-control ouvrage_id" id="ouvrage_comm" name="signe_id" disabled required="true">
                    <option value="" disabled selected>{{ __('Sélectionnez l\'ouvrage visité') }}</option>
                </select>
                {!! $errors->first('signe_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div  id="container">
</div>

<a class="btn btn-success mt-3" onclick="ajouterChamp()">Ajouter une photo d'ouvrage</a>

