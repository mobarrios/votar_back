<?php
namespace App\Entities\Configs;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable = ['path'];

    protected $table = 'images';

    protected $section = 'images';


    public function imageable()
    {
        return $this->morphTo();
    }
}
