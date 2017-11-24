<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helper\FilmsCrudHelper;
use App\Model\Film;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author Andsalves
 */
class FilmsRestController extends Controller {

    /**
     * Fetch all and also some query
     */
    public function index() {
        $where = [];

        foreach (request()->query() as $key => $value) {
            if (in_array($key, ['name', 'description'])) {
                $where[] = [$key, '=', $value];
            }

            if (in_array($key, ['name_like', 'description_like'])) {
                $where[] = [str_replace('_like', '', $key), 'like', "%$value%"];
            }
        }

        return response()->json(Film::where($where)->orderBy('created_at','DESC')->get());
    }

    public function store() {
        $postData = request()->post();

        if (!FilmsCrudHelper::validatePostData($postData, $errors)) {
            return response()->json([
                'message' => 'Validation error',
                'validation_messages' => $errors
            ], 422);
        }

        if (!isset($postData['slug'])) {
            $postData['slug'] = FilmsCrudHelper::createSlugByName($postData['name']);
        }

        $genres = $postData['genres'];
        unset($postData['genres']);

        if (!is_array($genres)) {
            $genres = explode(',', str_replace(' ', '', $genres));
        }

        if (Film::where([['slug', '=', $postData['slug']]])->get()->count()) {
            return response()->json([
                'message' => sprintf("film with name slug '%s' already exists", $postData['name'])
            ], 409);
        }

        try {
            $film = new Film();
            $film->fill($postData);
            $film->save();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Error while inserting new film: ' . $exception->getMessage()
            ], 500);
        }

        foreach ($genres as $genre) {
            $film->genres()->attach($genre);
        }

        return response()->json([
            'message' => 'Film inserted successfully',
            'data' => $film->toArray()
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
