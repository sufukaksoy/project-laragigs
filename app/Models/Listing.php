<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    // Mass assignment yapabilmek için fillable tanımlıyoruz.
    /*   Bunun yerine AppServiceProvider.php içerisindeki boot() fonksiyonuna 
         Model::unguard(); metodunu ekleyebiliriz.    */


    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description'];

    public function scopeFilter($query, array $filters)
    {
        // filtersta filtre var ise sorguyu döndür
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        // search yapabiliyor
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%');
        }

        //// Or ifadesiyle birbirine bağlanan koşulların herhangi biri sağlanırsa koşul gerçekleşir. 
        //// Laravel'de orWhere metodu da bu işlemi yapar. 
        //// Kullanımı where metoduyla aynıdır. 3 parametre alır. 
        //// 2. parametreyi girmezseniz operatörü otomatikman eşittir olarak kabul eder.
    }
}
