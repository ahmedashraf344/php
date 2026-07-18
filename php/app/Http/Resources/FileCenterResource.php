<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileCenterResource extends JsonResource
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
            'path' => $this['file'],
            'extension' => $this['extension'],
        ];

        $basicData = [
            'id' => $this['id'],
        ];

        if (in_array($this->returnData, ['mini', 'basic'])) {
            $returnVariableName = $this->returnData . 'Data';
            return $$returnVariableName;
        }

        return $miniData;

        return parent::toArray($request);
    }
}
