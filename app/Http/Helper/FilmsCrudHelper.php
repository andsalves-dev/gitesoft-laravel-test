<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Validator;

class FilmsCrudHelper {

    public static function createSlugByName($name) {
        $slug = mb_strtolower($name);
        $slug = str_replace([' ', '_'], ['-', '-'], $slug);
        $slug = preg_replace('/[^a-z-]/', '', $slug);

        return $slug;
    }

    /**
     * @param array $postData
     *
     * @param array $errors
     * @return bool
     */
    public static function validatePostData(array &$postData, array &$errors = null) {
        $validationFields = [
            'name' => ['required', 'max:64'],
            'description' => ['required'],
            'release_date' => ['required', 'regex:/^(\d{4}\-\d{2}\-\d{2})(\s\d{2}\:\d{2}\:\d{2}){0,1}$/'],
            'rating' => ['required', 'regex:/^((([1-4])(\.\d){0,1})|(5(\.0){0,1}))$/'],
            'ticket_price' => ['required', 'regex:/^(\d){1,5}(\.\d{1,2}){0,1}$/'],
            'slug' => ['regex:/^[a-z-]$/'],
            'country' => ['required'],
            'genres' => ['required'],
            'photo' => ['required']
        ];

        $validator = Validator::make($postData, $validationFields);

        $postData = array_filter($postData, function ($key) use ($validationFields) {
            return in_array($key, array_keys($validationFields));
        }, ARRAY_FILTER_USE_KEY);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return false;
        }

        return true;
    }

}