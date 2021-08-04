<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table= 'tasks'; 
    protected $fillable = ['description','deadline','status','user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
