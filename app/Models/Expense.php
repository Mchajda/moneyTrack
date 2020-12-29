<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id');
    }

    public function getCategoryImg($name)
    {
        $cat = Category::where('category_name', $name)->get();
        return $cat[0]->img_path;
    }
}
