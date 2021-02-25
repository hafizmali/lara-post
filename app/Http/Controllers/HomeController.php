<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Tagable;

use App\Models\Video;
use App\Models\VideoDetails;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('auth', ['except' => [
            'showIndex'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $threads= Thread::with('tags' ,'video' ,'video.videoDetails')->get();
        return view('home', compact('threads'));

    }

    public function getThreadPage()
    {
        return view('thread.create');
    }

    public function saveThreadPage(Request  $request) {
        $s = [];
        $this->validate($request, [
            'subject' => 'required|min:5',
            'tags'    => 'required|not_in:0',
            'thread'  => 'required|min:10',
        ]);

        $thread = auth()->user()->threads()->create($request->all());

        if(!empty($request->videos))
        {

            $elements = [
                'name'      => $request->subject,
                'user_id'   => auth()->user()->id,
                'thread_id' => $thread->id,

            ];

            $video_id = Video::create($elements);
            $files = $request->videos;
            foreach ($files as $file) {
                $video           = $file;
                $input           = $this->generateRandomString(4).time().$video;
                $destinationPath = 'uploads/videos';

                Storage::disk('public')->put($input, $input);
                //    $video->move($destinationPath, $input);
                $check = TRUE;
                if($check) {
                    VideoDetails::create([
                        'video_id' => $video_id->id,
                        'filename' => $input
                    ]);

                } else {
                    return back()->with('error_message', 'Invalid Video Format!');
                }
            }
        }

        if(!empty($request->tags)) {
            $tag = explode(',', $request->tags[ 0 ]);
            if(!empty($tag)) {
                foreach ($tag as $s_tag) {
                    $t       = new Tags();
                    $t->name = $s_tag;
                    $t->save();
                    $s = [$thread->id, $t->id];

                }
                if(!empty($s)) {
                    $thread->tags()->attach($s);
                }

            }

        }


        return back()->withMessage('Thread Created!');
    }

    public function generateRandomString($length = NULL, $type = NULL) {

        if($type === NULL) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            $characters = '123456789';
        }
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[ rand(0, $charactersLength - 1) ];
        }
        return $randomString;
    }

    public function showIndex()
    {
        $threads= Thread::with('tags' ,'video' ,'video.videoDetails')->get();

        return view('welcome', compact('threads'));
    }
    public function showPost()
    {
        $threads= Thread::with('tags' ,'video' ,'video.videoDetails')->get();

        return view('thread.single', compact('threads'));
    }

    public function editPost($id = null)
    {
        $thread = Thread::find($id)->with('tags', 'video', 'video.videoDetails')->first();
        $thread_id = $id;

        return view('thread.edit', compact('thread' , 'thread_id'));
    }

    public function updatePost(Request $request) {

        if(!empty($request)) {
            $del = $this->destroy($request->thread_id, TRUE);
            if($del) {
                $s = [];
                $this->validate($request, [
                    'subject' => 'required|min:5',
                    'tags'    => 'required|not_in:0',
                    'thread'  => 'required|min:10',
                ]);

                $thread = auth()->user()->threads()->create($request->all());

                if(!empty($request->videos)) {

                    $elements = [
                        'name'      => $request->subject,
                        'user_id'   => auth()->user()->id,
                        'thread_id' => $thread->id,

                    ];

                    $video_id = Video::create($elements);
                    $files    = $request->videos;
                    foreach ($files as $file) {
                        $video = $file;
                        $input = $this->generateRandomString(4) . time() . $video;

                        Storage::disk('public')->put($input, $input);
                        $check = TRUE;
                        if($check) {
                            VideoDetails::create([
                                'video_id' => $video_id->id,
                                'filename' => $input
                            ]);

                        } else {
                            return back()->with('error_message', 'Invalid Video Format!');
                        }
                    }
                }

                if(!empty($request->tags)) {
                    $tag = explode(',', $request->tags[ 0 ]);
                    if(!empty($tag)) {
                        foreach ($tag as $s_tag) {
                            $t       = new Tags();
                            $t->name = $s_tag;
                            $t->save();
                            $s = [$thread->id, $t->id];

                        }
                        if(!empty($s)) {
                            $thread->tags()->attach($s);
                        }

                    }

                }
                return redirect()->route('show-post', $thread->id)->withMessage('Thread Updated!!');

            }//show-post
        }
        return back()->with('error_message', 'opps something wronged!');
    }
    public function destroy($id = null , $r = false)
    {

        $tag_id = null;
        $thread = Thread::find($id)->with('tags' ,'video' ,'video.videoDetails')->first();

        if(!empty($thread->video->videoDetails)){
            foreach($thread->video->videoDetails as $v_details){
                $path =  Storage::disk('public')->path($v_details->filename);
                if(file_exists($path)) {
                    unlink($path);
                }
                $vD = Video::where('thread_id' ,$id)->delete();
            }
        }

        if(!empty($thread->tags)){

            foreach($thread->tags as $tag){
                if(isset($tag->id)){
                    $tag_id = $tag->id;
                }
                $tag = Tagable::where('tags_id' ,$tag->id)->delete();

            }
            if(!isset($tag_id)){
                Tags::where('id' ,$tag_id)->delete();
            }

        }

        $th = Thread::where('id',$id)->delete();
        if($r){
            return true;
        }
        if($th){
            return redirect()->back()->withMessage("Thread Deleted!");
        }else{
            return redirect()->back()->with('error_message' , "Opps something wronged to delete!");
        }

    }
}
