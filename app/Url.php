<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    //
    protected $fillable = ['scheme','host','port','path','query','fragment'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    private static function getData(){
        $result_set = self::all();
        $all = $result_set->groupBy('scheme')->all();

        $array = array();
        $scheme = array();
        $scheme_data = array();
        $scheme_names = array();
        $i = 0;
        foreach ($all as $key => $v){
            $len = count($v);
            $arr =  ['name' => $key, 'value' => $len];
            $scheme_data[$i] = $arr;
            $scheme_names[$i++] = $key;
        }
        $scheme['names'] = $scheme_names;
        $scheme['data'] = $scheme_data;
        $array['scheme'] = $scheme;
        $sites = count($result_set->groupBy('host')->all());
        $array['sites'] = $sites;
        $array['total'] = count($result_set);
        return $array;
    }

    public static function summary()
    {
        return self::getData();
    }

    public function scopeUri($query,$uri){
        return $query->where('uri',$uri)->get();
    }

    public function scopeShortKey($query,$shortKey){
        return $query->where('shortKey',$shortKey)->get();
    }
}
