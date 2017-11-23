<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Film;
use Illuminate\Support\Facades\Validator;

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

        return response()->json(Film::where($where)->get());
    }

    public function store() {
        $postData = request()->post();
        $validator = Validator::make($postData, [
            'name' => ['required', 'max:64'],
            'description' => ['required'],
            'release_date' => ['required', 'regex:/^(\d{4}\-\d{2}\-\d{2})(\s\d{2}\:\d{2}\:\d{2}){0,1}$/'],
            'rating' => ['required', 'regex:/^((([1-4])(\.\d){0,1})|(5(\.0){0,1}))$/'],
            'ticket_price' => ['required', 'regex:/^(\d){1,5}(\.\d{1,2}){0,1}$/'],
            'country' => ['required'],
            'genre' => ['required'],
            'photo' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'validation_messages' => $validator->errors()
            ], 422);
        }

        if (Film::where([['name', '=', $postData['name']]])->get()->count()) {
            return response()->json([
                'message' => sprintf("film with name '%s' already exists", $postData['name'])
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

        return response()->json([
            'message' => 'Film inserted successfully',
            'data' => $film->toArray()
        ], 201);
    }

    public function show($id) {
        if ($film = Film::find($id)) {
            return response()->json($film);
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
