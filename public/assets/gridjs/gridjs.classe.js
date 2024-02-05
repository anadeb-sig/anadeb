import { html } from "/assets/gridjs/gridjs.module.js";

new gridjs.Grid({columns:
    ["Région", "Village", "Cantine", "Ecole","Effectif filles inscris","Effectif garçons inscris", "Actions"],
    pagination:{
        limit:10,
        enabled:true,
        summary:true
    },
    sort:!0,
    search:!0,
    server: {
        url: "classes/fetch",
        then: (data) => data.map((item) =>
            [
                item.nom_reg,
                item.nom_vill,
                item.nom_ecl,
                item.nom_cla,
                item.effec_fil,
                item.effec_gar,
                html(
                  `<div class='dropdown'>
                      <button class='btn nav-btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          <i class='uil uil-ellipsis-h'></i>
                      </button>
                      <div class='dropdown-menu dropdown-menu-end' style=''>
                          <a  href='javascript:void(0)' id='show_classe' data-url='classes/show/`+item.id+`' class='dropdown-item' title='Détail de l\'enseignement'>
                            Voir détail
                          </a>
                          <a href='javascript:void(0)' id='edit_classe' data-id='`+item.id+`' class='dropdown-item' title='Edit l\'enseignement'>
                            Editer
                          </a>
                          <a href='javascript:void(0)' id='delete_classe' data-id='`+item.id+`' class='dropdown-item' title='Supprimer l\'enseignement'>
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
}).render(document.getElementById("table_classe"));