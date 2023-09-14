<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'is_enabled',
        'slug',
    ];


    private static function getcategoryName(int $id)
    {
        $category = DB::table('categories')->select('name')->where('id', $id)->limit(1)->get();
        
        return $category[0]->name;
    }
    private static function getParentID(int $id)
    {
        $parentID = DB::table('categories')
                        ->select('parent_id')
                        ->where('id', $id)
                        ->where('is_enabled', '1')
                        ->limit(1)
                        ->get();
                        //dd($parentID);
        if(count($parentID) > 0) {
            return $parentID;
        }
        return false;
    }
    private static function getAllParents(int $parent, array $parentArray)
    {

  
        $pID = self::getParentID($parent);

        if(isset($pID) && $pID[0]->parent_id != 0)
        {
            
            $parentArray[] = $pID[0]->parent_id;
            return self::getAllParents($pID[0]->parent_id,$parentArray);
        }
        else 
        {
            return $parentArray;
        }
    }

    public static function getAllCategories()
    {
        $cats = DB::table('categories')
                    ->select('id', 'name')
                    ->where([
                        ['is_enabled', '=', '1'],
                    ])->orderBy('name')->get();  

        foreach($cats as $cat)
        {   
            
            $parents = [];

            $parents = self::getAllParents($cat->id, $parents);
            //dd($parents);
            if($parents)
            {
                //echo 'Array reverse<br>';
                $reverseCats = $parents;
                if(count($parents)>1)
                {
                    $reverseCats = array_reverse($parents);
                }
                //dd($reverseCats);
                //echo '<pre>'.var_dump($reverseCats).'</pre>';
                $categoryName = '';
                
                foreach($reverseCats as $revCat)
                {
                    $categoryName = $categoryName != '' ? $categoryName.' / '.self::getcategoryName($revCat) : self::getcategoryName($revCat);
                }
                $cat->name = $categoryName .' / '.$cat->name; 
            }
            
        } 
        return $cats;
    }
}
