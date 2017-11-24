<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\CommentsCrudHelper;
use App\Model\Comment;
use App\Model\Film;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author Andsalves
 */
class CommentsRestController extends Controller {

    /**
     * Fetch all and also some query
     */
    public function index() {
        $where = [];

        foreach (request()->query() as $key => $value) {
            if (in_array($key, ['film_id', 'user_id', 'status'])) {
                $where[] = [$key, '=', $value];
            }
        }

        return response()->json(Comment::where($where)->orderBy('created_at','DESC')->get());
    }

    public function store() {
        $postData = request()->post();

        if (!CommentsCrudHelper::validatePostData($postData, $errors)) {
            return response()->json([
                'message' => 'Validation error',
                'validation_messages' => $errors
            ], 422);
        }

        try {
            $comment = new Comment();
            $comment->fill($postData);
            $comment->save();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error while inserting new comment: ' . $exception->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => 'Comment inserted successfully',
            'data' => $comment->toArray()
        ], 201);
    }

    public function show($idOrSlug) {
        $query = Film::query();

        $query->where(function (Builder $query) use ($idOrSlug) {
            $query->orWhere('id', $idOrSlug);
            $query->orWhere('slug', $idOrSlug);
        });

        $film = $query->firstOr(['*'], function () {
            return false;
        });

        if ($film) {
            return response()->json($film->toArray());
        }

        return response()->json(['message' => 'Film not found'], 404);
    }

    public function destroy($id) {
        if ($film = Film::find($id)) {
            try {
                $film->delete();
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => 'Error while deleting film: ' . $exception->getMessage()
                ], 500);
            }

            return response()->json(['message' => 'Film deleted successfully']);
        } else {
            return response()->json(['message' => 'Film not found'], 404);
        }
    }
}
