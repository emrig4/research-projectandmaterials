<?php

namespace Modules\Category\Entities;

use Illuminate\Support\Facades\Cache;
use TypiCMS\NestableTrait;
use Modules\Base\Eloquent\Model;
use Modules\Base\Traits\Sluggable;
use Modules\Base\Eloquent\Translatable;
use Modules\Ebook\Entities\Ebook;
use Modules\Files\Entities\Files;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use Translatable, Sluggable, NestableTrait;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'slug',
        'position',
        'is_searchable',
        'is_active',
        'description',
        'category_cover'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_searchable' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addActiveGlobalScope();
    }
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function isRoot()
    {
        return $this->exists && is_null($this->parent_id);
    }

    /**
     * Returns the public url for the category.
     *
     * @return string
     */
    public function url()
    {
        return route('ebooks.index', ['category' => $this->slug]);
    }


    /**
     * Returns the name from slug.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    public static function tree()
    {
        return Cache::tags(['categories'])->rememberForever('categories.tree:' . locale(), function () {
            return static::orderByRaw('-position DESC')->get()->nest();
        });
    }

    public static function treeList()
    {
        return Cache::tags(['categories'])->rememberForever('categories.tree_list:' . locale(), function () {
            return static::orderByRaw('-position DESC')
                ->get()
                ->nest()
                ->setIndent('¦–– ')
                ->listsFlattened('name');
        });
    }

    /**
     * Get searchable categoires.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchable()
    {
        return Cache::tags(['categories'])->rememberForever('categories.searchable:' . locale(), function () {
            return static::where('is_searchable', true)->get();
        });
    }


    public function ebooks()
    {
        return $this->belongsToMany(Ebook::class, 'ebook_categories');
    }


    // ebooks 
    public function totalEbooks()
    {
        $ebooks = DB::table('ebook_categories')
        ->select('ebook_id')
            ->where([
                ['category_id','=',$this->id],
            ])
            ->count();

        return $ebooks;
    }


    // category_cover
    public function getCategoryCover()
    {
       if($this->category_cover){
        return $this->category_cover;
       }else{
        return url('category1.png');
       }
    }
}
