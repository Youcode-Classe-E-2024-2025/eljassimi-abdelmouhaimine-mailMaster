<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingList extends Model
{
    use HasFactory;
    /**
     * @OA\Schema(
     *     schema="MailingList",
     *     type="object",
     *     required={"id", "name"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="Promotions Subscribers"),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-16T12:34:56Z"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-16T12:34:56Z")
     * )
     */

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
