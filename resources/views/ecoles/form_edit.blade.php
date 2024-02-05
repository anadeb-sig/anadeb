<input class="form-control id" name="id" type="hidden" id="id">
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="{{ $errors->has('nom_ecl') ? 'has-error' : '' }}">
            <label for="nom_ecl" class="control-label">Nom de la cantine</label>
            <input class="form-control nom_ecl majuscules" name="nom_ecl" type="text" required id="nom_ecl" maxlength="150" placeholder="Enter nom ecl here...">
            {!! $errors->first('nom_ecl', '<p class="help-block">:message</p>') !!}
        </div>
    </div><!-- end col -->
    <div class="col-xl-4 {{ $errors->has('financement_id') ? 'has-error' : '' }}">
        <label for="financement_id" class="control-label">Financement</label>
        <select class="form-control financement_id" id="financement_id" name="financement_id" required>
        	<option value="" style="display: none;" disabled selected>Select financement</option>
        	@foreach ($Financements as $key => $Financement)
			    <option value="{{ $key }}">
			    	{{ $Financement }}
			    </option>
			@endforeach
        </select>
        {!! $errors->first('financement_id', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
    <div class="col-xl-4 {{ $errors->has('nbr_ensg') ? 'has-error' : '' }}">
        <label for="nbr_ensg" class="control-label">Nombre d'enseignants</label>
        <input class="form-control nbr_ensg" required name="nbr_ensg" type="number" id="" placeholder="Enter nbr ensg here...">
        {!! $errors->first('nbr_ensg', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
</div>

<div class="row mb-4">
    <div class="col-xl-6{{ $errors->has('nbr_mamF') ? 'has-error' : '' }}">
        <label for="nbr_mamF" class="control-label">Effectif de mamans cantines femmes</label>
        <input class="form-control nbr_mamF" name="nbr_mamF" type="number" id="" required placeholder="Enter nbr mam f here...">
        {!! $errors->first('nbr_mamF', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
    <div class="col-xl-6{{ $errors->has('effec_fil') ? 'has-error' : '' }}">
        <label for="nbr_mamH" class="control-label">Effectif de mamans cantines hommes</label>
        <input class="form-control nbr_mamH" name="nbr_mamH" type="number" required id="" placeholder="Enter nbr mam h here...">
        {!! $errors->first('nbr_mamH', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
</div><!-- end row -->
<div class="row mb-4 ">
    <div class="col-xl-6">
        <div class="{{ $errors->has('nbr_pri') ? 'has-error' : '' }}">
            <label for="nbr_pri" class="control-label">Nombre de groups du primaire</label>
            <input class="form-control nbr_pri" name="nbr_pri" type="number" required id="" placeholder="Enter nbr pri here...">
            {!! $errors->first('nbr_pri', '<p class="help-block">:message</p>') !!}
        </div>
    </div><!-- end col -->
    <div class="col-xl-6{{ $errors->has('nbr_pre') ? 'has-error' : '' }}">
        <label for="nbr_pre" class="control-label">Nombre de groups pré-scolaire</label>
        <input class="form-control nbr_pre" name="nbr_pre" type="number" required id="" placeholder="Enter nbr pre here...">
        {!! $errors->first('nbr_pre', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-xl-6{{ $errors->has('nbr_mamF') ? 'has-error' : '' }}">
        <label for="date_debut" class="col-xl-2 control-label">Date Debut</label>
        <input class="form-control date_debut" name="date_debut" type="date" required id="" placeholder="Enter date debut here...">
        {!! $errors->first('date_debut', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
    <div class="col-xl-6 {{ $errors->has('nbr_pre') ? 'has-error' : '' }}">
        <label for="date_fin" required class="col-xl-2 control-label">Date Fin</label>
        <input class="form-control date_fin" name="date_fin" type="date" id="" placeholder="Enter date fin here...">
        {!! $errors->first('date_fin', '<p class="help-block">:message</p>') !!}
    </div><!-- end col -->
</div><!-- end row -->

<div class="card mt-4">
    <div class="card-header" style="background-color: azure;">
        DONNEES DE LOCALISATION
    </div>
    <div class="card-body">
        <div class="row mb-4">
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
                <label class="control-label">Village</label>
                <select class="form-control" id="village_edit" name="village_id" disabled required="true">
                    <option value="" disabled selected>Selectionner le village</option>
                </select>
                {!! $errors->first('nom_vill', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>

