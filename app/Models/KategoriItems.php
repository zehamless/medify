<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriItems extends Model
{
    protected $fillable = [
        'kode',
        'nama',
    ];

    public function masterItems(): BelongsToMany
    {
        return $this->belongsToMany(MasterItem::class, 'master_item_kategori_item', 'kategori_items_id',
            'master_item_id');
    }
}
