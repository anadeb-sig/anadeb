@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<?php
    $stat = new App\Models\Repas;
    $stat_count = $stat->header_stat();

    $stat = new App\Models\Repas;
    $stat_count_nb = $stat->header_stat_nb();
    
    $gar_fil_i = new App\Models\Repas;
    $nb_inscris = $gar_fil_i->nb_inscris();

    $effec = new App\Models\Repas;
    $nb_par_ensg = $effec->nb_par_ensg();

    $cout_val = new App\Models\Repas;
    $cout = $cout_val->cout();
    
?>
    <?php
        
    ?>
    <!-- Page Heading -->

    <div class="card-body">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="mb-0 text-gray-800" style="color: #c77b39;font-size: 2em;"><i class="uil uil-university"></i>&nbsp;&nbsp;Données statistiques</h1>
            <form class="row g-3 justify-content-end">
                <div class="col-auto">
                    <label for="staticStartDate">
                        Date début
                    </label>
                    <input type="date" formcontrolname="startDate" id="staticEmail2" class="form-control ng-untouched ng-pristine ng-valid">
                </div>
                <div class="col-auto">
                    <label for="inputendDate">Date fin</label>
                    <input type="date" formcontrolname="endDate" id="inputendDate" placeholder="Date fin" class="form-control ng-untouched ng-pristine ng-valid">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn recherche" style="margin-top: 30px;">
                        <i class="fa fa-search">
                        </i>
                    </button>
                </div>
                <div class="col-auto">
                    <button class="btn recherche"  style="margin-top: 30px;">
                        <i class="fa fa-refresh-ccw"></i>
                        &nbsp;Rafraîchir 
                    </button>
                </div>
            </form>            
        </div>

        <div class="toggle-container mb-4">
            <h1 class="h1 fs-4 tbl_btn tbl_btn1  rot filtre">
                <i id="toggleIcon" class="fas fa-caret-right" style="font-size: 1.5em;"></i>
                <span style="font-size: 1.2em;">&nbsp;Sur effectif des inscrits </span>
            </h1>
            <div id="hiddenContent" class="hidden mt-3 mb-4">
                <div class="row mt-4">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header text-center" style="background-color: #126e5127;">
                                <b class="">Garçons</b>
                            </div>
                            <div class="card-body">
                                @foreach ($nb_inscris as $value)
                                    <h5 class="card-title text-center h2  fw-bold">{{ $value->gar_inscri }}</h5>
                                    <p class="card-text text-center">Inscrits</p>
                                @endforeach
                            </div>
                        </div>
                    </div>                
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header text-center" style="background-color: #126e5127;">
                                <b class="">Filles</b>
                            </div>
                            <div class="card-body">
                                @foreach ($nb_inscris as $value)
                                    <h5 class="card-title text-center h2  fw-bold"><?php echo $value->fil_inscri ?></h5>
                                    <p class="card-text text-center">Inscrits</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header text-center" style="background-color: #126e5127;">
                                <b class="">Pré-scolaire</b>
                            </div>
                            <div class="card-body">
                                @foreach ($nb_par_ensg as $value)
                                    <h5 class="card-title text-center h2  fw-bold">{{ $value->pres_gar + $value->pres_fil }}</h5>
                                    <p class="card-text text-center">Inscrits</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-header text-center" style="background-color: #126e5127;">
                                <b class="">Primaire</b>
                            </div>
                            <div class="card-body">
                                @foreach ($nb_par_ensg as $value)
                                    <h5 class="card-title text-center h2  fw-bold">{{ $value->prim_fil + $value->prim_gar }}</h5>
                                    <p class="card-text text-center">Inscrits</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header text-center" style="background-color: #126e5127;">
                                <b class="">Ecoles</b>
                            </div>
                            <div class="card-body">
                                @foreach ($stat_count_nb as $value)
                                    <h5 class="card-title text-center h2  fw-bold"><?php echo $value->nbr_pri + $value->nbr_pre ?></h5>
                                    <p class="card-text text-center">Démarrées</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header text-center" style="background-color: #126e5127;">
                                <b class="">Total</b>
                            </div>
                            <div class="card-body">
                                @foreach ($nb_inscris as $value)
                                    <h5 class="card-title text-center h2  fw-bold"><?php echo $value->gar_inscri + $value->fil_inscri ?></h5>
                                    <p class="card-text text-center">Inscrits</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="toggle-container mb-4">
            <h1 class="h1 fs-4 tbl_btn tbl_btn1  rot filtre">
                <i id="toggleIco" class="fas fa-caret-down" style="font-size: 1.5em;"></i>
                <span style="font-size: 1.2em;">&nbsp;Sur nombre de repas fournis </span>
            </h1>
            <div id="hiddenContenu" class="mt-2 mb-4">
                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Aadb') || Auth::user()->hasRole('Assistant') || Auth::user()->hasRole('Hierachie'))
                    <!-- Content Row -->
                    <div id="element_id">
                        <div class="row chart mt-4">
                            @foreach ($stat_count as $value)
                                <div class="col-xl-3 mb-4">
                                    <div class="card">
                                        <div class="card-header text-center" style="background-color: #126e5127;">
                                            <b class="">Plats aux garçons</b>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-center h2  fw-bold">{{ $value->prim_gar }}</h5>
                                            <p class="card-text text-center">Primaire</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-2 mb-4">
                                    <div class="card">
                                        <div class="card-header text-center" style="background-color: #126e5127;">
                                            <b class="">Plats aux filles</b>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-center h2  fw-bold">{{ $value->prim_fil }}</h5>
                                            <p class="card-text text-center">Primaire</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Earnings (Monthly) Card Example -->
                                <div class="col-xl-2 mb-4">                                    
                                    <div class="card">
                                        <div class="card-header text-center" style="background-color: #126e5127;">
                                            <b class="">Plats aux garçons</b>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-center h2  fw-bold">{{ $value->pres_gar }}</h5>
                                            <p class="card-text text-center">Pré-scolaire</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Requests Card Example -->
                                <div class="col-xl-2 mb-4">                                    
                                    <div class="card">
                                        <div class="card-header text-center" style="background-color: #126e5127;">
                                            <b class="">Plats aux filles</b>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-center h2  fw-bold">{{ $value->pres_fil }}</h5>
                                            <p class="card-text text-center">Pré-scolaire</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 mb-4">                                                                     
                                    <div class="card">
                                        <div class="card-header text-center" style="background-color: #126e5127;">
                                            <b class="">Montant</b>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($stat_count as $value)
                                                <h5 class="card-title text-center h2  fw-bold">{{ ($value->prim_gar + $value->prim_fil + $value->pres_gar + $value->pres_fil)*$cout }}</h5>
                                                <p class="card-text text-center">Dépensé</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="row mb-4 chart">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="piechart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="columnchart_material"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 chart">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="topXChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4 chart">
                            <div class="col-xl-12">
                                <div class="card mb-4 chart">
                                    <div class="card-body">
                                        <div id="chartContainer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toggleIco = document.getElementById('toggleIco');
            var hiddenContenu = document.getElementById('hiddenContenu');

            toggleIco.addEventListener('click', function () {
                // Toggle la classe de rotation de l'icône
                toggleIco.classList.toggle('rotate');

                // Toggle la visibilité du contenu caché
                hiddenContenu.classList.toggle('hidden');
            });
        });
    </script>

    
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        // Récupérer les données du serveur et les préparer pour le Pie Chart
        fetch('/repas/par_sexe')
            .then(response => response.json())
            .then(data => {
            
            var gar = 0;
            var fil = 0;
            data.forEach(item => {
                gar = parseInt(item.prim_gar) + parseInt(item.pres_gar);
                fil = parseInt(item.prim_fil) + parseInt(item.pres_fil);
            });

            var dataa = [
                ['Category', 'Value'],
                ['Garçons', gar],
                ['Filles', fil]
            ];
            var chartData = google.visualization.arrayToDataTable(dataa);

            var options = {
                title: 'Répartition par sexe',
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(chartData, options);
            });
        }
    </script>

    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(fetchDataAndDrawChart);
        function fetchDataAndDrawChart() {
            fetch('/repas/par_fin')
                .then(response => response.json())
                .then(data => {
                // Création d'un tableau contenant les données du graphique
                var chartData = new google.visualization.DataTable();
                chartData.addColumn('string', 'Financement');
                chartData.addColumn('number', 'Effectif');

                // Remplissage du tableau avec les données récupérées du serveur
                data.forEach(item => {
                    var rr = parseInt(item.gar) + parseInt(item.fil);
                    chartData.addRow([item.nom_fin, rr]);
                });
                // Options de configuration du graphique
                var options = {
                    chart: {
                    title: 'Effectif par financement',
                    //subtitle: 'Valeurs par financement',
                    },
                    bars: 'vertical',
                    //height: 400,
                    colors: ['#3366cc'], // Couleur des colonnes du graphique
                    vAxis: {
                    title: 'Effectif',
                    },
                    hAxis: {
                    title: 'Financement',
                    },
                };
                // Création de l'instance du graphique en colonnes
                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                // Dessin du graphique en colonnes
                chart.draw(chartData, google.charts.Bar.convertOptions(options));
            })
            .catch(error => {
            console.error('Erreur lors de la récupération des données du serveur:', error);
            });
        }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
        fetch('/repas/char_parregion')
            .then(response => response.json())
            .then(data => {
            // Construction du tableau de données pour le graphique
            const chartData = [
                ['Label', 'Effectif']
            ];
            var nom = "";
            var val = 0;
            data.forEach(item => {
                nom = item.nom_reg;
                val = parseInt(item.gar) + parseInt(item.fil);
                chartData.push([nom, val]);
            });
            // Création du graphique
            const dataTable = google.visualization.arrayToDataTable(chartData);
            const options = {
                title: 'Répartition par région',
                // Autres options de configuration du graphique
            };
            const chart = new google.visualization.BarChart(document.getElementById('topXChart'));
            chart.draw(dataTable, options);
            });
        }
    </script>

    <script>
        // Charger les données du serveur et générer le graphique à colonnes empilées
        function loadChartData() {
            // Effectuer une requête pour récupérer les données du serveur
            fetch('/repas/par_fin_date')
                .then(response => response.json())
                .then(data => {
                // Créer un tableau avec les données dans le format attendu par Google Charts
                const chartData = [['']];
                // Obtenir la liste des séries de données uniques
                const series = Array.from(new Set(data.map(row => row.nom_fin)));
                // Ajouter les séries de données au tableau chartData
                series.forEach(financement => chartData[0].push(financement));
                // Remplir le tableau avec les valeurs des séries
                const dates = Array.from(new Set(data.map(row => row.year)));
                dates.forEach(date => {
                    const chartRow = [date];
                    series.forEach(financement => {
                    const value = data.find(row => row.year === date && row.nom_fin === financement);
                    chartRow.push(value ? (parseInt(value.gar) + parseInt(value.fil)) : 0);
                    });
                    chartData.push(chartRow);
                });
                // Charger Google Charts et appeler la fonction de création du graphique
                google.charts.load('current', { packages: ['corechart'] });
                google.charts.setOnLoadCallback(() => drawChart(chartData));
            });
        }
        // Créer le graphique à colonnes empilées avec les données fournies
        function drawChart(data) {
            const dataTable = google.visualization.arrayToDataTable(data); 
            const options = {
                title: 'Effectif par année',
                isStacked: true,
                hAxis: {
                title: 'Année'
                },
                vAxis: {
                title: 'Effectif'
                },
                legend: { position: 'rigth', maxLines: 3 },
                bar: { groupWidth: '75%' },
            };
            const chart = new google.visualization.ColumnChart(document.getElementById('chartContainer'));
            chart.draw(dataTable, options);
        }
        // Appeler la fonction pour charger les données et générer le graphique
        loadChartData();
    </script>

    <script>
        function printElementAsPDF(element_id) {
            // Get the element by its ID
            const element = document.getElementById(element_id);


            // Create a new window for printing
            const printWindow = window.open('', '_blank');

            // Add the printable element to the new window's document
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printableElement.outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            // Wait for the window to finish loading
            printWindow.onload = function() {
                // Print the window
                printWindow.print();
                // Close the window after printing is done
                printWindow.close();
            };
        }

    </script>
@endsection