<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     description="Post model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The ID of the post"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The title of the post"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="The content of the post"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         type="string",
 *         description="The author of the post"
 *     ),
 *     @OA\Property(
 *         property="publish_at",
 *         type="string",
 *         format="date-time",
 *         description="The publish date of the post"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The creation date of the post"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The update date of the post"
 *     ),
 * )
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'publish_at',
    ];
}
