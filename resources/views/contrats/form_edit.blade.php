<input class="form-control id" name="id" type="hidden" id="id">
<input class="form-control iid" name="iid" type="hidden" id="id">
<div class="row">
    <div class="col-xl-6 {{ $errors->has('entreprise_id') ? 'has-error' : '' }}">
        <label for="entreprise_id" class="control-label">{{ __('Entreprise') }}</label>
        <select class="form-control entreprise_id" id="entreprise_id" name="entreprise_id" required="true">
        	    <option value="" style="display: none;" disabled selected>{{ __('Sélectionnez l\'entreprise') }}</option>
        	@foreach ($Entreprises as $key => $Entreprise)
			    <option value="{{ $key }}">
			    	{{ $Entreprise }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('entreprise_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-xl-6 {{ $errors->has('date_sign') ? 'has-error' : '' }}">
        <label for="date_sign" class="control-label">{{ __('Date signature du contrat') }}</label>
        <input class="form-control date_sign" name="date_sign" type="date" id="date_sign" value="" placeholder="{{ trans('signers.date_sign__placeholder') }}">
        {!! $errors->first('date_sign', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="card mt-3">
    <div class="card-header" style="background-color: azure;">
        LOCALISATION DE L'OUVRAGE A CONSTRUIRE
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-xl-6 {{ $errors->has('region_id') ? 'has-error' : '' }}">
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
            <div class="col-xl-6 {{ $errors->has('canton_id') ? 'has-error' : '' }}">
                
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_edit" name="canton_id" required="true" disabled>
                        <option value="" disabled selected>Selectionner le canton</option>
                </select>        
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-xl-12 {{ $errors->has('ouvrage_id') ? 'has-error' : '' }}">
        <label for="ouvrage_id" class="control-label">{{ trans('Ouvrage à construire') }}</label>
        <select class="form-control" id="ouvrage_edit" name="ouvrage_id" disabled required="true">
            <option value="" disabled selected>{{ __('Sélectionnez l\'ouvrage à construire') }}</option>
        </select>                
        {!! $errors->first('ouvrage_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="row mt-3">
    <div class="col-xl-6 {{ $errors->has('date_debut') ? 'has-error' : '' }}">
        <label for="date_debut" class="control-label">{{ __('Ordre de service') }}</label>
        <input class="form-control date_debut" name="date_debut" type="date" id="date_debut" value="" placeholder="{{ trans('contrats.date_debut__placeholder') }}">
        {!! $errors->first('date_debut', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-xl-6 {{ $errors->has('entier') ? 'has-error' : '' }}">
        <label for="entier" class="control-label">{{ __('Durée du contrat (En jour)') }}</label>
        <input class="form-control entier_edit" name="entier" type="number" id="entier" value="" placeholder="{{ __('Durée du contrat') }}">
        {!! $errors->first('entier', '<p class="help-block">:message</p>') !!}
    </div>
</div>

