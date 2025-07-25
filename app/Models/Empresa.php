<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Empresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'seo_title',
        'seo_description',
        'seo_image',
        'description',
        'image'
    ];
}
