<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory; 
    protected $table= 'logs'; 
    protected $fillable = ['comment','created_at','task_id','status'];
    public $timestamps = false; 
}
