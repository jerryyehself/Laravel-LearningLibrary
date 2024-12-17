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
        $resource->resources->map(function ($instance) use (&$resource) {
            // dd($instance->toArray());
            $resource->{$instance->pivot->instance_type} = [
                'content_languang' => $instance->resource_content_language,
                'url' => $instance->authorize->resource_domain_url . $instance->resource_location
            ];
            // return [
            //     'instance_type' => $instance->pivot->instance_type,
            //     'instance' => $instance->authorize->resource_domain_url . $resource->resource_location
            // ];
        })
            ->groupBy('instance_type')
            ->toArray();

        return $resource;
    }
}
