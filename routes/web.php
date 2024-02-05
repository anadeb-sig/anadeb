<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcolesController;
use App\Http\Controllers\VillagesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\RepasController;
use App\Http\Controllers\CantonsController;
use App\Http\Controllers\CommunesController;
use App\Http\Controllers\FinancementsController;
use App\Http\Controllers\PrefecturesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\VisitesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ContratsController;
use App\Http\Controllers\EntreprisesController;
use App\Http\Controllers\TypeouvragesController;
use App\Http\Controllers\OuvragesController;
use App\Http\Controllers\SignersController;
use App\Http\Controllers\SuivisController;

Route::middleware(['public.api'])->group(function () {
    Route::get('public/api/data', 'App\Http\Controllers\PublicController@index')->name('data');
});


//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->group(function(){
    Route::post('profil', [UserController::class, 'update_avatar'])->name('update_avatar');
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::prefix('roles')->name('roles.')->group(function(){
    Route::get('/', [RolesController::class, 'index'])->name('index');
    Route::get('/create', [RolesController::class, 'create'])->name('create');
    Route::post('/store', [RolesController::class, 'store'])->name('store');
    Route::get('/edit/{role}', [RolesController::class, 'edit'])->name('edit');
    Route::put('/update/{role}', [RolesController::class, 'update'])->name('update');
    Route::delete('/destroy/{role}', [RolesController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [RolesController::class, 'fetch']);
});

// Permissions
Route::prefix('permissions')->name('permissions.')->group(function(){
    Route::get('/', [PermissionsController::class, 'index'])->name('index');
    Route::get('/create', [PermissionsController::class, 'create'])->name('create');
    Route::post('/store', [PermissionsController::class, 'store'])->name('store');
    Route::get('/edit/{permission}', [PermissionsController::class, 'edit'])->name('edit');
    Route::post('/update/{permission}', [PermissionsController::class, 'update'])->name('update');
    Route::delete('/destroy/{permission}', [PermissionsController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [PermissionsController::class, 'fetch']);
});

// Users
Route::prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');
    Route::get('fetch', [UserController::class, 'fetch']);

    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
});


Route::prefix('ecoles')->name('ecoles.')->group(function()
{
    Route::get('ecole_par_region',[EcolesController::class, 'ecole_region']);
    Route::get('ecole_par_region/{region}',[EcolesController::class, 'liste_ecole_region']);
    Route::get('ecole_par_prefecture',[EcolesController::class, 'ecole_prefecture']);
    Route::get('ecole_par_prefecture/{prefecture}',[EcolesController::class, 'liste_ecole_prefecture']);
    Route::get('ecole_par_commune',[EcolesController::class, 'ecole_commune']);
    Route::get('ecole_par_commune/{commune}',[EcolesController::class, 'liste_ecole_commune']);
    Route::get('ecole_par_canton',[EcolesController::class, 'ecole_canton']);
    Route::get('ecole_par_canton/{canton}',[EcolesController::class, 'liste_ecole_canton']);
    Route::get('ecole_par_village',[EcolesController::class, 'ecole_village']);
    Route::get('ecole_par_village/{village}',[EcolesController::class, 'liste_ecole_village']);
    Route::get('/', [EcolesController::class, 'index'])->name('index');
    Route::get('/create', [EcolesController::class, 'create'])->name('create');
    Route::get('/show/{ecole}',[EcolesController::class, 'show'])->name('show');
    Route::get('/{ecole}/edit',[EcolesController::class, 'edit'])->name('edit');
    Route::post('/', [EcolesController::class, 'store'])->name('store');
    Route::put('ecole/', [EcolesController::class, 'update'])->name('update');
    Route::delete('/destroy/{ecole}',[EcolesController::class, 'destroy']);
    Route::get('fetch', [EcolesController::class, 'fetch']);
    Route::get('/update/status/{id}/{status}', [EcolesController::class, 'updateStatus'])->name('status');
    Route::get('get-options/{ecole}',[EcolesController::class, 'get_options']);
    Route::get('/{ecole}',[EcolesController::class, 'ecole']);
    Route::get('get-options/{village}',[EcolesController::class, 'get_options']);
    Route::get('canton/{canton}',[CantonsController::class, 'ecoleCanton']);
});

