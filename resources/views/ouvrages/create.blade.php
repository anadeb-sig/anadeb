<div class="modal fade add_ouvrage_modal" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">        
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form method="POST" action="{{ route('ouvrages.store') }}" accept-charset="UTF-8" id="create_ouvrage_form" name="create_ouvrage_form" class="form-horizontal">
                {{ csrf_field() }}
                    @include ('ouvrages.form', [
                                            'ouvrage' => null,
                                        ])
                    <hr>
                    <div class="row" style="float: right;">
                        <div class="col-ms-12 mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button id="add_ouvrage_btn" type="submit" class="btn btn-primary">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


