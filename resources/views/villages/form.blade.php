<input class="form-control id" name="id" type="hidden" id="id">
<div class="row mb-3">
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
        <select class="form-control canton_id" id="canton_comm" name="canton_id" required="true" disabled required="true">
        	    <option value="" disabled selected>Selectionner le canton</option>
        </select>        
        {!! $errors->first('canton_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nom_vill') ? 'has-error' : '' }}">
    <div class="col-xl-12">
        <label for="nom_vill" class="control-label">Village</label>
        <input class="form-control nom_vill majuscules" name="nom_vill" type="text" id="nom_vill" maxlength="150" placeholder="Entrer le nom du village ici..." required="true">
        {!! $errors->first('nom_vill', '<p class="help-block">:message</p>') !!}
    </div>
</div>

