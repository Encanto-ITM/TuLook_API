<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comment::all();
        
        if ($comments->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $comments;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request): Comment
    {
        return Comment::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): Comment
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Comment $comment): Comment
    {
        $comment->update($request->validated());

        return $comment;
    }

    public function destroy(Comment $comment): Response
    {
        $comment->delete();

        return response()->noContent();
    }

    /**
     * Get comments by service
     */
    public function getByService(Request $request)
    {
        $service = $request->service;
        $comments = Comment::where("service_id", $service)->get();

        if ($comments->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $comments;
    }
}
