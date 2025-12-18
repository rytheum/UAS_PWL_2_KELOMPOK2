<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * fillable
     * 
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'product_category_id',
        'description',
        'price',
        'stock'
    ];

    /**
     * Cek ketersediaan stock
     */
    public function isAvailable($quantity)
    {
        return $this->stock >= $quantity;
    }

    /**
     * Kurangi stock dengan validasi
     */
    public function reduceStock($quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception('Stock tidak mencukupi. Stock tersedia: ' . $this->stock);
        }
        
        $this->stock -= $quantity;
        return $this->save();
    }

    /**
     * Tambah stock
     */
    public function addStock($quantity)
    {
        $this->stock += $quantity;
        return $this->save();
    }

    public function get_product()
    {
        $sql = $this->select(
            "products.*",
            "product_categories.category_name as product_categories_name",
        )
            ->leftjoin('product_categories', 'product_categories.id', '=', 'products.product_category_id');
        return $sql;
    }

    public static function storeProduct($request, $image)
    {
        return self::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'product_category_id' => $request->product_category,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
    }

    public static function updateProduct($id, $request, $image = null)
    {
        $product = self::find($id);

        if ($product) {
            $data = [
                'title' => $request['title'],
                'product_category_id' => $request['product_category_id'],
                'description' => $request['description'],
                'price' => $request['price'],
                'stock' => $request['stock']
            ];

            if (!empty($image)) {
                $data['image'] = $image;
            }

            $product->update($data);
            return $product;
        } else {
            return "tidak ada data yang diupdate";
        }
    }

    public function category()
    {
    return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}