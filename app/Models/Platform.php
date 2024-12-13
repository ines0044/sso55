<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'username',  'redirect_url'];

    
public function createds()
{
   
   return $this->belongsToMany(Created::class, 'created_platform', 'platform_id', 'created_id');
   
}
}



