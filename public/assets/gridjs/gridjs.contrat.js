import { Grid, html } from "/assets/gridjs/gridjs.module.js";

function jourscontrat(date10, date20){
  // Créez deux objets Date avec vos dates
  var date1 = new Date(date10);
  var date2 = new Date(date20);
  if(date1 < date2) {
    var differenceEnMillisecondes = (date2-date1);
    // Convertissez la différence en jours
    var differenceEnJours = differenceEnMillisecondes/(1000*60*60*24);
    return differenceEnJours;
  }else if(date1 > date2) {
    var differenceEnMillisecondes = (date1-date2);
    // Convertissez la différence en jours
    var differenceEnJours = differenceEnMillisecondes/(1000*60*60*24);
    return differenceEnJours;
  }else{
    return "0";
  }
}

function diffdate(date20, mail){
  // Créez deux objets Date avec vos dates
  var date1 = new Date();
  var date2 = new Date(date20);

  var differenceEnJours = parseInt((date2-date1)/(1000*60*60*24));

  if(differenceEnJours <= -45){
    return html("<div class='badge bg-secondary font-size-12'>"+parseInt(differenceEnJours)*(-1)+" Jour(s) de pénalité</div>");
  }else if(differenceEnJours < 0 ){
    return html("<a class='badge bg-danger font-size-12' href='mailto:"+mail+"'>"+parseInt(differenceEnJours)*(-1)+" jour(s) de pénalité</a>");
  }else if(differenceEnJours === 0){
    return html("<a class='badge bg-warning font-size-12' href='mailto:"+mail+"'>Contrat est à terme!</a>");
  }else if(differenceEnJours > 0){
    return html("<a class='badge bg-success font-size-12'>"+parseInt(differenceEnJours)+" Jour(s) du contrat</a>");
  }
}
new gridjs.Grid({columns:
    ["Entreprise", "Ordre de service", "Durée du contrat", ,"Pénalité", "Actions"],
    pagination:{
        limit:20,
        enabled:true,
        summary:true
    },
    sort:!0,
    search:!0,
    server: {
        url: "contrats/fetch",
        then: (data) => data.map((item) =>
            [
                item.nom_entrep,
                item.date_debut,
                jourscontrat(item.date_debut, item.date_fin),
                diffdate(item.date_fin, item.email),
                html(
                  `<div class='dropdown'>
                      <button class='btn nav-btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          <i class='uil uil-ellipsis-h'></i>
                      </button>
                      <div class='dropdown-menu dropdown-menu-end' style=''>
                          <a href='javascript:void(0)' id='show_contrat' data-url='contrats/show/`+item.id+`' data-id='`+item.id+`' class='dropdown-item'>
                            Voir détail
                          </a>
                          <a href='javascript:void(0)' id='edit_contrat' data-id='`+item.id+`' class='dropdown-item'>
                            Editer
                          </a>
                          <a href='javascript:void(0)' id='delete_contrat' data-id='`+item.id+`' class='dropdown-item'>
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
}).render(document.getElementById("table_contrat"));