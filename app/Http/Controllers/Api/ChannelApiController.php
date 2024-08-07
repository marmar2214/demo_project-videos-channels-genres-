<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __invoke(Request $request)
    {
        dd($request);
        $request->validate([
            'x-lang' => 'sometimes|in:my,en',
        ]);
        // Get language from header, default to 'my'
        $lang = $request->header('x-lang', 'my');

        // Build the query based on language
        $query = Channel::query()->where('status', 1);
        if ($lang == 'my') {
            $query->select('id', 'name_mm as get_name', 'image_path');
        } else {
            $query->select('id', 'name as get_name', 'image_path');
        }

        // Fetch the data
        $channels = $query->get();

        // Check if data is found
        // if ($channels->isEmpty()) {
        //     return response()->json(['message' => 'No channels found'], 404);
        // }

        // Transform the data
        $transformedData = ChannelResource::collection($channels);

        // Dump the transformed data
        dd($transformedData);

        // Return the response in JSON format
        return [
            'language' => $lang,
            'data' => $transformedData,
        ];

    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
