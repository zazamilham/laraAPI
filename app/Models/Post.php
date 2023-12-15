<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Support\Facades\Vite;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $content
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @throws \Exception
     */
    public function newPost($request):Post
    {
        $file = $request->file('image');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $imagePath = storage_path('images');
        \Storage::move($imagePath,$fileName);
        return self::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'image' => $request->input('image'),
            'content' => $request->input('content'),
            'user_id' => 18
        ]);
    }

    public function updatePost($request): Post
    {
        $this->update([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'image' => $request->has('image')?->input('image'),
                'content' => $request->input('content'),
                'user_id' => 13
            ]);

        $request->file('image')->store('image');
        return self::create([

        ]);
    }
}
