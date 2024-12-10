<?php


if (!function_exists('successResponse')) {
    /**
     * Returns Success Response Array
     *
     * @param mixed data Inide response data
     * @return array
     */
    function successResponse($data = null, $message = null, $additional = null)
    {

    	$response = [
            'success' => true,
            'data'    => $data,
            'pagination' =>  $data->total() > 0  ? [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
            ] : null,
            'message' => $message,
        ];

        if (is_array($additional)) $response = array_merge($response, $additional);
        return response($response, 200);
    }

}


if (!function_exists('simpleSuccessResponse')) {
    /**
     * Returns Success Response Array
     *
     * @param mixed data Inide response data
     * @return array
     */
    function simpleSuccessResponse($data = null, $message = null)
    {

    	$response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
        return response($response, 200);
    }

}

if (!function_exists('failMessageResponse')) {
    /**
     *  Returns Success Response Message
     *
     * @param mixed Message To Be Written or array of messages
     * @return array
     */
    function failMessageResponse($message)
    {
        return response([
            'success' => false,
            'message' => $message
        ], 400);
    }
}