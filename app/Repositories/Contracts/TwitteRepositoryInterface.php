<?php

namespace App\Repositories\Contracts;

interface TwitteRepositoryInterface
{
    public function twitteCreate($request);

    public function twitteComment($request, $id);

    public function allTwittes();

    public function showTwitteComments($id);

    public function deleteTwitte($id);

    public function likeTwitte($id);

    public function unLikeTwitte($id);

}
