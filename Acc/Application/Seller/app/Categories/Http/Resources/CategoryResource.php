<?php


namespace Acc\Seller\Categories\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'status' => $this->status,
            $this->mergeWhen(isset($this->parent),
                ['parent' => $this->getParent()]
            ),
            $this->mergeWhen(!isset($this->parent),
                ['children' =>  $this->getChildren($this->children)]
            ),
        ];
    }

    public function listCategory()
    {
        return [
            'value' => $this->id,
            'label' => $this->name
        ];
    }

    public function getParent()
    {
        return [
            'id' => @$this->parent->id,
            'name' => @$this->parent->name,
            'image' => @$this->parent->image,
            'status' => $this->status,
        ];
    }


    public function getChildren($children)
    {
        return $this->map($children, function ($child) {
            return [
                'id' => @$child['id'],
                'name' => @$child['name'],
                'image' => @$child['image'],
                'status' => @$child['status'],
                $this->mergeWhen(isset($child['parent']),
                    ['children' => $this->getChildren($child['children'])]
                ),
            ];
        });
    }

    private function map($items, $callback)
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $callback($item);
        }

        return $result;
    }
}
