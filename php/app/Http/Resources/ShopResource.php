<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
        $reviews = $this->reviews->where('uuid_status', 1);

        $miniData = [
            'id' => $this['id'],
            'name' => $this['name'],
            'address' => $this['address'],
            'feature_image' => $this['feature_image'],
            'views' => $this['views'] ?? 0,
            'average_rate' => $this->reviews->where('uuid_status' , 1)->avg('rate') ?? 0,
            'rates_count' => $this->reviews->where('uuid_status', 1)->count(),
            'distance' => $this->distance ? round($this->distance, 2) : "",
            'added_to_favourite' => $this->existsInFavourite ? true : false,
            'rating_points' => [
                'number' => $reviews->sum('rate'),
                'short_number' => shortNumber($reviews->sum('rate'))
            ],
        ];

        $basicData = [
            'id' => $this['id'],
        ];

        $fullData = [
            'id' => $this['id'],
            'mobile_1' => $this['mobile_1'],
            'mobile_2' => $this['mobile_2'],
            'phone_1' => $this['phone_1'],
            'phone_2' => $this['phone_2'],
            'hotline' => $this['hotline'],
            'latitude' => $this['latitude'],
            'longitude' => $this['longitude'],
            'facebook' => $this['facebook'],
            'instagram' => $this['instagram'],
            'working_time' => [
                'days' => $this['working_days'],
                'from' => custom_hour($this['start_at']),
                'to' => custom_hour($this['end_at']),
            ],
            'category' => $this['category_id'] ? new CategoryResource($this->category) : null,
            'rate_statics' => [
                'count_of_1_rates' => $reviews->where('rate', 1)->count(),
                'count_of_2_rates' => $reviews->where('rate', 2)->count(),
                'count_of_3_rates' => $reviews->where('rate', 3)->count(),
                'count_of_4_rates' => $reviews->where('rate', 4)->count(),
                'count_of_5_rates' => $reviews->where('rate', 5)->count(),
            ],
            'slider_images' => FileCenterResource::collection($this->gallery),
            'comments_count' => $this->comments()->where('uuid_status', 1)->count(),
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
