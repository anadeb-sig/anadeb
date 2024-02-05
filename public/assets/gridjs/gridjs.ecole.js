import { Grid, html } from "/assets/gridjs/gridjs.module.js";

function statut(status){
  if(status == 0){
    return "<span class='fa fa-danger'>Inactive</span>"
  }else{
    return "<span class='fa fa-success'>Active</span>"
  }
}

function statut_icons(id, status){
  if (status == 0){
    return "<a href='/ecoles/update/status/"+id+"/1' class='dropdown-item'>"+
          "Activer"+
      "</a>"
  }else{
    return "<a href='/ecoles/update/status/"+id+"/0' class='dropdown-item'>"+
          "Désactiver"+
      "</a>"
  }
}

new gridjs.Grid({columns:
    ["Région", "Canton", "Village","Cantine", "Financement", 'Statut', "Actions"],
    pagination:{
        limit:10,
        enabled:true,
        summary:true
    },
    sort:!0,
    search:!0,
    server: {
        url: "ecoles/fetch",
        then: (data) => data.map((item) =>
            [
                item.nom_reg, 
                item.nom_cant, 
                item.nom_vill, 
                item.nom_ecl, 
                item.nom_fin,               
                html(statut(item.status)),
                html(

                `<div class='dropdown'>
                      <button class='btn nav-btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          <i class='uil uil-ellipsis-h'></i>
                      </button>
                      <div class='dropdown-menu dropdown-menu-end' style=''>
                        `+statut_icons(item.id, item.status)+`
                          <a  href='javascript:void(0)' id='show_ecole' data-url='ecoles/show/`+item.id+`' class='dropdown-item' title=''>
                            Voir détail
                          </a>
                          <a href='javascript:void(0)' id='edit_ecole' data-id='`+item.id+`' class='dropdown-item' title=''>
                            Editer
                          </a>
                          <a href='javascript:void(0)' id='delete_ecole' data-id='`+item.id+`' class='dropdown-item' title=''>
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
}).render(document.getElementById("table_ecole"));