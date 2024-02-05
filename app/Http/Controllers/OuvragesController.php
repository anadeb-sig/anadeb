<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ouvrage;
use App\Models\Typeouvrage;
use App\Models\Village;
use App\Models\Region;
use Illuminate\Http\Request;
use Exception;

class OuvragesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ouvrage-create|ouvrage-edit|ouvrage-show|ouvrage-destroy', ['only' => ['index']]);
        $this->middleware('permission:ouvrage-index', ['only' => ['index']]);
        $this->middleware('permission:ouvrage-create', ['only' => ['create','store']]);
        $this->middleware('permission:ouvrage-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ouvrage-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:ouvrage-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the ouvrages.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $regions = Region::all();
        $ouvrages = Ouvrage::with('village','typeouvrage')->paginate(25);
        $Villages = Village::pluck('nom_vill','id')->all();
        $Typeouvrages = Typeouvrage::pluck('nom_type','id')->all();
        
        return view('ouvrages.index', compact('ouvrages', 'regions', 'Villages','Typeouvrages'));
    }

    public function fetch(){
        $ouvrages = Ouvrage::join('typeouvrages', 'typeouvrages.id', '=', 'ouvrages.typeouvrage_id' )
                    ->join('villages', 'villages.id', '=', 'ouvrages.village_id' )
                    ->select('ouvrages.id', 'ouvrages.nom_ouvrage', 'ouvrages.descrip', 'villages.nom_vill', 'typeouvrages.nom_type')
                    ->orderByDesc('ouvrages.created_at')
                    ->get();
        return response()->json($ouvrages);
    }

    /**
     * Show the form for creating a new ouvrage.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $Villages = Village::pluck('nom_vill','id')->all();
        $Typeouvrages = Typeouvrage::pluck('nom_type','id')->all();
        $regions = Region::all();
        return view('ouvrages.create', compact('Villages', 'regions', 'Typeouvrages'));
    }

    /**
     * Store a new ouvrage in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);

            $data['nom_ouvrage'] = mb_strtoupper($request->nom_ouvrage, 'UTF-8');
            $data['descrip'] = mb_strtoupper($request->descrip, 'UTF-8');

            Ouvrage::create($data);

            return redirect()->route('ouvrages.index')
                ->with('success_message', 'Ouvrage ajouté avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('ouvrages.unexpected_error')]);
        }
    }

    /**
     * Display the specified ouvrage.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $ouvrage = Ouvrage::join('typeouvrages', 'typeouvrages.id', '=', 'ouvrages.typeouvrage_id')
        ->join('villages', 'villages.id', '=', 'ouvrages.village_id')
        ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
        ->join('communes', 'communes.id', '=', 'cantons.commune_id')
        ->select('ouvrages.id', 'nom_vill', 'nom_ouvrage', 'descrip', 'nom_cant', 'nom_comm', 'nom_type')
        ->findOrFail($id);

        return response()->json($ouvrage);
    }

    /**
     * Show the form for editing the specified ouvrage.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $ouvrage = Ouvrage::findOrFail($id);
        return response()->json($ouvrage);
    }

    /**
     * Update the specified ouvrage in the storage.
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
            
            $ouvrage = Ouvrage::findOrFail($request->id);

            $data['nom_ouvrage'] = mb_strtoupper($request->nom_ouvrage, 'UTF-8');
            $data['descrip'] = mb_strtoupper($request->descrip, 'UTF-8');
            
            $ouvrage->update($data);

            return redirect()->route('ouvrages.index')
                ->with('success_message', 'Ouvrage mis à jour avec succès');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('ouvrages.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ouvrage from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $ouvrage = Ouvrage::findOrFail($id);
            $ouvrage->delete();
            return redirect()->route('ouvrages.index')
                ->with('success_message', trans('ouvrages.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('ouvrages.unexpected_error')]);
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
            'nom_ouvrage' => 'required|string',
            'descrip' => 'nullable|string',
            'village_id' => 'required',
            'typeouvrage_id' => 'required', 
        ];
        $data = $request->validate($rules);
        return $data;
    }

    /*public function get_option($id)
    {
        $ouvrage = Ouvrage::where('village_id', $id)
                        ->get();
        return response()->json($ouvrage);
    }*/

    public function get_option($id)
    {
        $ouvrage = Ouvrage::join('villages', 'villages.id', '=', 'ouvrages.village_id')
                        ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                        ->where('cantons.id', $id)
                        //->select('cantons.id')
                        ->get();
        return response()->json($ouvrage);
    }

}
