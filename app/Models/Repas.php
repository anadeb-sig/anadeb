<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Ecole;
use App\Models\Menu;
use App\Models\Classe;
use Auth;

class Repas extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'repas';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'classe_id',
                  'menu_id',
                  'user_id',
                  'effect_gar',
                  'effect_fil',
                  'date_rep'
              ];


    public function header_stat(){
        if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Assistant')  || Auth::user()->hasRole('Hierachie')){
            $repas = Repas::join('classes', 'classes.id', '=', 'repas.classe_id')
                ->join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                ->join('menus', function ($join) {
                    $join->on('repas.date_rep', '>=', 'menus.date_debut')
                        ->on('repas.date_rep', '<=', 'menus.date_fin');})
                ->select(DB::raw('
                    SUM(IF(nom_cla = "Primaire", effect_gar,0)) as "prim_gar",
                    SUM(IF(nom_cla = "Primaire", effect_fil,0)) as "prim_fil",
                    SUM(IF(nom_cla = "Pré_scolaire", effect_gar,0)) as "pres_gar",
                    SUM(IF(nom_cla = "Pré_scolaire", effect_fil,0)) as "pres_fil"'))
                    ->where('menus.statut', 1)
                    ->where('ecoles.status', '=', 1)
                ->get();
        }else{
            $repas = Repas::join('classes', 'classes.id', '=', 'repas.classe_id')
                ->join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                ->join('menus', function ($join) {
                    $join->on('repas.date_rep', '>=', 'menus.date_debut')
                        ->on('repas.date_rep', '<=', 'menus.date_fin');})
                ->select(DB::raw('
                    SUM(IF(nom_cla = "Primaire", effect_gar,0)) as "prim_gar",
                    SUM(IF(nom_cla = "Primaire", effect_fil,0)) as "prim_fil",
                    SUM(IF(nom_cla = "Pré_scolaire", effect_gar,0)) as "pres_gar",
                    SUM(IF(nom_cla = "Pré_scolaire", effect_fil,0)) as "pres_fil"'))
                    ->where('ecoles.status', '=', 1)
                    ->where('menus.statut', 1)
                    ->where('user_id', Auth::user()->id)
                ->get();
            }
            return $repas;
    }

    public function cout(){
        $repas = Menu::select('cout_unt')
                ->where('statut', 1)
                ->get();
                $cout = 0;
            foreach ($repas as $value) {
                $cout = $value->cout_unt;
            }
            return $cout;
    }

    public function header_stat_nb(){
        $repas = Ecole::select(DB::raw('
                SUM(nbr_pri) as "nbr_pri",
                SUM(nbr_pre) as "nbr_pre"'))
                ->where('status', '=', 1)
                ->get();
            return $repas;
        }
    
        public function nb_inscris(){
            $repas = Classe::join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                            ->select(DB::raw('
                                SUM(effec_gar) as "gar_inscri",
                                SUM(effec_fil) as "fil_inscri"'))
                            ->where('ecoles.status', '=', 1)
                            ->get();
                return $repas;
            }

        public function nb_par_ensg(){
            $repas = Classe::join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                    ->select(DB::raw('
                        SUM(IF(nom_cla = "Primaire", effec_gar,0)) as "prim_gar",
                        SUM(IF(nom_cla = "Primaire", effec_fil,0)) as "prim_fil",
                        SUM(IF(nom_cla = "Pré_scolaire", effec_gar,0)) as "pres_gar",
                        SUM(IF(nom_cla = "Pré_scolaire", effec_fil,0)) as "pres_fil"'))
                        ->where('ecoles.status', '=', 1)
                    ->get();
                return $repas;
        }
    //Vérifier si le nombre de repas dans cette cantine est déjà ajouté à la date
        public function verifLigne($id){
            $repas = Repas::join('classes', 'classes.id', '=', 'repas.classe_id')
                        ->join('menus', function ($join) {
                            $join->on('repas.date_rep', '>=', 'menus.date_debut')
                                ->on('repas.date_rep', '<=', 'menus.date_fin');})
                        ->join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                        ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                        ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                        ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                        ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                        ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                        ->where(DB::raw('CONCAT(regions.nom_reg, cantons.nom_cant, ecoles.nom_ecl, classes.nom_cla, repas.date_rep)'), $id)
                        ->count();
            return $repas;
        }

        

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the Class for this model.
     *
     * @return App\Models\Classe
     */
    public function Classe()
    {
        return $this->belongsTo('App\Models\Classe','classe_id','id');
    }

    /**
     * Get the Menu for this model.
     *
     * @return App\Models\Menu
     */
    public function Menu()
    {
        return $this->belongsTo('App\Models\Menu','menu_id','id');
    }

    /**
     * Get the user for this model.
     *
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * Set the date_rep.
     *
     * @param  string  $value
     * @return void
     */
    /*public function setDateRepAttribute($value)
    {
        $this->attributes['date_rep'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y', $value) : null;
    }*/

    /**
     * Get date_rep in array format
     *
     * @param  string  $value
     * @return array
     */
    /**public function getDateRepAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y');
    }*/

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    /**public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }*/

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    /**public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }*/

}
