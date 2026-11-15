<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public const UPDATED_AT = null;

    public static function getAll()
    {
        return static::all();
    }
    
    public static function getData($id)
    {
        return static::findOrFail($id);
    }

    public static function insertRow(array $data)
    {
        return static::create($data);
    }

    public static function updateRow(int $id, array $data) 
    {
        return static::findOrFail($id)->update($data);    
    }

    public static function deleteRow(int $id) 
    {
        return static::findOrFail($id)->delete();    
    }
}
