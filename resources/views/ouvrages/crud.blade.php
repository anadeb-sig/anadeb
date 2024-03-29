<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#show_ouvrage', function(){
            var url = $(this).data('url');
            $.get(url, function(data){
                $('.modal-title').text('Détail de l\'ouvrage n°'+data.id);
                $('.show_ouvrage_modal').modal('show');
                    $('#show_id').text(data.id);
                    $('#show_nom_ouvrage').text(data.nom_ouvrage);
                    $('#show_nom_vill').text(data.nom_vill);                    
                    $('#show_nom_cant').text(data.nom_cant);                    
                    $('#show_nom_comm').text(data.nom_comm);                    
                    $('#show_descrip').text(data.descrip);                    
                    $('#show_nom_type').text(data.nom_type);
            })
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#add_ouvrage', function(){
            $.get('/ouvrages/create', function(res){
                $('.modal-title').text('Nouveau ouvrage');
                $('.add_ouvrage_modal').modal('show');
                $('#form')[0].reset();
            })
        });

        $('#add_ouvrage_btn').on('submit', function(e){
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
                    $('.add_ouvrage_modal').modal('hide');
                    index_ouvrage();
                }
            })
        });

        $('body').on('click', '#edit_ouvrage', function(){
            var id = $(this).data('id');
            $.get('/ouvrages/'+id+'/edit', function(res){
                $('.modal-title').text('Modification de l\' ouvrage n°'+id);
                $('.edit_ouvrage_modal').modal('show');
                $('.id').val(id);
                $('.nom_ouvrage').val(res.nom_ouvrage);
                $('.typeouvrage_id').val(res.typeouvrage_id);
                $('.nom_type').val(res.nom_type);
                $('.descrip').val(res.descrip);
            })
        });

        $('#edit_ouvrage_btn').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,form, function(data){
                $('.edit_ouvrage_modal').modal('hide');
                $('#form')[0].reset();
                index_ouvrage();
            })
        });

        $('body').on('click', '#delete_ouvrage', function(e){
            e.preventDefault();
            var id = $(this).data('id');
                $('.modal-title').text('Suppression de l\'ouvrage n°'+id);
                $('.delete_ouvrage_modal').modal('show');
                $('#btn_delete_ouvrage').val(id);
                $('#form')[0].reset();
        });

        $('#btn_delete_ouvrage').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'DELETE',
                url: '/ouvrages/'+id
            });
            $('#form')[0].reset();
            $('.delete_ouvrage_modal').modal('hide');
            location.reload(true);
        });
    });


    function index_ouvrage(){
        $.get("{{URL::to('ouvrages')}}", function(data){
            $('.gridjs-table').empty().html(data);
        })
    }
</script>