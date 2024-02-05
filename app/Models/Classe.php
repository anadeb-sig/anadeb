<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Classe extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';

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
                  'nom_cla',
                  'effec_gar',
                  'effec_fil',
                  'ecole_id'
              ];

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

    public function classe_id(){
        $classe_id = DB::table('classes')
            ->join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
            ->join('villages', 'villages.id', '=', 'ecoles.village_id')
            ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
            ->join('communes', 'communes.id', '=', 'cantons.commune_id')
            ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
            ->join('regions', 'regions.id', '=', 'prefectures.region_id')
            ->select(
                'classes.id as classe_id',
                'classes.effec_gar',
                'classes.effec_fil',
                DB::raw('CONCAT(cantons.nom_cant,"",ecoles.nom_ecl,"",classes.nom_cla) as concat')
            )
            
            ->get();

        return $classe_id;
    }

    //Recupere le id pour charger le fichier excel de plats
    public function classe_id_import($concat){
    $classe = Classe::join('ecoles', 'ecoles.id', '=', 'classes.ecole_id')
                        ->join('villages', 'villages.id', '=', 'ecoles.village_id')
                        ->join('cantons', 'cantons.id', '=', 'villages.canton_id')
                        ->join('communes', 'communes.id', '=', 'cantons.commune_id')
                        ->join('prefectures', 'prefectures.id', '=', 'communes.prefecture_id')
                        ->join('regions', 'regions.id', '=', 'prefectures.region_id')
                        ->select('classe_id')
                        ->whereRaw("CONCAT(cantons.nom_cant, '', ecoles.nom_ecl, '', classes.nom_cla)", $concat)
                        ->get();

            return $classe;
    }

    public function verif($concat){
        $classe_1 = Classe::whereRaw("CONCAT(ecole_id,'', nom_cla)= ?", [$concat])
                    ->count();
        return $classe_1;
    }
    
    /**
     * Get the Ecole for this model.
     *
     * @return App\Models\Ecole
     */
    public function Ecole()
    {
        return $this->belongsTo('App\Models\Ecole','ecole_id','id');
    }

    /**
     * Get the repa for this model.
     *
     * @return App\Models\Repa
     */
    public function repa()
    {
        return $this->hasOne('App\Models\Repas','classe_id','id');
    }


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
