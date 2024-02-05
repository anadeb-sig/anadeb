<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contrats';

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
                  'date_debut',
                  'date_fin'
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
     * Get the signer for this model.
     *
     * @return App\Models\Signer
     */
    public function signer()
    {
        return $this->hasOne('App\Models\Signer','contrat_id','id');
    }

    /**
     * Set the date_debut.
     *
     * @param  string  $value
     * @return void
     */
    /**public function setDateDebutAttribute($value)
    {
        $this->attributes['date_debut'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y', $value) : null;
    }*/

    /**
     * Set the date_fin.
     *
     * @param  string  $value
     * @return void
     */
    /**public function setDateFinAttribute($value)
    {
        $this->attributes['date_fin'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y', $value) : null;
    }*/

    /**
     * Get date_debut in array format
     *
     * @param  string  $value
     * @return array
     */
    /**public function getDateDebutAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y');
    }*/

    /**
     * Get date_fin in array format
     *
     * @param  string  $value
     * @return array
     */
    /**public function getDateFinAttribute($value)
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
