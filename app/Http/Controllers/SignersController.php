<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use App\Models\Entreprise;
use App\Models\Ouvrage;
use App\Models\Signer;
use Illuminate\Http\Request;
use Exception;

class SignersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:signer-create|signer-edit|signer-show|signer-destroy', ['only' => ['index']]);
        $this->middleware('permission:signer-index', ['only' => ['index']]);
        $this->middleware('permission:signer-create', ['only' => ['create','store']]);
        $this->middleware('permission:signer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:signer-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:signer-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the signers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $signers = Signer::with('contrat','ouvrage','entreprise')->paginate(25);

        return view('signers.index', compact('signers'));
    }

    /**
     * Show the form for creating a new signer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $Contrats = Contrat::pluck('date_debut','id')->all();
        $Ouvrages = Ouvrage::pluck('nom_ouvrage','id')->all();
        $Entreprises = Entreprise::pluck('nom_entrep','id')->all();
        
        return view('signers.create', compact('Contrats','Ouvrages','Entreprises'));
    }

    /**
     * Store a new signer in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Signer::create($data);

            return redirect()->route('signers.signer.index')
                ->with('success_message', trans('signers.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('signers.unexpected_error')]);
        }
    }

    /**
     * Display the specified signer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $signer = Signer::with('contrat','ouvrage','entreprise')->findOrFail($id);

        return view('signers.show', compact('signer'));
    }

    /**
     * Show the form for editing the specified signer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $signer = Signer::findOrFail($id);
        $Contrats = Contrat::pluck('date_debut','id')->all();
        $Ouvrages = Ouvrage::pluck('nom_ouvrage','id')->all();
        $Entreprises = Entreprise::pluck('nom_entrep','id')->all();

        return view('signers.edit', compact('signer','Contrats','Ouvrages','Entreprises'));
    }

    /**
     * Update the specified signer in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $signer = Signer::findOrFail($id);
            $signer->update($data);

            return redirect()->route('signers.signer.index')
                ->with('success_message', trans('signers.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('signers.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified signer from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $signer = Signer::findOrFail($id);
            $signer->delete();

            return redirect()->route('signers.signer.index')
                ->with('success_message', trans('signers.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('signers.unexpected_error')]);
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
            'contrat_id' => 'required',
            'ouvrage_id' => 'required|numeric|min:0',
            'entreprise_id' => 'required',
            'date_sign' => 'nullable', 
        ];        
        $data = $request->validate($rules);

        return $data;
    }

}
