<?php

namespace App\Http\Resources;


class ClassEntityResource extends AbstractResource
{
    public function toArray($request)
    {
        $ids = array_filter(array_merge($request->user()->children()->get()->pluck('id')->toArray(), [$request->user()->id]));

        return [
            'id'            => $this->id,
            'start_time'    => $this->start_time,
            'finish_time'   => $this->finish_time,
            'weekday'       => $this->weekday,
            'template'      => $this->template,
            'is_bookable'   => $this->isBookable($request->weekday ?? now()->weekday()),
            'is_booked_by_me'  => $this->isBookedByUser($ids)
        ];
    }
}
