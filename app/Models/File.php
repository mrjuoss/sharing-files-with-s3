<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $fillable = ['file_name', 'views', 'downloads'];

    public function incrementView()
    {
        $this->increment('views', 1);
    }

    public function incrementDownload()
    {
        $this->increment('downloads', 1);
    }
}
