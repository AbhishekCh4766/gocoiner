<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use McCool\LaravelAutoPresenter\HasPresenter;

class NewsCryptoo extends Model 

{
    /*use Sortable;*/
    protected $table = 'news_crypto';
    /*public $sortable = [
        'title', 'link', 'description', 'image', 'comments', 'created_at', 'updated_at'
    ];
    protected $guarded = ['id'];
    protected $dates = ['last_updated'];*/
    


}


