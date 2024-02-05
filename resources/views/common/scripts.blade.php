<!--Pour filtre la liste-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggleIcon = document.getElementById('toggleIcon');
        var hiddenContent = document.getElementById('hiddenContent');

        toggleIcon.addEventListener('click', function () {
            // Toggle la classe de rotation de l'icône
            toggleIcon.classList.toggle('rotate');

            // Toggle la visibilité du contenu caché
            hiddenContent.classList.toggle('hidden');
        });
    });
</script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('assets/libs/query/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js')}}"></script>

<script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js')}}"></script>

<!--Faire autocomplet-->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--Fin faire autocomplet-->

<script src="{{ asset('assets/js/app.js')}}"></script>
<script src="{{ asset('assets/libs/gridjs/dist_gridjs.production.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#region_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/prefectures/'+ value;
            var prefecture_comm = $('#prefecture_comm');
            prefecture_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    prefecture_comm.html('<option value="">Sélectionnez une option</option>');
                $.each(data, function(index, option) {
                    prefecture_comm.append('<option value="' + option.id + '" data-nom_pref="' + option.nom_pref + '">' + option.nom_pref + '</option>');
                });
                prefecture_comm.prop('disabled', false);
                },
                error: function() {
                    prefecture_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                prefecture_comm.html('<option value="">Sélectionnez une option</option>');
                prefecture_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#region_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/cantons/' + value;
            var commune_comm = $('#commune_comm');    
            commune_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    commune_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    commune_comm.append('<option value="' + option.id + '">' + option.nom_comm + '</option>');
                });          
                commune_comm.prop('disabled', false);
                },
                error: function() {
                    commune_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                commune_comm.html('<option value="">Sélectionnez une option</option>');
                commune_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#region_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/cantons/canton/' + value;
            var canton_comm = $('#canton_comm');
            canton_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    canton_comm.html('<option value="">Sélectionnez une option</option>');
                $.each(data, function(index, option) {
                    canton_comm.append('<option value="' + option.id + '" data-cant="' + option.nom_cant + '">' + option.nom_cant + '</option>');
                });
                canton_comm.prop('disabled', false);
                },
                error: function() {
                    canton_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                canton_comm.html('<option value="">Sélectionnez une option</option>');
                canton_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#region_comm_2').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/cantons/canton/' + value;
            var canton_comm = $('#canton_comm_2');
            canton_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    canton_comm.html('<option value="">Sélectionnez une option</option>');     
                $.each(data, function(index, option) {
                    canton_comm.append('<option value="' + option.id + '" data-cant="' + option.nom_cant + '">' + option.nom_cant + '</option>');
                });
                canton_comm.prop('disabled', false);
                },
                error: function() {
                    canton_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                canton_comm.html('<option value="">Sélectionnez une option</option>');
                canton_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ecoles/canton/' + value;
            var ecole_comm = $('#ecole_comm');
            ecole_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ecole_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ecole_comm.append('<option value="' + option.id + '"  data-ecl="' + option.nom_ecl + '">' + option.nom_ecl+ '</option>');
                });          
                ecole_comm.prop('disabled', false);
                },
                error: function() {
                    ecole_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ecole_comm.html('<option value="">Sélectionnez une option</option>');
                ecole_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_comm_2').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ecoles/canton/' + value;
            var ecole_comm = $('#ecole_comm_2');
            ecole_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ecole_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ecole_comm.append('<option value="' + option.id + '"  data-ecl="' + option.nom_ecl + '">' + option.nom_ecl+ '</option>');
                });          
                ecole_comm.prop('disabled', false);
                },
                error: function() {
                    ecole_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ecole_comm.html('<option value="">Sélectionnez une option</option>');
                ecole_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/villages/get-option/' + value;
            var village_comm = $('#village_comm');    
            village_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    village_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    village_comm.append('<option value="' + option.id + '">' + option.nom_vill+ '</option>');
                });          
                village_comm.prop('disabled', false);
                },
                error: function() {
                    village_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                village_comm.html('<option value="">Sélectionnez une option</option>');
                village_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#village_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ecoles/get-options/' + value;
            var ecole_comm = $('#ecole_comm');    
            ecole_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ecole_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ecole_comm.append('<option value="' + option.id + '">' + option.nom_ecl+ '</option>');
                });          
                ecole_comm.prop('disabled', false);
                },
                error: function() {
                    ecole_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ecole_comm.html('<option value="">Sélectionnez une option</option>');
                ecole_comm.prop('disabled', true);
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#ecole_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/classes/ecole/' + value;
            var classe_comm = $('#classe_c');
            classe_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    classe_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    classe_comm.append('<option value="' + option.id + '" data-cla="' + option.nom_cla + '">' + option.nom_cla+ '</option>');
                });          
                classe_comm.prop('disabled', false);
                },
                error: function() {
                    classe_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                classe_comm.html('<option value="">Sélectionnez une option</option>');
                classe_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#ecole_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/classes/ecole/' + value;
            var classe_comm = $('#classe_com');
            classe_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    classe_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    classe_comm.append('<option value="' + option.id + '" data-cla="' + option.nom_cla + '">' + option.nom_cla+ '</option>');
                });          
                classe_comm.prop('disabled', false);
                },
                error: function() {
                    classe_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                classe_comm.html('<option value="">Sélectionnez une option</option>');
                classe_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#ecole_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/classes/get-options/' + value;
            var classe_comm = $('#classe_comm'); 
            classe_comm.empty();   
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        $.each(data, function(index, option) {
                            classe_comm.append('<input style="display:none;" name="classe_id[]"  data-cla="' + option.nom_cla + '" data-id="' + option.nom_cla + '" value="' + option.id + '">');
                        });
                    }else{
                        classe_comm.append('<span style="color: red;font-size: 1.2em;"> Aucune école n\'est associée à cette cantine!</span>');
                    }
                },
                error: function() {
                    //classe_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                //classe_comm.html('<option value="">Sélectionnez une option</option>');
                //classe_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#ecole_comm_2').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/classes/get-options/' + value;
            var classe_comm = $('#classe_comm_2'); 
            classe_comm.empty();   
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        $.each(data, function(index, option) {
                            classe_comm.append('<input id="monInput'+index+'" style="display:none;" class="classe_id'+index+'" name="classe_id'+index+'" data-id'+index+'="' + option.nom_cla + '" value="' + option.id + '">');
                        });
                    }else{
                        classe_comm.append('<span style="color: red;font-size: 1.2em;"> Aucune école n\'est associée à cette cantine!</span>');
                    }
                },
                error: function() {
                    //classe_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                //classe_comm.html('<option value="">Sélectionnez une option</option>');
                //classe_comm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#ecole_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/classes/get-options/' + value;
            var classe_commm = $('#classe_commm');    
            classe_commm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    classe_commm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    classe_commm.append('<option value="' + option.id + '">' + option.nom_cla+ '</option>');
                });          
                classe_commm.prop('disabled', false);
                },
                error: function() {
                    classe_commm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                classe_commm.html('<option value="">Sélectionnez une option</option>');
                classe_commm.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_comm').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ouvrages/get-options/' + value;
            var ouvrage_comm = $('#ouvrage_comm');    
            ouvrage_comm.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ouvrage_comm.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ouvrage_comm.append('<option value="' + option.id + '">' + option.nom_ouvrage+ '</option>');
                });          
                ouvrage_comm.prop('disabled', false);
                },
                error: function() {
                    ouvrage_comm.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ouvrage_comm.html('<option value="">Sélectionnez une option</option>');
                ouvrage_comm.prop('disabled', true);
            }
        });
    });
