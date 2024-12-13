<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;



class Created extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'createds';

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
    ];

    public function platforms()
    {
       /* return $this->belongsTo(Created::class); */
       /*return $this->belongsToMany(Platform::class);*/
       return $this->belongsToMany(Platform::class, 'created_platform', 'created_id', 'platform_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Retourne l'identifiant unique de l'utilisateur (id)
    }

    /**
     * Return a key-value array containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // Ajoutez ici des données supplémentaires si nécessaire
    }
    
    public function getIsAdminAttribute()
    {
        return $this->attributes['is_admin'] === 1; 
    }
    
}

