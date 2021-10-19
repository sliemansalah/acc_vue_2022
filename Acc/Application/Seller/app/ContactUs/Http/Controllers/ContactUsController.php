<?php


namespace Acc\Seller\ContactUs\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Acc\Domain\Core\Response;
use Acc\Domain\Seller\ContactUs\Services\ContactUsService;
use Acc\Seller\ContactUs\Http\Requests\ContactUsRequest;

class ContactUsController extends Controller
{


    public function store(ContactUsRequest $request)
    {
       $contact =  $this->service()->save([
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=> $request->message,
            'store_id'=> Auth::guard('store')->id(),
        ]);

        if($request->hasfile('attachments'))
        {
            foreach($request->file('attachments') as $file)
            {
                $name = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/upload/', $name);
                $data[] = $name;
            }
            $contact->update([
                'attachments'=>json_encode($data),
            ]);
        }

       return Response::success()->withMessage('Saved Successfully')->send();
    }

    public function service()
    {
        return new ContactUsService();
    }
}
