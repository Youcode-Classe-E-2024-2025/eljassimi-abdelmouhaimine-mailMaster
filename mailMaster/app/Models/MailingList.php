<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class);
    }

    public function newsletters()
    {
        return $this->hasMany(Newsletter::class);
    }
}
