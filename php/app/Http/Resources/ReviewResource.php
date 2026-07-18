<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
        ];

        $basicData = [
            'id' => $this['id'],
            'shop_id'=>$this['shop_id'],
            'rate'=>$this['rate'],
            'comment'=>$this['comment'],
            'user'=>(new UserResource($this->user))->returnData('mini'),
            'updated_at'=>Carbon::parse($this['updated_at'])->diffForHumans()
        ];

        if (in_array($this->returnData, ['mini', 'basic'])) {
            $returnVariableName = $this->returnData . 'Data';
            return $$returnVariableName;
        }

        return $basicData;

        return parent::toArray($request);
    }
}
