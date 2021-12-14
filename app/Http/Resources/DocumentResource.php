<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'staffs' => $this->staffs,
            'category_id' => $this->category_id,
            'from' => $this->from,
            'to' => $this->to,
            'file_ref' => $this->file_ref,
            'attn' => $this->attn,
            'date_issued' => $this->date_issued,
            'cc' => $this->cc,
            'subject' => $this->subject,
            'content' => $this->content,
            'for_secretary' => $this->for_secretary,
            'status' => $this->status,
            'pdf_url' => $this->pdf_url,
            'user_id' => $this->user_id,
        ];
    }
}
