<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
        $comment = Comment::find($this['id']);

        $miniData = [
            'id' => $this['id'],
        ];

        $basicData = [
            'id' => $this['id'],
            'content' => str_limit($this['content'], 200, '....'),
            'status' => status_value($comment),
            'positive_type' => $this['positive_type'],
            'date'=>$this['create_date'],
            'user' => $this['user'] ? (new UserResource($this['user']))->returnData('mini') : __('deleted user'),
        ];

        $fullData = [
            'id' => $this['id'],
        ];

        $fullData = array_merge($miniData, $fullData);

        if (in_array($this->returnData, ['mini', 'basic', 'full'])) {
            $returnVariableName = $this->returnData . 'Data';
            return $$returnVariableName;
        }

        return $basicData;

        return parent::toArray($request);
    }
}
