<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Classe;
class PublicController extends Controller
{

    /**
     * Display a listing of the cantons.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $classes = Classe::join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                    ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                    ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                    ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                    ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                    ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                    ->select('regions.nom_reg', 'cantons.nom_cant', 'ecoles.nom_ecl', 'classes.id', 'classes.nom_cla')
                    ->where(function ($query) {
                        $query->where('classes.effec_gar', '>', 0)
                              ->orWhere('classes.effec_fil', '>', 0);
                    })
                    ->orderByDesc('classes.created_at')
                    ->get();
        return response()->json($classes);
    }
}
