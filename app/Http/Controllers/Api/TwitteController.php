<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TwitteRepositoryInterface;
use App\Models\Twitte;

class TwitteController extends Controller
{
    private $twitteRepositoryInterface;

    public  function  __construct(TwitteRepositoryInterface $twitteRepositoryInterface)
    {
        $this->twitteRepositoryInterface = $twitteRepositoryInterface;
        $this->middleware('auth:api');
    }

    public function index()
    {
        return $this->twitteRepositoryInterface->allTwittes();
    }

    public function show($id)
    {
        return $this->twitteRepositoryInterface->showTwitteComments($id);
    }

    public function store(Request $request)
    {
        return $this->twitteRepositoryInterface->twitteCreate($request);
    }

    public function comment(Request $request, $id)
    {
        return $this->twitteRepositoryInterface->twitteComment($request, $id);
    }

    public function likeTwitte($id)
    {
        return $this->twitteRepositoryInterface->likeTwitte($id);
    }

    public function unLikeTwitte($id)
    {
        return $this->twitteRepositoryInterface->unLikeTwitte($id);
    }

    public function destroy($id)
    {
        return $this->twitteRepositoryInterface->deleteTwitte($id);
    }

}
