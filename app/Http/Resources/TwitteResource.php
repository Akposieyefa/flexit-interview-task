<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TwitteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' =>$this->message,
            'user'  => new UserResource($this->whenLoaded('user')),
            'comments'  => TwitteCommentResource::collection($this->whenLoaded('comments')),
            'likes'  => TwitteLikeResource::collection($this->whenLoaded('likes')),
            'slug'  => $this->slug,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ];
    }
}
