<?php

namespace App\Http\Helper;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

/**
 * @author Andsalves
 */
class CommentsCrudHelper {

    /**
     * @param array $postData
     *
     * @param array|MessageBag $errors
     * @return bool
     */
    public static function validatePostData(array &$postData, &$errors = null) {
        $validationFields = [
            'name' => 'required|string|max:128',
            'comment' => 'required|string|max:500',
            'film_id' => 'required',
            'user_id' => 'exists:users,id'
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