<?php
 namespace App\Entities\Configs;


 use App\Entities\Moto\Budgets;
 use App\Entities\Moto\Models;
 use App\Entities\Moto\Sales;
 use Illuminate\Database\Eloquent\Model;

 class Additionables extends Model
 {
     protected $fillable    = ['additionals_id','amount','sales_items_id'];

     protected $section = 'additionables';


     public function additionable(){

         return $this->morphTo();
     }

     public function Additionals()
     {
         return $this->belongsTo(Additionals::class);
     }

     public function Sales()
     {
         return $this->belongsTo(Sales::class);
     }

     public function Budgets()
     {
         return $this->belongsTo(Budgets::class);
     }

     public function Models()
     {
         return $this->belongsTo(Models::class);
     }

 }


