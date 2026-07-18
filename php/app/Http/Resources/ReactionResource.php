<?php

namespace App\Http\Resources;

use App\Models\Reaction;
use Illuminate\Http\Resources\Json\JsonResource;

class ReactionResource extends JsonResource
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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $reaction=Reaction::find($this['id']);

        $miniData = [
            'id' => $this['id'],
        ];

        $basicData = [
            'id' => $this['id'],
            'status' => status_value($reaction),
            'user' => (new UserResource($this['user']))->returnData('mini')
        ];

        $fullData = [
            'id' => $this['id'],
        ];

        $fullData = array_merge($miniData, $fullData);

        if (in_array($this->returnData, ['mini', 'basic','full'])) {
            $returnVariableName=$this->returnData . 'Data';
            return $$returnVariableName;
        }

        return $basicData;

        return parent::toArray($request);
    }
}
