<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#show_repas', function(){
            var url = $(this).data('url');
            var id = $(this).data('id');
            $.get(url, function(data){
                $('.modal-title').text('Détail du repas n°'+id);
                $('.show_repas_modal').modal('show');
                $('#show_effect_gar').text(data.effect_gar);
                $('#show_effect_fil').text(data.effect_fil);
                $('#show_nom_cla').text(data.nom_cla);
                $('#show_nom_ecl').text(data.nom_ecl);
                $('#show_date_rep').text(data.date_rep);
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

        $('body').on('click', '#add_repas', function(){
            $.get('/repas/create', function(res){
                $('.modal-title').text('Nouveau repas');
                $('.add_repas_modal').modal('show');
                //$('#form')[0].reset();
            })
        });

        $(document).on('click', '.add_repas_btn', function(e){
            e.preventDefault();

            // Récupérer la région
            // Récupérer l'élément select
            var selectElement = document.getElementById("region_comm_2");
            // Récupérer l'option sélectionnée
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var dataNomValue = selectedOption.getAttribute("data-reg");

            // Récupérer la région
            // Récupérer l'élément select
            var selectCanton = document.getElementById("canton_comm_2");
            // Récupérer l'option sélectionnée
            var optionCanton = selectCanton.options[selectCanton.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var cantonValue = optionCanton.getAttribute("data-cant");

            // Récupérer la région
            // Récupérer l'élément select
            var selectEcole = document.getElementById("ecole_comm_2");
            // Récupérer l'option sélectionnée
            var optionEcole = selectEcole.options[selectEcole.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var ecoleValue = optionEcole.getAttribute("data-ecl");

            var inputElement = document.getElementById("monInput0");
            // Récupérer la valeur de l'attribut data-nom
            var cla0 = inputElement.getAttribute("data-id0");

            console.log(cla0);
            var inputEl = document.getElementById("monInput1");
            // Récupérer la valeur de l'attribut data-nom
            var cla1 = inputEl.getAttribute("data-id1");


            var data = {
                'classe_id0': $('.classe_id0').val(), 
                'effect_fil_0': $('.effect_fil_0').val(), 
                'effect_gar_0': $('.effect_gar_0').val(),

                'classe_id1': $('.classe_id1').val(),
                'effect_fil_1': $('.effect_fil_1').val(), 
                'effect_gar_1': $('.effect_gar_1').val(),

                'date_rep1': $('.date_rep1').val(),
                
                'test0':dataNomValue+''+cantonValue+''+ecoleValue+''+cla0+''+$('.date_rep1').val(),
                'test1':dataNomValue+''+cantonValue+''+ecoleValue+''+cla1+''+$('.date_rep1').val()
            };
            
            console.log(data);

            $.ajax({
                type: 'post',
                url: '/repas/',
                data: data,
                dataType: 'json',
                success: function(response){
                    if(response.status == 400){
                        $('#saveform_errList_1').html("");
                        $('#saveform_errList_1').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values){
                            $('#saveform_errList_1').append('<li>'+err_values+'</li>');
                        });
                    }else if(response.status == 10){
                        $('#saveform_errList_1').html("");
                        $('#saveform_errList_1').addClass('alert alert-danger');
                        $('#saveform_errList_1').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 11){
                        $('#saveform_errList_1').html("");
                        $('#saveform_errList_1').addClass('alert alert-danger');
                        $('#saveform_errList_1').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 12){
                        $('#saveform_errList_1').html("");
                        $('#saveform_errList_1').addClass('alert alert-danger');
                        $('#saveform_errList_1').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 13){
                        $('#saveform_errList_1').html("");
                        $('#saveform_errList_1').addClass('alert alert-danger');
                        $('#saveform_errList_1').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 200){
                        //$('#form')[0].reset();
                        $('#add_repas_modal').modal('hide');
                        window.location.href = "{{URL::to('repas')}}";
                        //index_repas();
                    }
                }

            })
        });


        $('body').on('click', '#add_repas_syngle', function(){
            $.get('/repas/create_syngle', function(res){
                $('.modal-title').text('Nouveau repas');
                $('.add_repas_syngle_modal').modal('show');
                //$('#form')[0].reset();
            })
        });

        $(document).on('click', '.add_repas_syngle_btn', function(e){
            e.preventDefault();
            // Récupérer la région
            // Récupérer l'élément select
            var selectElement = document.getElementById("region_comm");
            // Récupérer l'option sélectionnée
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var dataNomValue = selectedOption.getAttribute("data-reg");

            // Récupérer la région
            // Récupérer l'élément select
            var selectCanton = document.getElementById("canton_comm");
            // Récupérer l'option sélectionnée
            var optionCanton = selectCanton.options[selectCanton.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var cantonValue = optionCanton.getAttribute("data-cant");

            // Récupérer la région
            // Récupérer l'élément select
            var selectEcole = document.getElementById("ecole_comm");
            // Récupérer l'option sélectionnée
            var optionEcole = selectEcole.options[selectEcole.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var ecoleValue = optionEcole.getAttribute("data-ecl");
            // Récupérer la région
            // Récupérer l'élément select
            var selectClasse = document.getElementById("classe_c");
            // Récupérer l'option sélectionnée
            var optionClasse = selectClasse.options[selectClasse.selectedIndex];
            // Récupérer la valeur de l'attribut data-nom
            var classeValue = optionClasse.getAttribute("data-cla");
            

            var data = {
                'classe_id': $('.classe_id').val(), 
                'effect_fil': $('.effect_fil').val(), 
                'effect_gar': $('.effect_gar').val(),
                'date_rep': $('.date_rep').val(),
                'test':dataNomValue+''+cantonValue+''+ecoleValue+''+classeValue+''+$('.date_rep').val()
            };
            
            $.ajax({
                type: 'post',
                url: '/repas/syngle',
                data: data,
                dataType: 'json',
                success: function(response){
                    if(response.status == 400){
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values){
                            $('#saveform_errList').append('<li>'+err_values+'</li>');
                        });
                        //console.log(response.errors);
                    }else if(response.status == 10){
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $('#saveform_errList').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 11){
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $('#saveform_errList').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 12){
                        $('#saveform_errList').html("");
                        $('#saveform_errList').addClass('alert alert-danger');
                        $('#saveform_errList').append('<li>'+response.errors+'</li>');
                    }else if(response.status == 200){
                        //$('#form')[0].reset();
                        $('#add_repas_modal').modal('hide');
                        window.location.href = "{{URL::to('repas')}}";
                        //index_repas();
                    }
                }

            })
        });

        $('body').on('click', '#edit_repas', function(){
            var id = $(this).data('id');
            var url = '/repas/'+id+'/edit';
            $.get(url, function(data){
                $('.modal-title').text('Modification du repas n°'+id);
                $('.edit_repas_modal').modal('show');
                $('.id').val(id);
                $('.edit_effect_gar').val(data.effect_gar);
                $('.edit_effect_fil').val(data.effect_fil);
                //$('.edit_classe_id').val(data.classe_id);
                //$('.menu_id').val(data.menu_id);
                $('.edit_date_rep').val(data.date_rep);
                //$('#form')[0].reset();
            })
        });
        $(document).on('click', '.edit_repas_btn', function(e){
            e.preventDefault();
            var id = $('.id').val();
            var data = {
                'id': $('.id').val(),
                'classe_id': $('.edit_classe_id').val(),
                //'menu_id': $('.menu_id').val(),
                'effect_gar': $('.edit_effect_gar').val(),
                'effect_fil': $('.edit_effect_fil').val(),
                'date_rep': $('.edit_date_rep').val(),
            };

            console.log(data);

            $.ajax({
                    type: 'put',
                    url: '/repas/'+id,
                    data: data,
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 400){
                            $('#saveform_errList_edit').html("");
                            $('#saveform_errList_edit').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values){
                                $('#saveform_errList_edit').append('<li>'+err_values+'</li>');
                            });
                            console.log(response.errors);
                        }else if(response.status == 10){
                            $('#saveform_errList_edit').html("");
                            $('#saveform_errList_edit').addClass('alert alert-danger');
                            $('#saveform_errList_edit').append('<li>'+response.errors+'</li>');
                        }else if(response.status == 11){
                            $('#saveform_errList_edit').html("");
                            $('#saveform_errList_edit').addClass('alert alert-danger');
                            $('#saveform_errList_edit').append('<li>'+response.errors+'</li>');
                        }else if(response.status == 200){
                            //$('#form')[0].reset();
                            $('#edit_repas_modal').modal('hide');
                            window.location.href = "{{URL::to('repas')}}";
                            //index_repas();
                        }                    
                    }
                })
            });

        $('body').on('click', '#delete_repas', function(e){
            e.preventDefault();
            var id = $(this).data('id');
                $('.modal-title').text('Suppression du repas n°'+id);
                $('.delete_repas_modal').modal('show');
                $('#btn_delete_repas').val(id);
                $('#form')[0].reset();
        });

        $('#btn_delete_repas').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'DELETE',
                url: '/repas/'+id
            });
            //$('#form')[0].reset();
            $('.delete_repas_modal').modal('hide');
            location.reload(true);
        });
    });


    function index_repas(){
        $.get("{{URL::to('repas')}}", function(data){
            $('.gridjs-table').empty().html(data);
        })
    }
</script>