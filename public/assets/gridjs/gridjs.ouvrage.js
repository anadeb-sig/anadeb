import { Grid, html } from "/assets/gridjs/gridjs.module.js";
new gridjs.Grid({columns:
    ["Ouvrage", "Description", "Type ouvrage", "Village", "Actions"],
    pagination:{
        limit:10,
        enabled:true,
        summary:true
    },
    sort:!0,
    search:!0,
    server: {
        url: "ouvrages/fetch",
        then: (data) => data.map((item) =>
            [
                item.nom_ouvrage,
                item.descrip,
                item.nom_type,
                item.nom_vill,
                html(
                  `<div class='dropdown'>
                      <button class='btn nav-btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          <i class='uil uil-ellipsis-h'></i>
                      </button>
                      <div class='dropdown-menu dropdown-menu-end' style=''>
                          <a href='javascript:void(0)' id='show_ouvrage' data-url='ouvrages/show/`+item.id+`' data-id='`+item.id+`' class='dropdown-item'>
                            Voir détail
                          </a>
                          <a href='javascript:void(0)' id='edit_ouvrage' data-id='`+item.id+`' class='dropdown-item'>
                            Editer
                          </a>
                          <a href='javascript:void(0)' id='delete_ouvrage' data-id='`+item.id+`' class='dropdown-item'>
                            Supprimer
                          </a>
                      </div>
                  </div>`
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
}).render(document.getElementById("table_ouvrage"));