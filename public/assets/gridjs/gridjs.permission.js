import { html } from "/assets/gridjs/gridjs.module.js";

new gridjs.Grid({columns:
    ["Permission", "Titre", "Actions"],
    pagination:{
        limit:20,
        enabled:true,
        summary:true
    },
    sort:!0,
    search:!0,
    server: {
        url: "/permissions/fetch",
        then: (data) => data.map((item) =>
            [
                item.name,  
                item.guard_name,            
                html(
                  "<div class='btn-group btn-group-xs pull-right' role='group' id='actions'>"+
                    "<a href='permissions/edit/"+item.id+"' class='btn btn-primary m-1' title='Editer la permission'>"+
                        "<span class='fa fa-pen' aria-hidden='true'></span>"+
                    "</a>"+
                    "<a href='javascript:void(0)' id='delete_permission' data-id='"+item.id+"' class='btn btn-danger m-1' title='Supprimer la permission'>"+
                        "<span class='fa fa-trash' aria-hidden='true'></span>"+
                    "</a>"+
                "</div>"
                )
            ]
        ),
    },
    style: {
        th: {
          'text-align': 'center'
        },
        td: {
          'text-align': 'center',
        }
      },
    language: {
        'search': {
          'placeholder': '🔍 Recherche...'
        },
        'pagination': {
          'previous': 'Précédent',
          'next': 'Suivant',
          'showing': '😃 Affichage de ',
          'results': () => 'enregistrements'
        }
      }
}).render(document.getElementById("table_permission"));