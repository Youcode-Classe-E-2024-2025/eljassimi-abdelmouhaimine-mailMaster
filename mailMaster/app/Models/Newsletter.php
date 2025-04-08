<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = ['mailing_list_id', 'subject', 'content', 'sent_at'];

    public function mailingList()
    {
        return $this->belongsTo(MailingList::class);
    }

    public function reads()
    {
        return $this->hasMany(NewsletterRead::class);
    }
}

