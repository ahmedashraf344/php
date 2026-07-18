<?php

namespace App\Http\Resources;

use App\Models\Reaction;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    protected $returnData;

    /**
     * customize resource return data
     *
     * @param $returnData
     */
    public function returnData($returnData)
    {
        $this->returnData = $returnData;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $miniData = [
            'id' => $this['id'],
            'created_at' => custom_date($this['created_at']),
            'name' => $this['name'],
            'content' => str_limit($this['content'], 200, '....'),
            'image' => $this['image'],
            'views' => $this['views'] ?? 0,
            'comments' => $this->publishedComments()->count(),
            'likes' => $this->likes()->count(),
            'dislikes' => $this->dislikes()->count(),
            'user' => (new UserResource($this['user']))->returnData('mini'),
            'reaction_case' => optional($this->authReaction())['status'] ?: Reaction::STATUS_NONE,
        ];

        $basicData = [
            'id' => $this['id'],
        ];


        $fullData = [
            'id' => $this['id'],
            'comments_list' => CommentResource::collection($this->publishedComments()->take(2)->get()),
            'likes_list' => ReactionResource::collection($this->likes()->get()),
            'dislikes_list' => ReactionResource::collection($this->dislikes()->get()),
        ];

        $fullData = array_merge($miniData, $fullData);

        if (in_array($this->returnData, ['mini', 'basic', 'full'])) {
            $returnVariableName = $this->returnData . 'Data';
            return $$returnVariableName;
        }

        return $miniData;

        return parent::toArray($request);
    }
}
