<?php

namespace App\Http\Resources;


class ClassEntryResource extends AbstractResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'status'    => $this->status,
            'start'     => $this->entity->start_time,
            'finish'    => $this->entity->finish_time,
            'user_id'   => $this->user_id,
            'user'      => $this->user->username,
            'template'  => new ClassTemplateResource($this->entity->template)
        ]; // TODO: Change the autogenerated stub
    }
}
