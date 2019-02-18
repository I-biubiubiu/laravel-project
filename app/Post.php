<?php

namespace App;

use App\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    // 定义索引里面的type值
    public function searchableAs() {
        return "post";
    }

    // 定义有那些字段需要搜索
    public function toSearchableArray() {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }

    // 关联用户
    public function user() {
        return $this->belongsTo('App\User');
    }

    // 评论模型
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    // 和用户进行关联
    public function zan($user_id) {
        return $this->hasOne('App\Zan')->where('user_id', $user_id);
    }

    // 文章的所有赞
    public function zans() {
        return $this->hasMany('App\Zan');
    }
}
