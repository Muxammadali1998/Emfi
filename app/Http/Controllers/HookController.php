<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HookController extends Controller
{
    public function handel(Request $request)
    {
        try {
            if (isset($request->contacts)) {
                $this->contact($request->contacts);
            } elseif (isset($request->leads)) {
                $this->lead($request->leads);
            }
            return response()->json(['message' => 'Webhook processed successfully']);
        }
        catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }

    }

    public function contact($contacts): void
    {
        if (isset($contacts['add'])) {
            $this->saveContact($contacts['add'], $contacts['account']['subdomain']??'');
        } elseif (isset($contacts['update'])) {
            $this->saveContact($contacts['update'], $contacts['account']['subdomain']??'');
            $this->saveUpdatedContact($contacts['update'], $contacts['account']['subdomain']??'');
        }
    }

    public function lead($leads): void
    {
        if (isset($leads['add'])) {
            $this->saveLead($leads['add'], $leads['account']['subdomain']??'');
        } elseif (isset($leads['update'])) {
            $this->saveLead($leads['update'], $leads['account']['subdomain']??'');
            $this->saveUpdatedLead($leads['update'], $leads['account']['subdomain']??'');
        }
    }

    public function saveContact($contacts, $user): void
    {
        foreach ($contacts as $contact) {
            $contact['created_at'] = Carbon::createFromTimestamp($contact['created_at']);
            $contact['updated_at'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact[ 'responsible_user'] = $user;
            Contact::create($contact);

        }
    }

    public function saveUpdatedContact($contacts, $user): void
    {
        foreach ($contacts as $contact) {
            $contact['created_at'] = Carbon::createFromTimestamp($contact['created_at']);
            $contact['updated_at'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact['contact_id'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact[ 'responsible_user'] = $user;
            Contact::create( $contact);
        }
    }

    public function saveLead($contacts, $user): void
    {
        foreach ($contacts as $contact) {
            $contact['created_at'] = Carbon::createFromTimestamp($contact['created_at']);
            $contact['updated_at'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact[ 'responsible_user'] = $user;
            Lead::create($contact);

        }
    }

    public function saveUpdatedLead($contacts, $user): void
    {
        foreach ($contacts as $contact) {
            $contact['created_at'] = Carbon::createFromTimestamp($contact['created_at']);
            $contact['updated_at'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact['contact_id'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact[ 'responsible_user'] = $user;
            Lead::create( $contact);
        }
    }


}
