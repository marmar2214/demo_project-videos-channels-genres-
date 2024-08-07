<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Video;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $videos = Video::query()->with('channels')->paginate(5);
        // dd($videos->pluck('channels'));
        // Create a dynamic property `channel_names` to display channel names
        foreach ($videos as $video) {
            $video->channel_names = $video->channels->pluck('name')->implode(', ');
            // dd($video->channel_names);
        }

        $default = [
            'title' => 'nav.videos',
            'active' => 'videos',
            'create_btn' => route('videos.create'),
            'videos' => $videos,
        ];
        return view('pages.videos.index', $default);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $channels = Channel::all();
        $default = [
            'title' => 'nav.videos',
            'active' => 'videos',
            'back_btn' => route('videos.index'),
            'channels' => $channels,
        ];
        return view('pages.videos.create', $default);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'new_image' => 'nullable|file|image|max:2048',
            'channels' => 'nullable|array',


        ]);

        $video = Video::create($request->except('channels'));
        // Sync Channels
        if ($request->has('channels')) {
            $video->channels()->sync($request->input('channels'));
        }

        if ($request->input('youtube_url')) {
            $response = Http::acceptJson()->get('https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v='.$request->input('youtube_url').'&format=json');
            if ($response->ok()) {
                $youtube_title = $response->object()->title;

            }
        }

        $fileName = time().'.'.$request->myday_image->extension();
        // dd($fileName);

        // Handle file upload
        if($request->hasFile('myday_image')){

            $upload = $request->myday_image->move(public_path('images/'), $fileName);
            if ($upload) {
                $video->myday_image = "/images/".$fileName;
            }
        }
        // Sync Channels
        // if ($request->has('channels')) {
        //     $video->channels()->sync($request->input('channels'));
        // }
        $video->save();

        return redirect()->route('videos.index')->with('msg', 'Successfully Created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video = Video::with(['channels'])->find($id);
        // dd($video);
        if ($video) {
            // Create a dynamic property `channel_names` to display channel names
            $video->channel_names = $video->channels->pluck('name')->implode(', ');
            // dd($video->channel_names);
        }
        $default = [
            'title' => 'nav.videos',
            'active' => 'videos',
            'back_btn' => route('videos.index'),
            'video' => $video,
        ];

        return view('pages.videos.show', $default);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::findOrFail($id);
        $channels = Channel::pluck('name', 'id');
        $selectedChannels = $video->channels->pluck('id')->toArray();
        $default = [
            'title' => 'nav.videos',
            'active' => 'videos',
            'back_btn' => route('videos.index'),
            'channels' => $channels,
            'video' => $video,
            'selectedChannels' => $selectedChannels,
        ];
        return view('pages.videos.edit', $default);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        $video = Video::findOrFail($id);
        // $video->update($request->all());
        // dd($video);

         $data = $request->except('channels');
        // Check if the youtube_url is provided and fetch youtube title
        if ($request->input('youtube_url') && $request->input('youtube_url') !== $video->youtube_url) {
            $response = Http::acceptJson()->get('https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v='.$request->input('youtube_url').'&format=json');
            if ($response->ok()) {
                $youtube_title = $response->object()->title;
            }
        }

        // dd($data);

        // Handle file upload
        if ($request->hasFile('new_image')) {
            $fileName = time() . '.' . $request->new_image->extension();
            $upload = $request->new_image->move(public_path('images/'), $fileName);
            if ($upload) {
                $video->myday_image = "/images/" . $fileName;
            }
        }else{
            $data['myday_image']= $request->old_image;
        }
        $video->update($data);
        if ($request->has('channels')) {
            $video->channels()->sync($request->input('channels', []));
        }

        return redirect()->route('videos.index')->with('msg', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function remove(string $id)
    {
        Video::find($id)->delete();

        return back()->with('msg', 'Successfully Deleted!');
    }
}
