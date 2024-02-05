<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signer extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'signers';

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
                  'contrat_id',
                  'ouvrage_id',
                  'entreprise_id',
                  'date_sign'
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
    
    /**
     * Get the Contrat for this model.
     *
     * @return App\Models\Contrat
     */
    public function Contrat()
    {
        return $this->belongsTo('App\Models\Contrat','contrat_id','id');
    }

    /**
     * Get the Ouvrage for this model.
     *
     * @return App\Models\Ouvrage
     */
    public function Ouvrage()
    {
        return $this->belongsTo('App\Models\Ouvrage','ouvrage_id','id');
    }

    /**
     * Get the Entreprise for this model.
     *
     * @return App\Models\Entreprise
     */
    public function Entreprise()
    {
        return $this->belongsTo('App\Models\Entreprise','entreprise_id','id');
    }

    /**
     * Get the suivi for this model.
     *
     * @return App\Models\Suivi
     */
    public function Suivi()
    {
        return $this->hasOne('App\Models\Suivi','signe_id','id');
    }

}
