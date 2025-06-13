<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'harga_beli',
        'laba',
        'supplier',
        'foto'
    ];

    public function kategoriItems(): BelongsToMany
    {
        return $this->belongsToMany(KategoriItems::class, 'master_item_kategori_item', 'master_item_id',
            'kategori_items_id');
    }
}
