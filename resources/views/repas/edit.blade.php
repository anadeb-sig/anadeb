<!-- Full screen modal content -->
<div class="modal fade edit_repas_modal" tabindex="-1" aria-labelledby="edit_repas_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="saveform_errList_edit" style="list-style-type: none;"></ul>
                <input name="_method" type="hidden" value="PUT">
                @include ('repas.form_edit')
                <div class="row" style="float: right;">
                    <div class="col-ms-12 mt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary edit_repas_btn">Mettre à jour</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>