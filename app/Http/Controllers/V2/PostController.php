<?php

namespace App\Http\Controllers\V2;

use App\APiService\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Http\Resources\V2\PostResource;
use App\LogService\LogService;
use App\Models\Post;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;


class PostController extends Controller
{

    use ApiResponse, LogService;

    private const POST_PAGINATE = 5;

    public function index(): JsonResponse
    {
        $posts = PostResource::collection(Post::paginate(self::POST_PAGINATE));
        return $this->success([
            'posts' => $posts,
            'links' => $posts->response()->getData()->links,
            'meta' => $posts->response()->getData()->meta,
        ],
            ResponseStatus::HTTP_OK,
            ResponseStatus::$statusTexts[200]);
    }

    public function show(Post $post): JsonResponse
    {
//        return new PostResource($post);
        return $this->success(new PostResource($post),
            ResponseStatus::HTTP_OK,
            ResponseStatus::$statusTexts[200]);
    }

    /**
     * @throws \Exception
     */
    public function store(PostFormRequest $request, Post $post): JsonResponse
    {
        return $this->success($post->newPost($request)
            ->orderby('id', 'desc')
            ->first(),
            ResponseStatus::HTTP_CREATED,
            ResponseStatus::$statusTexts[201]);
    }

    public function update(PostFormRequest $request, Post $post): JsonResponse
    {
        $post->updatePost($request);
        return $this->success($post,
            ResponseStatus::HTTP_CREATED,
            ResponseStatus::$statusTexts[201]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->deletePost($post);
        return $this->success($post,
            ResponseStatus::HTTP_NO_CONTENT,
            ResponseStatus::$statusTexts[204]);
    }
}

