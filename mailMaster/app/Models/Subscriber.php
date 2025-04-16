<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     schema="Subscriber",
 *     type="object",
 *     title="Subscriber",
 *     required={"id", "email"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         example="john@example.com"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="John Doe"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-04-16T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-04-16T12:34:56Z"
 *     )
 * )
 */
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
