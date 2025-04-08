<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name'];

    public function mailingLists()
    {
        return $this->belongsToMany(MailingList::class);
    }

    public function reads()
    {
        return $this->hasMany(NewsletterRead::class);
    }
}
