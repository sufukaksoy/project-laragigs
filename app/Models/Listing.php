<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters) {
        // filtersta filtre var ise sorguyu döndür
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
