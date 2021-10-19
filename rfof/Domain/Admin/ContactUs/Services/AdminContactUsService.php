<?php

namespace Rfof\Domain\Admin\ContactUs\Services;

use Rfof\Domain\Core\Services\AdminPersistService;
use Rfof\Domain\Admin\ContactUs\Models\AdminContcatUs;
use Rfof\Admin\ContactUs\Http\Resources\AdminContactUsResource;


class AdminContactUsService extends AdminPersistService
{
    public static $model = AdminContcatUs::class;
    public static $resource = AdminContactUsResource::class;

    public function delete($data)
    {
        $contacts = $this->newQuery()->whereIn('id', explode(',', $data['ids']))->get();
        foreach ($contacts as $contact) {
            $oneContact = $this->newModel()->findOrFail($contact->id);
            if ($oneContact->attachments != null)
                foreach (json_decode($oneContact->attachments) as $attachment) {
                    $contact_path = public_path() . "/upload/" . $attachment;
                    unlink($contact_path);
                }

            $oneContact->delete();
        }
    }

}
