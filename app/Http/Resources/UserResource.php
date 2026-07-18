<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this['name'],
            'avatar' => asset($this['avatar']),
        ];

        $basicData = [
            'id' => $this['id'],
            'name' => $this['name'],
            'email' => $this['email'],
            'mobile' => $this['mobile'],
            'verification_status' => $this['verification_status'],
            'avatar' => asset($this['avatar']),
            'device_id' => $this['device_id'],
            'device_token' => $this['device_token'],
        ];

        if (in_array($this->returnData, ['mini', 'basic'])) {
            $returnVariableName = $this->returnData . 'Data';
            return $$returnVariableName;
        }

        return parent::toArray($request);
    }
}
