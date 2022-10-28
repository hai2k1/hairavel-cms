<?php

namespace Modules\Cms\Traits;

use Modules\Cms\Model\CmsTags;

/**
 *Class RoleHas
 * @package Hairavel\Core\Traits
 */
trait Tags
{

    /**
     * Tag association
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(CmsTags::class, 'has', 'cms_tags_has', 'has_id', 'tag_id');
    }


    /**
     * Sync tags
     * @param $tags
     */
    public function retag($tags)
    {
        $tags = $this->formatTags($tags);
        // Get the associated tag
        $infoTags = $this->tags->pluck('name')->toArray();

        $deletions = array_diff($infoTags, $tags);
        $additions = array_diff($tags, $infoTags);

        $this->untag($deletions);

        foreach ($additions as $vo) {
            $this->addTag($vo);
        }

    }

    /**
     * delete tag
     * @param array $tags
     */
    public function untag($tags = [])
    {
        if ($tags) {
            $tags = $this->formatTags($tags);
        }else {
            $tags = $this->tags->pluck('name')->toArray();
        }
        foreach ($tags as $vo) {
            $tagInfo = $this->tags()->where('name', $vo)->first();
            // remove association
            $this->tags()->detach($tagInfo->tag_id);
            if ($tagInfo->count <= 1) {
                // One remaining delete tag
                $tagInfo->delete();
            } else {
                $tagInfo->decrement('count');
            }
        }
    }

    /**
     * Add a single tag
     * @param $tag
     */
    private function addTag($tag) {
        $tagName = trim($tag);

        if(strlen($tagName) == 0) {
            return;
        }

        $tagInfo = $this->tags()->where('name', $tagName)->first();
        if ($tagInfo) {
            // Increment the number of references
            $tagInfo->increment('count');
            $tagId = $tagInfo->tag_id;
        } else {
            // create application
            $tagInfo = new CmsTags;
            $tagInfo->name = $tagName;
            $tagInfo->count = 1;
            $tagInfo->view = 1;
            $tagInfo->save();
            $tagId = $tagInfo->tag_id;
        }
        $this->tags()->attach($tagId);
    }


    /**
     * format tags
     * @param $tags
     * @return array
     */
    private function formatTags($tags)
    {
        if (is_string($tags)) {
            $tags = explode(',', $tags);
        }

        if (is_array($tags)) {
            $tags = array_filter($tags);
        }
        $tags = array_map('trim', $tags);

        return array_values($tags);
    }


}
