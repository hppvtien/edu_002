<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Models\Education\Course;


class Imenu extends Model
{
    use HasFactory;
    protected $table = 'menu_items';
    public function get_child_cate()
    {
    	return $this->where('parent_id', $this->id)->orderBy('position')->get();
    }
}
