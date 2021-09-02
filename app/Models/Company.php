<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'cname', 'user_id', 'slug','address','phone','website','logo','cover_photo','slogan','description'
    ];

    public function jobs(){
    	return $this->hasMany('App\Models\Job');
    }
    public function getRouteKeyName(){
		return 'slug';
	}
}
