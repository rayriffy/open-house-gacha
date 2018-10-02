<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ITEM extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'ref';
    public $incrementing = false;
    protected $table = 'items';
    protected $fillable = [
        'ref',
        'name',
        'amount'
    ];
    protected $dates = [
        'deleted_at'
    ];
}