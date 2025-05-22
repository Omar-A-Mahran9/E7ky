<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
  public function toArray($request)
    {

        return [
            'id'                 => $this->id,
            'name'            => $this->name,
            'description'     => $this->description,
            'content'         => $this->content,
            'author' => [
                'id'=>$this->admin ? $this->admin->id : null,
            'name'  => $this->admin ? $this->admin->name : null,
            'image' => $this->admin && $this->admin ? getImagePathFromDirectory($this->admin->image, 'Categories', 'default.png') : null,
            ],
            'image'              => $this->full_image_path, // Optional accessor
            'slide_image'        => $this->slide_image,
            'internal_image'     => $this->internal_image,
            'video'              => $this->video,
            'status'             => $this->status,
            'views'              => $this->views,
            'is_latest'          => $this->is_latest,
            'name_for_latest'    => $this->name_for_latest,
            'schedule'           => $this->schedule,
            'meta' => [
                'title'       => $this->meta_title,
                'description' => $this->meta_description,
                'keywords'    => $this->meta_keywords,
                'html_tags'   => $this->html_tags,
            ],
            'category_id'        => $this->category_id,
            'admin_id'           => $this->admin_id,
            'campaign_id'        => $this->campaign_id,
            'tag_id'             => $this->tag_id,
            'slug'               => $this->slug,
            'created_at'         => $this->created_at?->toDateTimeString(),
        ];
    }
}
