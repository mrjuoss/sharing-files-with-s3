<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerField extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'field_key', 'field_value'
    ];
}
