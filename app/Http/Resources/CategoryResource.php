<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
        ];

        if (in_array($this->returnData, ['mini', 'basic'])) {
            $returnVariableName = $this->returnData . 'Data';
            return $$returnVariableName;
        }

        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'feature_image' => $this['feature_image'],
            'views' => $this['views'] ?? 0,
            'subcategories_count' => $this->subCategories()->count(),
        ];
//        return parent::toArray($request);
    }
}
