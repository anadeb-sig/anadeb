<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#show_ecole', function(){
            var url = $(this).data('url');
            /**var nom_reg = $(this).data('nom_reg');
            var nom_pref = $(this).data('nom_pref');
            var nom_comm = $(this).data('nom_comm');
            var nom_cant = $(this).data('nom_cant');
            var nom_vill = $(this).data('nom_vill');
            var nom_fin = $(this).data('nom_fin');*/
            $.get(url, function(data){
                $('.modal-title').text('Détail de la cantine n°'+data.id);
                $('.show_ecole_modal').modal('show');
                    $('#show_id').text(data.id);
                    $('#show_nom_ecl').text(data.nom_ecl);
                    $('#show_nom_vill').text(data.nom_vill);
                    $('#show_nom_fin').text(data.nom_fin);
                    $('#show_nbr_ensg').text(data.nbr_ensg);
                    $('#show_nbr_mamF').text(data.nbr_mamF);
                    $('#show_nbr_mamH').text(data.nbr_mamH);
                    $('#show_nbr_pri').text(data.nbr_pri);
                    $('#show_nbr_pre').text(data.nbr_pre);
                    $('#show_nbr_ensg').text(data.nbr_ensg);
                    $('#show_date_debut').text(data.date_debut);
                    $('#show_date_fin').text(data.date_fin);
                    if(data.status==1){
                        $('#show_status').text("En cours d'exécution");
                    }else{
                        $('#show_status').text("Non démarré");
                    }
                    $('#show_nom_vill').text(data.nom_vill);
                    $('#show_nom_cant').text(data.nom_cant);
                    $('#show_nom_comm').text(data.nom_comm);
                    $('#show_nom_pref').text(data.nom_pref);
                    $('#show_nom_reg').text(data.nom_reg);
                    $('#show_form')[0].reset();
            })
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#add_ecole', function(){
            $.get('/ecoles/create', function(res){
                $('.modal-title').text('Nouvelle cantine');
                $('.add_ecole_modal').modal('show');
                $('#form')[0].reset();
            })
        });

        $('#add_ecole_btn').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: form,
                dataType: 'json',
                success: function(){
                    $('#form')[0].reset();
                    $('.add_ecole_modal').modal('hide');
                    index_ecole();
                }
            })
        });

        $('body').on('click', '#edit_ecole', function(){
            var id = $(this).data('id');
            $.get('/ecoles/'+id+'/edit', function(res){
                $('.modal-title').text('Modification de la cantine n°'+id);
                $('.edit_ecole_modal').modal('show');
                $('.id').val(id);
                $('.nom_ecl').val(res.nom_ecl);
                $('.nbr_ensg').val(res.nbr_ensg);
                $('.nbr_mamH').val(res.nbr_mamH);
                $('.nbr_mamF').val(res.nbr_mamF);
                $('.nbr_pri').val(res.nbr_pri);
                $('.nbr_pre').val(res.nbr_pre);
                $('.date_fin').val(res.date_fin);
                $('.status').val(res.status);
                $('.date_debut').val(res.date_debut);
                $('.financement_id').val(res.financement_id);
                $('.village_id').val(res.village_id);
                $('#form')[0].reset();
            })
        });

        $('#edit_ecole_btn').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,form, function(data){
                $('.edit_ecole_modal').modal('hide');
                $('#form')[0].reset();
                index_ecole();
            })
        });

        $('body').on('click', '#delete_ecole', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.modal-title').text('Suppression de la cantine n°'+id);
            $('.delete_ecole_modal').modal('show');
            $('#btn_delete_ecole').val(id);
            $('#form')[0].reset();
        });

        $('#btn_delete_ecole').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'DELETE',
                url: "ecoles/destroy/"+id
            });
            console.log(url);
            $('#form')[0].reset();
            $('.delete_ecole_modal').modal('hide');
            location.reload(true);            
        });
    });


    function index_ecole(){
        $.get("{{URL::to('ecoles')}}", function(data){
            $('.gridjs-table').empty().html(data);
        })
    }
</script>