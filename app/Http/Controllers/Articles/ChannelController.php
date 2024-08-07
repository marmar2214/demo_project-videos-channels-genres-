<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ChannelController extends Controller
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
        $channels = Channel::query()->paginate(5);
        $default = [
            'title' => 'nav.channels',
            'active' => 'channels',
            'create_btn' => route('channels.create'),
            'channels' => $channels ?? [],
        ];
        return view('pages.channels.index', $default, ['channels' => $channels,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $default = [
            'title' => 'nav.channels',
            'active' => 'channels',
            'back_btn' => route('channels.index'),
        ];
        return view('pages.channels.create', $default);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request)->all();

        $channel = new Channel($request->except('image_path'));
        //file uploadimage

        // Handle file upload if an image was provided
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path'); // Get the uploaded file
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Create a unique file name

            // Store the file in a custom directory under 'storage/app/custom-folder'
            $filePath = $file->storeAs('custom-image', $fileName, 'public');

            // Set the path to the database (relative to the public directory)
            $channel->image_path = 'storage/custom-image/' . $fileName;
        }

        // $fileName = time().'.'.$request->image_path->extension();
        // // dd($fileName);
        // $upload = $request->image_path->move(public_path('images/'), $fileName);
        // if($upload){
        //     $channel->image_path = "/images/" .$fileName;
        // }

        $channel->save();
        return redirect()->route('channels.index')->with('msg', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $channel = Channel::find($id);
        $default = [
            'title' => 'nav.channels',
            'active' => 'channels',
            'back_btn' => route('channels.index'),
            'channel' => $channel,
        ];
        return view('pages.channels.edit', $default);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $channel = Channel::findOrFail($id);
        // Update the channel with the request data (excluding the image)
        $channel->update($request->except('new_image'));
        // dd($channel);
        if($request->hasFile('new_image')){
            $fileName = time().'.'.$request->new_image->extension();
            // dd($fileName);
            $upload = $request->new_image->move(public_path('images/'), $fileName);
            if($upload){
                $channel->image_path = "/images/".$fileName;
            }
        }else{
            $channel->image_path = $request->old_image;
        }
        $channel->save();
        return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Channel::find($id)->forceDelete();
        return back();
    }
    public function toggleStatus(string $id)
    {
        $channel = Channel::find($id);
        $channel->status = ! $channel->status;
        $channel->save();
    }

    public function remove(string $id)
    {
        Channel::find($id)->delete();
        return back();
    }
}
