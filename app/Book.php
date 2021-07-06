<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'writer', 'summary', 'price', 'photo', 'id_jenis'];

    public function isbn()
    {
        return $this->hasOne('App\Isbn','id_isbn');
    }

    public function jenis()
    {
        return $this->belongsTo('App\Jenis','id_jenis');
    }

    public function identity()
    {
        return $this->belongsToMany('App\Identity','identity_book','id_book','id_identity')->withTimeStamps();
    }

    public function getIdentityBookAttribute()
    {
        return $this->identity->pluck('id')->toArray();
    }
}
