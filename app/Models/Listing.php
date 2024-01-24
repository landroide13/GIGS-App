<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'user_id' ,'logo','email', 'description', 'tags'];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? null){
            $query -> where('tags', 'like', '%'.request('tag').'%');
        }

        if($filters['search'] ?? null){
            $query -> where('title', 'like', '%'.request('search').'%')
                   ->orWhere('description', 'like', '%'.request('search').'%')
                   ->orWhere('tags', 'like', '%'.request('search').'%');
        }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
