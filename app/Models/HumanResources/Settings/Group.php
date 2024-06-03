<?php

namespace App\Models\HumanResources\Settings;

use App\Traits\ActiveTrait;
use App\Traits\DateTimeTrait;
use App\Traits\StringTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use DateTimeTrait;
    use StringTrait;
    use ActiveTrait;
    public $timestamps = true;
    protected $fillable = [
        'description',
        'active',
    ];


    //============================================================
    //======================== FUNCTIONS =========================
    //============================================================
    public function getName()
    {
        return $this->getAttribute('description');
    }

    public function getContent()
    {
        return $this->getAttribute('description');
    }

    //============================================================
    //======================== RELASHIONSHIP =====================
    //============================================================

    //============================================================
    //======================== HASMANY ===========================
    //============================================================
//    public function products()
//    {
//        return $this->hasMany(Product::class, 'category_id');
//    }
}
