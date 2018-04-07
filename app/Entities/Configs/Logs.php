<?php
namespace App\Entities\Configs;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = ['user_id','log'];

    protected $section = 'logs';


    public function logeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
