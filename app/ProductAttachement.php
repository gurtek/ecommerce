<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttachement extends Model
{
    protected $table = 'product_attachments';
    protected $fillable = ['product_id', 'file_path'];
    public $timestamps = false;
}