</script>


<!-- Edite -->
<script>
    $(document).ready(function() {
        $('#region_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/cantons/' + value;
            var commune_edit = $('#commune_edit');
            commune_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    commune_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    commune_edit.append('<option value="' + option.id + '">' + option.nom_comm + '</option>');
                });          
                commune_edit.prop('disabled', false);
                },
                error: function() {
                    commune_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                commune_edit.html('<option value="">Sélectionnez une option</option>');
                commune_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ecoles/canton/' + value;
            var ecole_edit = $('#ecole_edit');
            ecole_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ecole_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ecole_edit.append('<option value="' + option.id + '">' + option.nom_ecl+ '</option>');
                });          
                ecole_edit.prop('disabled', false);
                },
                error: function() {
                    ecole_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ecole_edit.html('<option value="">Sélectionnez une option</option>');
                ecole_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#region_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/cantons/canton/' + value;
            var canton_edit = $('#canton_edit');    
            canton_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    canton_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    canton_edit.append('<option value="' + option.id + '">' + option.nom_cant + '</option>');
                });          
                canton_edit.prop('disabled', false);
                },
                error: function() {
                    canton_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                canton_edit.html('<option value="">Sélectionnez une option</option>');
                canton_edit.prop('disabled', true);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#region_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/communes/get-options/' + value;
            var prefecture_edit = $('#prefecture_edit');    
            prefecture_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    prefecture_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    prefecture_edit.append('<option value="' + option.id + '">' + option.nom_pref + '</option>');
                });          
                prefecture_edit.prop('disabled', false);
                },
                error: function() {
                    prefecture_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                prefecture_edit.html('<option value="">Sélectionnez une option</option>');
                prefecture_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#prefecture_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/cantons/get-options/' + value;
            var commune_edit = $('#commune_edit');    
            commune_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    commune_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    commune_edit.append('<option value="' + option.id + '">' + option.nom_comm + '</option>');
                });          
                commune_edit.prop('disabled', false);
                },
                error: function() {
                    commune_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                commune_edit.html('<option value="">Sélectionnez une option</option>');
                commune_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#commune_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/villages/get-options/' + value;
            var canton_edit = $('#canton_edit');    
            canton_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    canton_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    canton_edit.append('<option value="' + option.id + '">' + option.nom_cant+ '</option>');
                });          
                canton_edit.prop('disabled', false);
                },
                error: function() {
                    canton_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                canton_edit.html('<option value="">Sélectionnez une option</option>');
                canton_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/villages/get-option/' + value;
            var village_edit = $('#village_edit');    
            village_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    village_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    village_edit.append('<option value="' + option.id + '">' + option.nom_vill+ '</option>');
                });          
                village_edit.prop('disabled', false);
                },
                error: function() {
                    village_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                village_edit.html('<option value="">Sélectionnez une option</option>');
                village_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#village_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ecoles/get-options/' + value;
            var ecole_edit = $('#ecole_edit');    
            ecole_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ecole_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ecole_edit.append('<option value="' + option.id + '">' + option.nom_ecl+ '</option>');
                });          
                ecole_edit.prop('disabled', false);
                },
                error: function() {
                    ecole_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ecole_edit.html('<option value="">Sélectionnez une option</option>');
                ecole_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#ecole_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/classes/get-options/' + value;
            var classe_edit = $('#classe_edit');    
            classe_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    classe_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    classe_edit.append('<option value="' + option.id + '">' + option.nom_cla+ '</option>');
                });          
                classe_edit.prop('disabled', false);
                },
                error: function() {
                    classe_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                classe_edit.html('<option value="">Sélectionnez une option</option>');
                classe_edit.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#canton_edit').change(function() {
            var value = $(this).val();
            var selectedOption = $(this).find('option:selected');
            var url = '/ouvrages/get-options/' + value;
            var ouvrage_edit = $('#ouvrage_edit');    
            ouvrage_edit.prop('disabled', true).html('<option value="">Chargement en cours...</option>');    
            if (url) {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    ouvrage_edit.html('<option value="">Sélectionnez une option</option>');          
                $.each(data, function(index, option) {
                    ouvrage_edit.append('<option value="' + option.id + '">' + option.nom_ouvrage+ '</option>');
                });          
                ouvrage_edit.prop('disabled', false);
                },
                error: function() {
                    ouvrage_edit.html('<option value="">Erreur de chargement</option>');
                }
            });
            } else {
                ouvrage_edit.html('<option value="">Sélectionnez une option</option>');
                ouvrage_edit.prop('disabled', true);
            }
        });
    });
</script>