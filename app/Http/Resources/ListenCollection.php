<?php

namespace App\Http\Resources;

use App\Http\Resources\Listen;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListenCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];

        foreach ($this->collection as $listen) {
            $data[] = new Listen($listen);
        }

        return [
            'data' => $data,
            'latest_scrobble_date' => $this->collection->pop()->listened_at->toDateTimeString(),
        ];
    }
}
