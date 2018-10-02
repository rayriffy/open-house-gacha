<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class USER extends Model
{
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'ticket'
    ];
    protected $dates = [
        'deleted_at'
    ];
}