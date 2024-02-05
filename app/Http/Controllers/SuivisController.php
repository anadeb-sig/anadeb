<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Signer;
use App\Models\Suivi;
use App\Models\Typeouvrage;
use App\Models\Region;
use Illuminate\Http\Request;
use Exception;
use App\Models\Galerie;
use Intervention\Image\Facades\Image;
use DB;

class SuivisController extends Controller
{
    /**public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:suivi-create|suivi-edit|suivi-show|suivi-destroy', ['only' => ['index']]);
        $this->middleware('permission:suivi-index', ['only' => ['index']]);
        $this->middleware('permission:suivi-create', ['only' => ['create','store']]);
        $this->middleware('permission:suivi-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:suivi-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:suivi-show', ['only' => ['show']]);
    }*/

    /**
     * Display a listing of the suivis.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $regions = Region::all();
        $suivis = Suivi::with('signer')->paginate(25);
        $Signers = Signer::with('ouvrage')->get();
        return view('suivis.index', compact('suivis', 'Signers', 'regions'));
    }

    public function fetch(){
        $ouvrages = Suivi::join('signers', 'signers.id', '=', 'suivis.signe_id' )
                    ->join('contrats', 'contrats.id', '=', 'signers.contrat_id' )
                    ->join('ouvrages', 'ouvrages.id', '=', 'signers.ouvrage_id' )
                    ->join('villages', 'villages.id', '=', 'ouvrages.village_id' )
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id' )
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id' )
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id' )
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id' )
                    ->join('entreprises', 'entreprises.id', '=', 'signers.entreprise_id' )
                    ->select('regions.nom_reg', 'cantons.nom_cant', 'suivis.id', 'ouvrages.nom_ouvrage', 'suivis.recomm', 'suivis.conf_plan', 'suivis.niveau_exe', 'suivis.date_suivi')
                    ->orderByDesc('suivis.created_at')
                    ->get();
        return response()->json($ouvrages);
    }

    /**
     * Show the form for creating a new suivi.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $Signers = Signer::all();
        $regions = Region::all();
        return view('suivis.create', compact('Signers', 'regions'));
    }

    /**
     * Store a new suivi in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $id = DB::table('suivis')->insertGetId($data);

            $request->validate([
                'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:4096', // Assurez-vous que ce sont des images et qu'elles respectent les règles de taille/format
            ]);

            $dataa = $this->getDataa($request);

            $photo = $request->photo;

            for ($i=0; $i < count($photo); $i++) {
                if ($photo[$i]->isValid()) {
                    $extension = $photo[$i]->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;
                    Image::make($photo[$i])->save( public_path('/images/' . $filename ) );// Stockez dans le dossier "images" du stockage public
                    $dataa['photo'] = $filename;
                }

                $dataa['descrip'] = $request->descrip[$i];
                $dataa['suivi_id'] = $id;

                Galerie::create($dataa);
            }

            return redirect()->route('suivis.index')
                ->with('success_message', trans('suivis.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['error_message' => trans('suivis.unexpected_error')]);
        }
    }

    /**
     * Display the specified suivi.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $suivi = Suivi::join('signers', 'signers.id', '=', 'suivis.signe_id' )
        ->join('contrats', 'contrats.id', '=', 'signers.contrat_id' )
        ->join('ouvrages', 'ouvrages.id', '=', 'signers.ouvrage_id' )
        ->join('villages', 'villages.id', '=', 'ouvrages.village_id' )
        ->join('cantons', 'cantons.id', '=', 'villages.canton_id' )
        ->join('communes', 'communes.id', '=', 'cantons.commune_id' )
        ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id' )
        ->join('regions', 'regions.id', '=', 'prefectures.region_id' )
        ->join('entreprises', 'entreprises.id', '=', 'signers.entreprise_id' )
        ->select('suivis.id','nom_vill', 'nom_cant', 'nom_comm', 'nom_pref','nom_reg', 'ouvrages.nom_ouvrage', 'ouvrages.descrip', 'suivis.conf_plan', 'suivis.niveau_exe', 'suivis.recomm', 'suivis.date_suivi')
        ->findOrFail($id);

        return response()->json($suivi);
    }

    /**
     * Show the form for editing the specified suivi.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $suivi = Suivi::findOrFail($id);

        return response()->json($suivi);
    }

    /**
     * Update the specified suivi in the storage.
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

            //dd($data);

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');                
                $filename = time() . '.' . $photo->getClientOriginalExtension();
        		Image::make($photo)->save( public_path('/images/' . $filename ) );//->resize(300, 300)
                $data['photo'] = $filename;
            }            
            
            $suivi = Suivi::findOrFail($request->id);
            $suivi->update($data);

            return redirect()->route('suivis.index')
                ->with('success_message', trans('suivis.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('suivis.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified suivi from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $suivi = Suivi::findOrFail($id);
            $suivi->delete();

            return redirect()->route('suivis.index')
                ->with('success_message', trans('suivis.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('suivis.unexpected_error')]);
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
            'niveau_exe' => 'required|string|max:250',
            'recomm' => 'required|string|max:250',
            'conf_plan' => 'required',
            'date_suivi' => 'required|date',
            'signe_id' => 'required'
        ];

        $data = $request->validate($rules);
        
        return $data;
    }

    protected function getDataa(Request $request)
    {
        $rules = [
            'descrip.*' => 'required|string|max:250'
        ];

        $data = $request->validate($rules);
        
        return $data;
    }

    public function galerie()
    {
        $suivis = Galerie::join('suivis', 'suivis.id', '=', 'galeries.suivi_id')
        ->join('signers', 'signers.id', '=', 'suivis.signe_id')
        ->join('ouvrages', 'ouvrages.id', '=', 'signers.ouvrage_id')
        ->join('villages', 'villages.id', '=', 'ouvrages.village_id')
        ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
        ->join('communes', 'communes.id', '=', 'cantons.commune_id')
        ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id' )
        ->join('regions', 'regions.id', '=', 'prefectures.region_id' )
        ->orderByDesc('galeries.created_at')
        ->get();
        $typeouvrages = Typeouvrage::select('nom_type')->distinct()->get();
        return view('galeries.galerie', compact('suivis', 'typeouvrages'));
    }

    public function get_options($id)
    {
        $ouvrage = Signer::join('contrats', 'contrats.id', '=', 'signers.contrat_id' )
                        ->join('ouvrages', 'ouvrages.id', '=', 'signers.ouvrage_id' )
                        ->select('signers.id', 'nom_ouvrage')
                        ->where('village_id', $id)
                        ->get();
        return response()->json($ouvrage);
    }
}
