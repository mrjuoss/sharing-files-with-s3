<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'post_code', 'city', 'state', 'country', 'phone', 'email'];

    public function customerFields(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CustomerField::class);
    }
}
