<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'contents',
        'insert_id'
    ];


    public function files() {
        return $this->hasMany(File::class, 'table_id')->where('table_name', 'board');
    }
    
}
