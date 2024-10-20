<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public static function sumPricesByQuantities($products, $productsInSession)
    {
        // dd($productsInSession); 
        $total = 0;
        foreach ($products as $product) {
            // dd($productsInSession[$product->id][0]);
            $total = $total + ($product->price * $productsInSession[$product->id][0]);
        }
        return $total;
    }
    public static function getProductRate($rates)
    {
        $total = 0;
        $sum = 0;
        foreach ($rates as $rate) {
            $sum = $sum + ($rate->rating);
            $total = $total + 1;
        }
        if ($total > 0) {
            return ($sum / $total);
        } else {
            return 0;
        }
    }

    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
        'price',
        'size',
    ];

    // "category_id" => "required|numeric",

    //
//     public function getId()
// {
// return $this->attributes['id'];}
// public function setId($id)
// {
// $this->attributes['id'] = $id;
// }
// public function getName()
// {
// return $this->attributes['name'];
// }
// public function setName($name)
// {
// $this->attributes['name'] = $name;
// }
// public function getDescription()
// {
// return $this->attributes['description'];
// }
// public function setDescription($description)
// {
// $this->attributes['description'] = $description;
// }
// public function getImage()
// {
// return $this->attributes['image'];
// }
// public function setImage($image)
// {
// $this->attributes['image'] = $image;
// }
// public function getPrice()
// {
// return $this->attributes['price'];
// }
// public function setPrice($price)
// {
// $this->attributes['price'] = $price;
// }
// public function getCreatedAt()
// {
// return $this->attributes['created_at'];
// }
// public function setCreatedAt($createdAt)
// {
// $this->attributes['created_at'] = $createdAt;
// }
// public function getUpdatedAt()
// {
// return $this->attributes['updated_at'];
// }
// public function setUpdatedAt($updatedAt)
// {
// $this->attributes['updated_at'] = $updatedAt;
// }
}
