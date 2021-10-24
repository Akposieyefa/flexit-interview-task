<?php

namespace App\Repositories;

use App\Actions\TwitteAction;
use App\Repositories\Contracts\TwitteRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class TwitteRepository implements  TwitteRepositoryInterface
{
    private  $action;

    public  function  __construct(TwitteAction $action)
    {
        $this->action = $action;
    }

    //create a Twitte
    public function twitteCreate($request)
    {
        $validator =  Validator::make($request->all(),[
            'title' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->TwitteCreate($request);
        }
    }

    //Twitte chat
    public function twitteComment($request, $id)
    {
        $validator =  Validator::make($request->all(),[
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->first(),
                'success' => false
            ], 422);
        }else {
            return $this->action->comment($request, $id);
        }
    }

    //get all twittes
    public function allTwittes()
    {
        return $this->action->allTwittes();
    }

    //show twitte comments
    public function showTwitteComments($id)
    {
        return $this->action->twitteComments($id);
    }

    //like twitte
    public function likeTwitte($id)
    {
        return $this->action->likeTwitte($id);
    }

    //unlike twitte
    public function unLikeTwitte($id) 
    {
        return $this->action->unLikeTwitte($id);
    }

    //delete 
    public function deleteTwitte($id)
    {
        return $this->action->delete($id);
    }

}
