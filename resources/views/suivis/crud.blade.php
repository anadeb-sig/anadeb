<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#show_suivi', function(){
            var url = $(this).data('url');
            var cheminImage = "images";
            var monImage = document.getElementById("monImage");
            $.get(url, function(data){
                console.log(data);
                $('.modal-title').text('Détail du suivi n°'+data.id);
                $('.show_suivi_modal').modal('show');
                    $('#show_id').text(data.id);
                    $('#show_nom_ouvrage').text(data.nom_ouvrage);
                    $('#show_descrip').text(data.descrip);
                    $('#show_niveau_exe').text(data.niveau_exe);
                    $('#show_village').text(data.nom_vill);
                    $('#show_canton').text(data.nom_cant);
                    $('#show_commune').text(data.nom_comm);
                    $('#show_prefecture').text(data.nom_pref);
                    $('#show_region').text(data.nom_reg);
                    $('#show_conf_plan').text(data.conf_plan);
                    $('#show_photo').text(data.photo);
                    monImage.src = cheminImage+"/"+data.photo;
                    $('#show_date_suivi').text(data.date_suivi);
            })
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#add_suivi', function(){
            $.get('/suivis/create', function(res){
                $('.modal-title').text('Nouveau suivi');
                $('.add_suivi_modal').modal('show');
                $('#form')[0].reset();
            })
        });

        $('#add_suivi_btn').on('submit', function(e){
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
                    $('.add_suivi_modal').modal('hide');
                    index_suivi();
                }
            })
        });

        $('body').on('click', '#edit_suivi', function(){
            var id = $(this).data('id');
            $.get('/suivis/'+id+'/edit', function(res){
                console.log(res);
                $('.modal-title').text('Modification du suivi n°'+id);
                $('.edit_suivi_modal').modal('show');
                $('.id').val(id);
                $('.signe_id').val(res.signe_id);
                $('.descrip').val(res.descrip);
                $('.niveau_exe').val(res.niveau_exe);
                $('.date_suivi').val(res.date_suivi);
                $('.conf_plan').val(res.conf_plan);
                $('.photo').val(res.photo);
            })
        });

        $('#edit_suivi_btn').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,form, function(data){
                $('.edit_suivi_modal').modal('hide');
                $('#form')[0].reset();
                index_suivi();
            })
        });

        $('body').on('click', '#delete_suivi', function(e){
            e.preventDefault();
            var id = $(this).data('id');
                $('.modal-title').text('Suppression du suivi n°'+id);
                $('.delete_suivi_modal').modal('show');
                $('#btn_delete_suivi').val(id);
                $('#form')[0].reset();
        });

        $('#btn_delete_suivi').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'DELETE',
                url: '/suivis/'+id
            });
            $('#form')[0].reset();
            $('.delete_suivi_modal').modal('hide');
            location.reload(true);
        });
    });

    function index_suivi(){
        $.get("{{URL::to('suivis')}}", function(data){
            $('.gridjs-table').empty().html(data);
        })
    }
</script>