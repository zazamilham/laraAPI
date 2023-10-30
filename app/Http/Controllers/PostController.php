<?php

namespace App\Http\Controllers;
use App\APiService\ApiResource;
use App\Http\Requests\PostFormRequest;
use App\LogService\LogService;
use App\Models\Post;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;



class PostController extends Controller
{

    use ApiResource,LogService;
    public function index():JsonResponse
    {
        try {
//            $this->setLog('id);
            return $this->success(Post::all(), ResponseStatus::HTTP_OK, ResponseStatus::$statusTexts[200]);
        }catch (\Exception $e) {
            return $this->error($e->getMessage(),ResponseStatus::HTTP_NOT_FOUND, ResponseStatus::$statusTexts[404]);
        }
    }

    public function store(PostFormRequest $request):JsonResponse
    {
        try {
                $post =  Post::create([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'image' => $request->input('image'),
                'content'=> $request->input('content'),
                'user_id' => 1,
            ]);
            return $this->success($post,ResponseStatus::HTTP_CREATED, ResponseStatus::$statusTexts[201]);
        }catch (\Exception $e) {
            return $this->error($e->getMessage(),ResponseStatus::HTTP_BAD_REQUEST, ResponseStatus::$statusTexts[400]);
        }

    }
}

