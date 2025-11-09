<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pinjambukus extends Model
{
    protected $table = 'pinjambukus';   
     protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}

