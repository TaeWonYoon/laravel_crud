<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id', 'table_name', 'file_path', 'file_name', 'file_ext', 'file_size', 'user_id', 'file_name_origin','file_after_id'
    ];

    public function deleteFile()
    {
        if (Storage::exists($this->file_path)) {
            Storage::delete($this->file_path);
        }
        $this->delete();
    }
}
