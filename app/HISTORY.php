<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class HISTORY extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'history';
    protected $fillable = [
        'ticket',
        'item',
        'amount'
    ];
}