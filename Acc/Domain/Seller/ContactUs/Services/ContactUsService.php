<?php


namespace Acc\Domain\Seller\ContactUs\Services;


use Illuminate\Support\Facades\DB;
use Acc\Domain\Core\Response;
use Acc\Domain\Core\Services\PersistService;
use Acc\Domain\Seller\ContactUs\Models\ContcatUs;
use Acc\Seller\ContactUs\Http\Resources\ContactUsResource;
use function PHPUnit\Framework\returnValue;

class ContactUsService extends PersistService
{
    public static $model = ContcatUs::class;
    public static $resource = ContactUsResource::class;

//    public function save($data)
//    {
//        $contact = new ContcatUs();
//        $contact->save([
//            'name'=> 'mousab',
//            'email'=> $data['email'],
//            'message'=> $data['message'],
//            'store_id'=> 1,
//        ]);
////        $contact = $this->newQuery()->save([
////            'name'=> $request->name,
////            'email'=> $request->email,
////            'message'=> $request->message,
////            'store_id'=> $request->store_id,
////        ]);
//
//        if($request->hasfile('attachments'))
//        {
//            foreach($request->file('attachments') as $file)
//            {
//                $name = time().'.'.$file->getClientOriginalExtension();
//                $file->move(public_path().'/upload/', $name);
//                $data[] = $name;
//            }
//            $contact->update([
//                'attachments'=>json_encode($data)
//            ]);
//        }
//
//
//
//    }

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
