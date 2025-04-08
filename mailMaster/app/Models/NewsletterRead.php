<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterRead extends Model
{
    use HasFactory;

    protected $fillable = ['newsletter_id', 'subscriber_id', 'read_at'];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}

