<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Ouvrage;
use App\Models\Signer;
use Carbon\Carbon;
use App\Models\Region;
use Exception;
use DB;

class ContratsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:contrat-create|contrat-edit|contrat-show|contrat-destroy', ['only' => ['index']]);
        $this->middleware('permission:contrat-index', ['only' => ['index']]);
        $this->middleware('permission:contrat-create', ['only' => ['create','store']]);
        $this->middleware('permission:contrat-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contrat-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:contrat-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the contrats.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $regions = Region::all();
        $contrats = Contrat::all();
        $Ouvrages = Ouvrage::all();
        $Entreprises = Entreprise::pluck('nom_entrep','id')->all();

        return view('contrats.index', compact('regions', 'contrats','Ouvrages','Entreprises'));
    }

    public function fetch(){
        $contrats = Contrat::join('signers', 'signers.contrat_id', '=', 'contrats.id' )
                    ->join('entreprises', 'entreprises.id', '=', 'signers.entreprise_id' )
                    ->select('contrats.id', 'contrats.date_debut', 'date_fin', 'entreprises.nom_entrep', 'entreprises.tel', 'entreprises.email')
                    ->orderByDesc('signers.created_at')
                    ->get();
        return response()->json($contrats);
    }

    /**
     * Show the form for creating a new contrat.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   $regions = Region::all();
        $Ouvrages = Ouvrage::all();
        $Entreprises = Entreprise::pluck('nom_entrep','id')->all();
        return view('contrats.create', compact('regions', 'Ouvrages','Entreprises'));
    }

    /**
     * Store a new contrat in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $date = Carbon::create($data["date_debut"]);

            $entier = $request->entier;

            // Ajouter l'entier à la date
            $nouvelleDate = $date->addDays($entier);

            $data["date_fin"] = $nouvelleDate->toDateString();

            $id = DB::table('contrats')->insertGetId($data);

                $dataa = $this->getDataa($request);
                $dataa['contrat_id'] = $id;

                //dd($dataa);

                Signer::create($dataa);
                return redirect()->route('contrats.index')->with('success_message', 'Contrat ajouté avec succès');
         
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['error_message' => trans('contrats.unexpected_error')]);
        } 
    }

    /**
     * Display the specified contrat.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $contrat = Contrat::join('signers', 'signers.contrat_id', '=', 'contrats.id')
        ->join('entreprises', 'entreprises.id', '=', 'signers.entreprise_id' )
        ->select('contrats.id', 'contrats.date_debut', 'date_fin', 'entreprises.nom_entrep', 'entreprises.email', 'entreprises.prenom_charge', 'entreprises.nom_charge', 'entreprises.tel', 'entreprises.email')
        ->findOrFail($id);
        return response()->json($contrat);
    }

    /**
     * Show the form for editing the specified contrat.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $contrat = Contrat::join('signers', 'signers.contrat_id', '=', 'contrats.id')
        ->join('entreprises', 'entreprises.id', '=', 'signers.entreprise_id' )
        ->join('ouvrages', 'ouvrages.id', '=', 'signers.ouvrage_id' )
        ->select('contrats.id', 'signers.id as iid', 'contrats.date_debut', 'date_fin', 'ouvrage_id', 'signers.date_sign', 'entreprise_id', 'ouvrage_id')
        ->findOrFail($id);
        return response()->json($contrat);
    }

    /**
     * Update the specified contrat in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        //dd($request->all());
        try {
            
            $data = $this->getData($request);

            $date = Carbon::create($data["date_debut"]);

            $entier = $request->entier;

            // Ajouter l'entier à la date
            $nouvelleDate = $date->addDays($entier);

            $data["date_fin"] = $nouvelleDate->toDateString();
            
            $contrat = Contrat::findOrFail($request->id);
            $contrat->update($data);

            $dataa = $this->getDataa($request);
            
            $dataa['contrat_id'] = $request->id;

            $signer = Signer::findOrFail($request->iid);

            $signer->update($dataa);

            return redirect()->route('contrats.index')
                ->with('success_message', 'Contrat modifié avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('contrats.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified contrat from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $contrat = Contrat::findOrFail($id);
            $contrat->delete();

            return redirect()->route('contrats.contrat.index')
                ->with('success_message', trans('contrats.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('contrats.unexpected_error')]);
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
            'date_debut' => 'required',
        ];

        $data = $request->validate($rules);
        return $data;
    }

    protected function getDataa(Request $request)
    {
        $rules = [
            'ouvrage_id' => 'required',
            'entreprise_id' => 'required',
            'date_sign' => 'nullable', 
        ];        
        $data = $request->validate($rules);        
        return $data;
    }

}
