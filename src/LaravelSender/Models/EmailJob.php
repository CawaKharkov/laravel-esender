<?php

namespace CawakHarkov\LaravelSender\Models; 

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailJob
 * @package CawakHarkov\LaravelSender\Models
 */
class EmailJob extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'email_job';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fromTitle',
        ''
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    =>  'integer'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

   
}