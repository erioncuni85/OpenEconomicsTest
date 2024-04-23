<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'class_name',
        'family_name',
        'genus_name',
        'infra_name',
        'infra_rank',
        'kingdom_name',
        'main_common_name',
        'order_name',
        'phylum_name',
        'population',
        'scientific_name',
        'taxonid',
        'taxonomic_authority',
    ];
}
