<input class="form-control id" name="id" type="hidden" id="id">
<div class="row">
    <div class="col-md-6 {{ $errors->has('typeouvrage_id') ? 'has-error' : '' }}">
        <label for="typeouvrage_id" class="control-label">{{ __('Type de l\'ouvrage') }}</label>
        <select class="form-control typeouvrage_id" id="typeouvrage_id" name="typeouvrage_id" required="true">
        	    <option value="" style="display: none;" disabled selected>{{ __('Selectionner le type de l\'ouvrage') }}</option>
        	@foreach ($Typeouvrages as $key => $Typeouvrage)
			    <option value="{{ $key }}">
			    	{{ $Typeouvrage }}
			    </option>
			@endforeach
        </select>
        {!! $errors->first('typeouvrage_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6 {{ $errors->has('nom_ouvrage') ? 'has-error' : '' }}">
        <label for="nom_ouvrage" class="control-label">{{ __('Nom de l\'ouvrage') }}</label>
        <input class="form-control nom_ouvrage majuscules" name="nom_ouvrage" type="text" id="nom_ouvrage" value="" min="0" max="150" placeholder="{{ __('Entrer le nom de l\'ouvrage') }}">
        {!! $errors->first('nom_ouvrage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="card mt-3">
    <div class="card-header" style="background-color: azure;">
        LOCALISATION DE L'OUVRAGE
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 {{ $errors->has('region_id') ? 'has-error' : '' }}">
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
            <div class="col-md-6 {{ $errors->has('canton_id') ? 'has-error' : '' }}">                
                <label for="canton_id" class="control-label">Canton</label>
                <select class="form-control canton_id" id="canton_edit" name="canton_id" required="true" disabled>
                        <option value="" disabled selected>Selectionner le canton</option>
                </select>        
                {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <label class="control-label">Village</label>
                <select class="form-control village_id" id="village_edit" name="village_id" disabled required="true">
                    <option value="" disabled selected>Selectionner le village</option>
                </select>
                {!! $errors->first('nom_vill', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12 {{ $errors->has('descrip') ? 'has-error' : '' }}">
        <label for="descrip" class="control-label">{{ __('Description') }}</label>
        <textarea class="form-control descrip majuscules" name="descrip" type="text" id="descrip" value="" maxlength="250" placeholder="{{ __('Entrer la description') }}"></textarea>
        {!! $errors->first('descrip', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!--
<div class="row">
    <div class="col-md-12 mt-3 {{ $errors->has('village_id') ? 'has-error' : '' }}">
        <label for="village_id" class="control-label">{{ __('Village') }}</label>
        <select class="form-control" id="village_id" name="village_id" required="true">
        	    <option value="" style="display: none;" disabled selected>{{ __('Selectionner le village') }}</option>
        	@foreach ($Villages as $key => $Village)
			    <option value="{{ $key }}">
			    	{{ $Village }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('village_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
-->

