<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#add_galerie', function(){
            $.get('galerie/create', function(res){
                $('.modal-title').text('Nouvelles photos');
                $('.add_galerie_modal').modal('show');
                $('#form')[0].reset();
            })
        });

        $('#add_galerie_btn').on('submit', function(e){
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
                    $('.add_galerie_modal').modal('hide');
                    index_suivi();
                }
            })
        });
    });

    function index_suivi(){
        $.get("{{URL::to('suivis/galerie')}}", function(data){
            $('.gridjs-table').empty().html(data);
        })
    }
</script>