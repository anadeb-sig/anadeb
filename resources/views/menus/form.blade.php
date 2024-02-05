<input class="form-control id" name="id" type="hidden" id="id">
<div class="row {{ $errors->has('nom_menu') ? 'has-error' : '' }}">
    <div class="col-xl-12">
        <label for="nom_menu" class="control-label">Nom du menu</label>
        <input class="form-control nom_menu majuscules" name="nom_menu" type="text" id="nom_menu" maxlength="150" placeholder="Enter nom menu here...">
        {!! $errors->first('nom_menu', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mt-4 {{ $errors->has('cout_unt') ? 'has-error' : '' }}">
    <div class="col-xl-12">
        <label for="cout_unt" class="control-label">Coût unitaire</label>
        <input class="form-control cout_unt" name="cout_unt" type="number" id="cout_unt" min="-2147483648" max="2147483647" placeholder="Enter cout unt here...">
        {!! $errors->first('cout_unt', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mt-4 {{ $errors->has('date_debut') ? 'has-error' : '' }}">
    <div class="col-xl-12">
        <label for="date_debut" class="control-label">Date début</label>
        <input class="form-control date_debut" name="date_debut" type="date" id="date_debut" required>
        {!! $errors->first('date_debut', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row mt-4 {{ $errors->has('date_fin') ? 'has-error' : '' }}">
    <div class="col-xl-12">
        <label for="date_fin" class="control-label">Date fin</label>
        <input class="form-control date_fin" name="date_fin" type="date" id="date_fin" required>
        {!! $errors->first('date_fin', '<p class="help-block">:message</p>') !!}
    </div>
</div>



