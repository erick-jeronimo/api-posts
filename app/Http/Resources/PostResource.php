<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "body" => $this->body,
            "owner" => new UserResource($this->user),
            "comments" => CommentResource::collection($this->comments),
            "likes" => $this->likes,
            "created_at" => $this->created_at->format('l jS \of F Y h:i:s A'),
            "updated_at" => $this->updated_at->format('l jS \of F Y h:i:s A'),
        ];
    }
}
