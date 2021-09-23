<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Slug
{
    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function createSlug($model, $title, $id = 0)
    {
        $slug = Str::slug($title);

        $allSlugs = $this->getRelatedSlugs($model, $slug, $id);
        if (!$allSlugs->contains("slug", $slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . "-" . $i;
            if (!$allSlugs->contains("slug", $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception("Impossible de créer un slug unique");
    }

    protected function getRelatedSlugs($model, $slug, $id = 0)
    {
        return $model->select("slug")->where("slug", "like", $slug . "%")
            ->where("id", "<>", $id)
            ->get();
    }
}