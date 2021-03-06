<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $table = 'postcomment';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id', 'owner_id', 'post_id','contents', 'parents_comment_id'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
