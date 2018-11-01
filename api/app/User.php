<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class User extends Model
{
    use SpatialTrait;
    
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'name', 'age', 'grade', 'college', 'school', 'tel', 'wechat', 'tagender', 'movie'
    ];

    protected $spatialFields = [
        'p_top',
        'p_right'
    ];

}
