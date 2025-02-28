<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function __construct($resource)
    {

        $resource->instance_name = $resource->{strtolower(class_basename($resource)) . '_name'};
        if ($resource->resources) {
            $resource = $this->resourcesFormatter($resource);
            // if ($resource->resources['official_document']) $resource->official_document = $resource->resources['official_document'][0]['instance'];
        }

        parent::__construct($resource);
    }

    private function resourcesFormatter($resource)
    {
        $tempData = [];

        $resource->resources->map(function ($instance) use (&$tempData) {
            $type = $instance->pivot->instance_type;

            // 初始化數組類型
            if (!isset($tempData[$type])) {
                $tempData[$type] = [];
            }
            // 追加數據
            $tempData[$type][] = [
                'content_language' => $instance->resource_content_language,
                'url' => $instance->authorize->resource_domain_url . $instance->resource_location
            ];
        });
        // 將臨時數據賦值回去
        foreach ($tempData as $type => $data) {
            $resource->{$type} = $data;
        }

        return $resource;
    }
}
