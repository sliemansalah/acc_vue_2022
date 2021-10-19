<?php


namespace Rfof\Domain\Seller\Coupons\Models;


trait SyncRelations
{
    public function syncItems($items)
    {
        $this->items()->sync(
            $this->makeSyncList($items, ['exclude' => false])
        );
    }

    public function syncExcludeItems($excludeItems)
    {
        $this->excludeItems()->sync(
            $this->makeSyncList($excludeItems, ['exclude' => true])
        );
    }

    private function makeSyncList($items, $pivotData)
    {
        $pivotData = array_fill(0, count($items), $pivotData);

        return array_combine($items, $pivotData);
    }
}