Route::prefix('villages')->name('villages.')->group(function(){
    Route::get('/', [VillagesController::class, 'index'])->name('index');
    Route::get('/create', [VillagesController::class, 'create'])->name('create');
    Route::get('/show/{village}',[VillagesController::class, 'show'])->name('show');
    Route::get('/{village}/edit',[VillagesController::class, 'edit'])->name('edit');
    Route::post('/', [VillagesController::class, 'store'])->name('store');
    Route::put('village/', [VillagesController::class, 'update'])->name('update');
    Route::delete('/{village}',[VillagesController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [VillagesController::class, 'fetch']);
    Route::get('/{village}',[VillagesController::class, 'village']);
    Route::get('get-options/{village}',[VillagesController::class, 'get_options']);
    Route::get('get-option/{village}',[VillagesController::class, 'get_option']);
});
Route::prefix('classes')->name('classes.')->group(function(){
    Route::get('/', [ClassesController::class, 'index'])->name('index');
    Route::get('/zero', [ClassesController::class, 'index_zero'])->name('index_zero');
    Route::get('/create', [ClassesController::class, 'create'])->name('create');
    Route::get('/show/{classe}',[ClassesController::class, 'show'])->name('show');
    Route::get('/{classe}/edit',[ClassesController::class, 'edit'])->name('edit');
    Route::post('/', [ClassesController::class, 'store'])->name('store');
    Route::put('classe/', [ClassesController::class, 'update'])->name('update');
    Route::delete('/destroy/{classe}',[ClassesController::class, 'destroy'])->name('destroy');
    Route::get('/fetch/zero', [ClassesController::class, 'ecoleazero']);
    Route::get('fetch', [ClassesController::class, 'fetch']);
    Route::get('/{classe}',[ClassesController::class, 'classe']);
    Route::get('get-options/{classe}',[ClassesController::class, 'get_options']);
    Route::get('ecole/{classe}',[ClassesController::class, 'classeEcole']);
});

Route::prefix('menus')->name('menus.')->group(function(){
    Route::get('/', [MenusController::class, 'index'])->name('index');
    Route::get('/create', [MenusController::class, 'create'])->name('create');
    Route::get('/show/{menu}',[MenusController::class, 'show'])->name('show');
    Route::get('/{menu}/edit',[MenusController::class, 'edit'])->name('edit');
    Route::post('/', [MenusController::class, 'store'])->name('store');
    Route::put('menu/', [MenusController::class, 'update'])->name('update');
    Route::get('/update/status/{id}/{statut}', [MenusController::class, 'updateStatut'])->name('statut');
    Route::delete('/{menu}',[MenusController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [MenusController::class, 'fetch']);
});

Route::prefix('repas')->name('repas.')->group(function(){
    Route::get('/', [RepasController::class, 'index'])->name('index');
    Route::get('test/{repas}', [RepasController::class, 'test']);
    Route::get('/create', [RepasController::class, 'create'])->name('create');
    Route::get('/create_syngle', [RepasController::class, 'create_syngle']);
    Route::get('/show/{repas}',[RepasController::class, 'show'])->name('show');
    Route::get('/{repas}/edit',[RepasController::class, 'edit'])->name('edit');
    Route::post('/', [RepasController::class, 'store'])->name('store');
    Route::post('/syngle', [RepasController::class, 'store_syngle'])->name('store_syngle');
    Route::put('/{repas}', [RepasController::class, 'update']);
    Route::delete('/{repas}',[RepasController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [RepasController::class, 'fetch']);
    Route::get('synthese/arf', [RepasController::class, 'synthese_arf'])->name('synthese_arf');
    Route::get('synthese/ecole', [RepasController::class, 'synthese_ecole'])->name('synthese_ecole');
    Route::get('synthese/canton', [RepasController::class, 'synthese_canton'])->name('synthese_canton');
    Route::get('synthese/commune', [RepasController::class, 'synthese_commune'])->name('synthese_commune');
    Route::get('synthese/prefecture', [RepasController::class, 'synthese_prefecture'])->name('synthese_prefecture');
    Route::get('synthese/region', [RepasController::class, 'synthese_region'])->name('synthese_region');
    Route::get('synthese/comptabilite', [RepasController::class, 'synthese_comptabilite'])->name('synthese_comptabilite');
    Route::get('arf', [RepasController::class, 'arf'])->name('arf');
    //Route::get('tout_arf', [RepasController::class, 'tout_arf']);
    //Route::post('arff', [RepasController::class, 'arff'])->name('arff');
    Route::get('compta', [RepasController::class, 'par_compta'])->name('compta');
    Route::get('ecole', [RepasController::class, 'par_ecole'])->name('par_ecole');
    Route::get('canton', [RepasController::class, 'par_canton'])->name('canton');
    Route::get('commune', [RepasController::class, 'par_commune'])->name('commune');
    Route::get('prefecture', [RepasController::class, 'par_prefecture'])->name('prefecture');
    Route::get('region', [RepasController::class, 'par_region'])->name('region');
    Route::post('import', [RepasController::class, 'import'])->name('import');

    /** Les statistiques */
    Route::get('par_sexe', [RepasController::class, 'char_parsexe'])->name('par_sexe');
    Route::get('par_fin', [RepasController::class, 'char_parfinancement'])->name('par_fin');
    Route::get('par_fin_date', [RepasController::class, 'char_parfinancement_date'])->name('par_fin_date');
    Route::get('char_parregion', [RepasController::class, 'char_parregion'])->name('char_parregion');
});

Route::prefix('cantons')->name('cantons.')->group(function(){
    Route::get('/', [CantonsController::class, 'index'])->name('index');
    Route::get('/create', [CantonsController::class, 'create'])->name('create');
    Route::get('/show/{canton}',[CantonsController::class, 'show'])->name('show');
    Route::get('/{canton}/edit',[CantonsController::class, 'edit'])->name('edit');
    Route::post('/', [CantonsController::class, 'store'])->name('store');
    Route::put('canton/', [CantonsController::class, 'update'])->name('update');
    Route::delete('/{canton}',[CantonsController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [CantonsController::class, 'fetch']);
    //Route::get('/{canton}',[CantonsController::class, 'canton']);
    Route::get('get-options/{canton}',[CantonsController::class, 'get_options']);
    Route::get('/{canton}',[CantonsController::class, 'cantonRegion']);
    Route::get('canton/{canton}',[CantonsController::class, 'cantonRegions']);
});

Route::prefix('communes')->name('communes.')->group(function(){
    Route::get('/', [CommunesController::class, 'index'])->name('index');
    Route::get('/create', [CommunesController::class, 'create'])->name('create');
    Route::get('/show/{commune}',[CommunesController::class, 'show'])->name('show');
    Route::get('/{commune}/edit',[CommunesController::class, 'edit'])->name('edit');
    Route::post('/', [CommunesController::class, 'store'])->name('store');
    Route::put('commune/', [CommunesController::class, 'update'])->name('update');
    Route::delete('{commune}',[CommunesController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [CommunesController::class, 'fetch']);
    Route::get('/{commune}',[CommunesController::class, 'commune']);
    Route::get('get-options/{commune}',[CommunesController::class, 'get_options']);
});

Route::prefix('financements')->name('financements.')->group(function(){
    Route::get('/', [FinancementsController::class, 'index'])->name('index');
    Route::get('/create', [FinancementsController::class, 'create'])->name('create');
    Route::get('/show/{financement}',[FinancementsController::class, 'show'])->name('show');
    Route::get('/{financement}/edit',[FinancementsController::class, 'edit'])->name('edit');
    Route::post('/', [FinancementsController::class, 'store'])->name('store');
    Route::put('financement/', [FinancementsController::class, 'update'])->name('update');
    Route::delete('/{financement}',[FinancementsController::class, 'destroy']);
    Route::get('fetch', [FinancementsController::class, 'fetch']);
});

Route::prefix('prefectures')->name('prefectures.')->group(function(){
    Route::get('/', [PrefecturesController::class, 'index'])->name('index');
    Route::get('/create', [PrefecturesController::class, 'create'])->name('create');
    Route::get('/show/{prefecture}',[PrefecturesController::class, 'show'])->name('show');
    Route::get('/{prefecture}/edit',[PrefecturesController::class, 'edit'])->name('edit');
    Route::post('/', [PrefecturesController::class, 'store'])->name('store');
    Route::put('prefecture/', [PrefecturesController::class, 'update'])->name('update');
    Route::delete('/{prefecture}',[PrefecturesController::class, 'destroy'])->name('destroy');
    Route::get('/fetch', [PrefecturesController::class, 'fetch']);
    Route::get('/{prefecture}',[PrefecturesController::class, 'prefecture']);
    
});

Route::prefix('regions')->name('regions.')->group(function(){
    Route::get('/', [RegionsController::class, 'index'])->name('index');
    Route::get('/create', [RegionsController::class, 'create'])->name('create');
    Route::get('/show/{region}',[RegionsController::class, 'show'])->name('show');
    Route::get('/{region}/edit',[RegionsController::class, 'edit'])->name('edit');
    Route::post('/', [RegionsController::class, 'store'])->name('store');
    Route::put('region/', [RegionsController::class, 'update'])->name('update');
    Route::delete('/{region}',[RegionsController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [RegionsController::class, 'fetch']);
    Route::get('/autocomplete_ecl', [RegionsController::class, 'autorecherche_ecl']);
    Route::get('/autocomplete_cant', [RegionsController::class, 'autorecherche_cant']);
    Route::get('/autocomplete_comm', [RegionsController::class, 'autorecherche_comm']);
    Route::get('/autocomplete_pref', [RegionsController::class, 'autorecherche_pref']);
    Route::get('/autocomplete_reg', [RegionsController::class, 'autorecherche_reg']);
    Route::get('/autocomplete_fin', [RegionsController::class, 'autorecherche_fin']);
});

Route::prefix('visites')->name('visites.')->group(function(){
    Route::get('/', [VisitesController::class, 'index'])->name('index');
    Route::get('/create', [VisitesController::class, 'create'])->name('create');
    Route::get('/show/{visite}',[VisitesController::class, 'show'])->name('show');
    Route::get('/{visite}/edit',[VisitesController::class, 'edit'])->name('edit');
    Route::post('/', [VisitesController::class, 'store'])->name('store');
    Route::put('visite/', [VisitesController::class, 'update'])->name('update');
    Route::delete('/{visite}',[VisitesController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [VisitesController::class, 'fetch']);
});

Route::prefix('contrats')->name('contrats.')->group(function()
{
    Route::get('/', [ContratsController::class, 'index'])->name('index');
    Route::get('/create', [ContratsController::class, 'create'])->name('create');
    Route::get('/show/{contrat}',[ContratsController::class, 'show'])->name('show');
    Route::get('/{contrat}/edit',[ContratsController::class, 'edit'])->name('edit');
    Route::post('/', [ContratsController::class, 'store'])->name('store');
    Route::put('/{contrat}', [ContratsController::class, 'update'])->name('update');
    Route::delete('/{contrat}',[ContratsController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [ContratsController::class, 'fetch']);
});

Route::prefix('entreprises')->name('entreprises.')->group(function()
{
    Route::get('/', [EntreprisesController::class, 'index'])->name('index');
    Route::get('/create', [EntreprisesController::class, 'create'])->name('create');
    Route::get('/show/{entreprise}',[EntreprisesController::class, 'show'])->name('show');
    Route::get('/{entreprise}/edit',[EntreprisesController::class, 'edit'])->name('edit');
    Route::post('/', [EntreprisesController::class, 'store'])->name('store');
    Route::put('entreprise/', [EntreprisesController::class, 'update'])->name('update');
    Route::delete('/{entreprise}',[EntreprisesController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [EntreprisesController::class, 'fetch']);
});

Route::prefix('typeouvrages')->name('typeouvrages.')->group(function()
{
    Route::get('/', [TypeouvragesController::class, 'index'])->name('index');
    Route::get('/create', [TypeouvragesController::class, 'create'])->name('create');
    Route::get('/show/{typeouvrage}',[TypeouvragesController::class, 'show'])->name('show');
    Route::get('/{typeouvrage}/edit',[TypeouvragesController::class, 'edit'])->name('edit');
    Route::post('/', [TypeouvragesController::class, 'store'])->name('store');
    Route::put('/{typeouvrage}', [TypeouvragesController::class, 'update'])->name('update');
    Route::delete('/{typeouvrage}',[TypeouvragesController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [TypeouvragesController::class, 'fetch']);
});

Route::prefix('ouvrages')->name('ouvrages.')->group(function()
{
    Route::get('/', [OuvragesController::class, 'index'])->name('index');
    Route::get('/create', [OuvragesController::class, 'create'])->name('create');
    Route::get('/show/{ouvrage}',[OuvragesController::class, 'show'])->name('show');
    Route::get('/{ouvrage}/edit',[OuvragesController::class, 'edit'])->name('edit');
    Route::post('/', [OuvragesController::class, 'store'])->name('store');
    Route::put('ouvrage/', [OuvragesController::class, 'update'])->name('update');
    Route::delete('/{ouvrage}',[OuvragesController::class, 'destroy'])->name('destroy');
    Route::get('get-options/{village}',[OuvragesController::class, 'get_option']);
    Route::get('fetch', [OuvragesController::class, 'fetch']);
});

Route::prefix('signers')->name('signers.')->group(function()
{
    Route::get('/', [SignersController::class, 'index'])->name('index');
    Route::get('/create', [SignersController::class, 'create'])->name('create');
    Route::get('/show/{signer}',[SignersController::class, 'show'])->name('show');
    Route::get('/{signer}/edit',[SignersController::class, 'edit'])->name('edit');
    Route::post('/', [SignersController::class, 'store'])->name('store');
    Route::put('signer/', [SignersController::class, 'update'])->name('update');
    Route::delete('/{signer}',[SignersController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [SignersController::class, 'fetch']);
});

Route::prefix('suivis')->name('suivis.')->group(function()
{
    Route::get('/', [SuivisController::class, 'index'])->name('index');
    Route::get('/create', [SuivisController::class, 'create'])->name('create');
    Route::get('galerie/create', [SuivisController::class, 'create_photos'])->name('galerie.create');
    Route::get('/show/{suivi}',[SuivisController::class, 'show'])->name('show');
    Route::get('/{suivi}/edit',[SuivisController::class, 'edit'])->name('edit');
    Route::post('/', [SuivisController::class, 'store'])->name('store');
    Route::post('galerie/', [SuivisController::class, 'store_photos'])->name('galerie.store');
    Route::put('suivi/', [SuivisController::class, 'update'])->name('update');
    Route::delete('/{suivi}',[SuivisController::class, 'destroy'])->name('destroy');
    Route::get('fetch', [SuivisController::class, 'fetch']);
    Route::get('galerie', [SuivisController::class, 'galerie'])->name('galerie');
    Route::get('get-options/{village}',[SuivisController::class, 'get_options']);
    Route::get('galerie/get_option/{canton}',[SuivisController::class, 'get_option']);
});