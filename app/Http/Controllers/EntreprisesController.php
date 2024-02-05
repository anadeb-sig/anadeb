<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Exception;

class EntreprisesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:entreprise-create|entreprise-edit|entreprise-show|entreprise-destroy', ['only' => ['index']]);
        $this->middleware('permission:entreprise-index', ['only' => ['index']]);
        $this->middleware('permission:entreprise-create', ['only' => ['create','store']]);
        $this->middleware('permission:entreprise-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:entreprise-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:entreprise-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the entreprises.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $entreprises = Entreprise::paginate(25);

        return view('entreprises.index', compact('entreprises'));
    }

    public function fetch(){
        $entreprises = Entreprise::orderByDesc('entreprises.created_at')
                    ->get();
        return response()->json($entreprises);
    }

    /**
     * Show the form for creating a new entreprise.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('entreprises.create');
    }

    /**
     * Store a new entreprise in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $data['nom_charge'] = mb_strtoupper($request->nom_charge, 'UTF-8');
            
            $data['prenom_charge'] = mb_strtoupper($request->prenom_charge, 'UTF-8');
            
            $data['nom_entrep'] = mb_strtoupper($request->nom_entrep, 'UTF-8');
            
            $data['addr'] = mb_strtoupper($request->addr, 'UTF-8');

            Entreprise::create($data);

            return redirect()->route('entreprises.index')
                ->with('success_message', trans('entreprises.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('entreprises.unexpected_error')]);
        }
    }

    /**
     * Display the specified entreprise.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $entreprise = Entreprise::findOrFail($id);

        return response()->json($entreprise);
    }

    /**
     * Show the form for editing the specified entreprise.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        return response()->json($entreprise);
    }

    /**
     * Update the specified entreprise in the storage.
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
            
            $entreprise = Entreprise::findOrFail($request->id);

            $data['nom_charge'] = mb_strtoupper($request->nom_charge, 'UTF-8');
            
            $data['prenom_charge'] = mb_strtoupper($request->prenom_charge, 'UTF-8');
            
            $data['nom_entrep'] = mb_strtoupper($request->nom_entrep, 'UTF-8');
            
            $data['addr'] = mb_strtoupper($request->addr, 'UTF-8');
            
            $entreprise->update($data);

            return redirect()->route('entreprises.index')
                ->with('success_message', trans('entreprises.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('entreprises.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified entreprise from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entreprise = Entreprise::findOrFail($id);
            $entreprise->delete();

            return redirect()->route('entreprises.index')
                ->with('success_message', trans('entreprises.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('entreprises.unexpected_error')]);
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
            'nom_entrep' => 'required|string',
            'num_id_f' => 'required|string|min:4|max:50',
            'nom_charge' => 'required|string',
            'prenom_charge' => 'required|string',
            'email' => 'required|string',
            'tel' => 'required|integer|digits:8',
            'addr' => 'string', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

}
