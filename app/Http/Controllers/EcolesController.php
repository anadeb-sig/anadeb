<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\Financement;
use App\Models\Village;
use App\Models\Region;
use Illuminate\Http\Request;
use Exception;
use Validator;
use DB;
class EcolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('permission:ecole-create|ecole-edit|ecole-show|ecole-destroy', ['only' => ['index']]);
        $this->middleware('permission:ecole-index', ['only' => ['index']]);
        $this->middleware('permission:ecole-create', ['only' => ['create','store']]);
        $this->middleware('permission:ecole-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ecole-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:ecole-show', ['only' => ['show']]);
        $this->middleware('permission:liste-ecole-village', ['only' => ['ecole_village']]);
        $this->middleware('permission:liste-ecole-canton', ['only' => ['ecole_canton']]);
        $this->middleware('permission:liste-ecole-commune', ['only' => ['ecole_commune']]);
        $this->middleware('permission:liste-ecole-prefecture', ['only' => ['ecole_prefecture']]);
        $this->middleware('permission:liste-ecole-region', ['only' => ['ecole_region']]);
    }

    /**
     * Display a listing of the ecoles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $ecoles = Ecole::with('village','financement')->paginate(25);

        $Villages = Village::pluck('nom_vill','id')->all();
        $Financements = Financement::pluck('nom_fin','id')->all();

        $regions = Region::all();

        return view('ecoles.index', compact('ecoles', 'Villages', 'Financements', 'regions'));
    }

    public function fetch(){
        $classes = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->select('regions.nom_reg','cantons.nom_cant', 'cantons.id as canton', 'villages.nom_vill', 'financements.nom_fin', 'ecoles.nom_ecl', 'ecoles.id', 'ecoles.nbr_ensg', 'ecoles.nbr_mamH', 'ecoles.nbr_mamF', 'status')
                    ->orderByDesc('ecoles.created_at')
                    ->get();

        return response()->json($classes);
    }

    /**
     * Show the form for creating a new 
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $Villages = Village::pluck('nom_vill','id')->all();
        $Financements = Financement::pluck('id','id')->all();
        $regions = Region::all();
        
        return view('ecoles.create', compact('Villages','Financements', 'regions'));
    }

    /**
     * Store a new ecole in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $this->getData($request);

        $data['status'] = "0";
        
        $data['nom_ecl'] = mb_strtoupper($request->nom_ecl, 'UTF-8');

        $concat = $request->village_id.''.mb_strtoupper($request->nom_ecl, 'UTF-8');
        
        $verif = new Ecole();

        $ver = $verif->verif($concat);        

        if($ver === 0){
            Ecole::create($data);
            return redirect()->route('ecoles.index')
            ->with('success_message', 'L\'école a été ajoutée avec succès.');
        }else {
            return back()->with('error_message', 'La cantine que vous tentez d\'ajouter existe déjà!');
        }
    }

    /**
     * Display the specified 
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $ecole = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
        ->join('villages', 'villages.id', '=', 'ecoles.village_id')
        ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
        ->join('communes', 'communes.id', '=', 'cantons.commune_id')
        ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
        ->join('regions', 'regions.id', '=', 'prefectures.region_id')
        ->select('regions.nom_reg', 'prefectures.nom_pref', 'communes.nom_comm', 'cantons.nom_cant', 'villages.nom_vill','financements.nom_fin', 'ecoles.nom_ecl', 'ecoles.id', 'ecoles.nbr_ensg', 'ecoles.nbr_mamF', 'ecoles.nbr_mamH', 'ecoles.nbr_pri', 'ecoles.nbr_pre', 'ecoles.nbr_mamH', 'ecoles.nbr_ensg', 'ecoles.date_debut', 'ecoles.date_fin')
        ->findOrFail($id);

        return response()->json($ecole);
    }

    /**
     * Show the form for editing the specified 
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Ecole $ecole)
    {
        return response()->json($ecole);
    }

    /**
     * Update the specified ecole in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        try {
            $data = $this->getData($request);
            $data['status'] = "0";

            $ecole = Ecole::findOrFail($request->id);
            
            $data['nom_ecl'] = mb_strtoupper($request->nom_ecl, 'UTF-8');

            $ecole->update($data);

            return redirect()->route('ecoles.index')
            ->with('success_message', 'L’école a été modifiée avec succès.');
        } catch (Exception $exception) {
            return back()->with('error_message', 'Une erreur inattendue s’est produite lors de la tentative de traitement de votre demande.');
        }       
    }

    /**
     * Remove the specified ecole from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy(Ecole $ecole)
    {
        try {
            $ecole->delete();
            return redirect()->route('ecoles.index')
            ->with('success_message', 'L’école a été supprimée avec succès.');
        } catch (Exception $exception) {
            return back()->with('error_message', 'Une erreur inattendue s’est produite lors de la tentative de traitement de votre demande.');
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'nom_ecl' => 'required|string',
            'financement_id' => 'required',
            'nbr_mamF' => 'required|numeric',
            'nbr_mamH' => 'required|numeric',
            'nbr_pri' => 'required|numeric',
            'nbr_pre' => 'required|numeric',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'nbr_ensg' => 'required|numeric',
            'village_id' => 'required|numeric',
        ];
        $data = $request->validate($rules);
        return $data;
    }

    public function updateStatus($id, $status)
    {
        // Validation
        $validate = Validator::make([
            'id'   => $id,
            'status'    => $status
        ], [
            'id'   =>  'required|exists:ecoles,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if($validate->fails()){
            return redirect()->route('ecoles.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            Ecole::whereId($id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('ecoles.index')->with('success_message','Statut de l\'école modifié avec succès!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error_message', 'Une erreur inattendue s’est produite lors de la tentative de traitement de votre demande.');
        }
    }

    public function ecole($id){
        $ecoles = Ecole::where('village_id', $id)
                        ->where('status',1)
                            ->get();
        return view('ecoles.ecole', compact('ecoles'));
    }


    public function get_options($id)
    {
        $ecoles = Ecole::where('village_id', $id)
                        ->where('status',1)
                        ->get();
        return response()->json($ecoles);
    }

    public function ecole_village(){
        return view('ecole_localite.par_village');
    }

    public function ecole_canton(){
        return view('ecole_localite.par_canton');
    }

    public function ecole_commune(){
        return view('ecole_localite.par_commune');
    }

    public function ecole_prefecture(){
        return view('ecole_localite.par_prefecture');
    }

    public function ecole_region(){
        return view('ecole_localite.par_region');
    }

    public function liste_ecole_village($village_id){
        $ecoles = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->where('village_id', $village_id)
                    ->where('status',1)
                    ->get();
                    return response()->json($ecoles);
    }
    
    public function liste_ecole_canton($canton_id){
        $ecoles = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->where('cantons.id', $canton_id)
                    ->where('ecoles.status', '=',1)
                    ->get();
        return response()->json($ecoles);
    }


    public function liste_ecole_commune($commune_id){
        $ecoles = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->where('communes.id', $commune_id)
                    ->where('status',1)
                    ->get();
        return response()->json($ecoles);
    }

    public function liste_ecole_prefecture($prefecture_id){
        $ecoles = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->where('prefectures.id', $prefecture_id)
                    ->where('status',1)
                    ->get();
        return response()->json($ecoles);
    }

    public function liste_ecole_region($region_id){
        $ecoles = Ecole::join('financements', 'financements.id', '=', 'ecoles.financement_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->where('status',1)
                    ->where('region_id', $region_id)
                    ->get();
        return response()->json($ecoles);
    }

}
