import { html } from "/assets/gridjs/gridjs.module.js";

function statut(status){
  if(status == 0){
    return "<span class='fa fa-danger'>Inactive</span>"
  }else{
    return "<span class='fa fa-success'>Active</span>"
  }
}

function statut_icons(id, status){
  if (status == 0){
    return "<a href='/users/update/status/"+id+"/1' class='btn btn-success m-1'>"+
          "<i class='fa fa-check'></i>"+
      "</a>"
  }else{
    return "<a href='/users/update/status/"+id+"/0' class='btn btn-danger m-1'>"+
          "<i class='fa fa-ban'></i>"+
      "</a>"
  }
}

new gridjs.Grid({columns:
    ["Nom et prénom(s)", "Email", "Téléphone", "Rôle", "Statut", "Actions"],
    pagination:{
        limit:10,
        enabled:true,
        summary:true
    },
    sort:!0,
    search:!0,
    server: {
        url: "users/fetch",
        then: (data) => data.map((item) =>
            [
                item.last_name+' '+item.first_name,  
                item.email,               
                item.mobile_number,              
                item.name,               
                html(statut(item.status)),
                html(
                  "<div class='btn-group btn-group-xs pull-right' role='group' id='actions'>"+
                    statut_icons(item.id, item.status)+
                    "<a href='users/edit/"+item.id+"' class='btn btn-primary m-1' title='Editer l\'utilisateur'>"+
                        "<span class='fa fa-pen' aria-hidden='true'></span>"+
                    "</a>"+
                    "<a href='javascript:void(0)' id='delete_user' data-id='"+item.id+"' class='btn btn-danger m-1' title='Supprimer l\'utilisateur'>"+
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
}).render(document.getElementById("table_user"));