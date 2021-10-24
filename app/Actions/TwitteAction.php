<?php

namespace App\Actions;

use App\Models\Twitte;
use App\Models\TwitteComment;
use App\Http\Resources\TwitteResource;
use App\Models\TwitteLike;

class TwitteAction
{
    private  $model;
    private  $comments;
    private  $like;     

    public  function  __construct(Twitte $model, TwitteComment $comments, TwitteLike $like)
    {
        $this->model = $model;
        $this->comments = $comments;
        $this->like = $like;
    }

    //create
    public  function  twitteCreate($request)
    {
        $create = $this->model->create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'message' => $request->message
        ]);
        if ($create) {
            return response()->json([
                'message' => 'Twitte posted successfully',
                'id' => $create->id,
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Sorry unable to post twitte',
                'success' => false
            ], 400);
        }
    }

    //get all
    public function allTwittes()
    {
        $twittes = $this->model->with(['user','comments', 'likes'])->latest()->paginate(10);
        if (count($twittes) < 1) {
            return response()->json([
                'message' => 'Sorry you dont have any twitte',
                'success' => false
            ], 200);
        }else {
            return TwitteResource::collection($twittes);
        }
    }

    //show all twittes comments
    public function twitteComments($id)
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $twitte_comments = $this->model->with(['comments','user', 'likes'])->find($id);
            return new TwitteResource($twitte_comments);
        }else {
            return response()->json([
                'message' => 'Sorry this data do not exist',
                'success' => false
            ], 404);
        }
    }

    //create twitte comment
    public function comment($request, $id)
    {
        $create = $this->comments->create([
            'twitte_id' => $id,
            'comment' => $request->comment,
            'user_id' => auth()->user()->id
        ]);
        if ($create) {
            return response()->json([
                'message' => 'Sent successfully',
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'message' => 'Sorry unable to send',
                'success' => false
            ], 400);
        }
    }

    //like twitte
    public function likeTwitte($id)
    {
        $check = $this->like->where('user_id', '=',auth()->user()->id)->where('twitte_id', '=', $id)->exists();
        if (!$check) {
            try {
                $create = $this->like->create([
                    'twitte_id' => $id,
                    'user_id' => auth()->user()->id,
                ]);
                return response()->json([
                    'message' => "Hey you've liked this now",
                    'success' => true
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Sorry unable like',
                    'success' => false
                ], 400);
            }  
        } else {
            return response()->json([
                'message' => "Sorry you can't like a twitte more than once",
                'success' => false
            ], 400);
        } 
    }

    //unlike twitte
    public function unLikeTwitte($id)
    {
        $check = $this->like->where('user_id', '=',auth()->user()->id)->where('twitte_id', '=', $id)->exists();
        if (!$check) {
            return response()->json([
                'message' => "Hey sorry you've not liked this before so hit the like button",
                'success' => false
            ], 400);
        } else {
           $find_twitte = $this->like->where('user_id', '=',auth()->user()->id)->where('twitte_id', '=', $id)->first();
           $delete =  $find_twitte->delete();
           if ($delete) {
                return response()->json([
                    'message' => "Hey you've successfully unliked this twitte",
                    'success' => false
                ], 200);
           }
        }  
    }

    //delete 
    public function delete($id)
    {
        $data = $this->model->where('id', '=', $id)->exists();
        if ($data) {
            $user =  $this->model->find($id);
            if (auth()->user()->id != $user->user_id) {
                return response()->json([
                    'message' => 'Sorry you can not delete this twitte',
                    'success' => false
                ], 402);
            }else {
               $delete = $user->delete();
                if ($delete) {
                    return response()->json([
                        'message' => 'Twitte deleted successfully',
                        'success' => true
                    ], 200);
                }else {
                    return response()->json([
                        'message' => 'Sorry unable to delete twitte',
                        'success' => false
                    ], 400);
                }
            }
  
        }else {
            return response()->json([
                'message' => 'Sorry this t do not exist',
                'success' => false
            ], 404);
        }
    }

}
