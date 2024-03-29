<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactHistory;
use App\Models\Lead;
use App\Models\LeadHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HookController extends Controller
{
    public function handel(Request $request)
    {
        try {
            if (isset($request->contacts)) {
                $this->contact($request->contacts, $request->account);
            } elseif (isset($request->leads)) {
                $this->lead($request->leads, $request->account);
            }
            return response()->json(['message' => 'Webhook processed successfully']);
        }
        catch (\Exception $exception){
            return response()->json(['message'=>$exception->getMessage()]);
        }

    }

    public function contact($contacts, $account): void
    {
        if (isset($contacts['add'])) {
            $this->saveContact($contacts['add'], $account['subdomain']??'');
            $this->saveUpdatedContact($contacts['add'], $account['subdomain']??'');

        } elseif (isset($contacts['update'])) {
            $this->saveContact($contacts['update'], $account['subdomain']??'');
            $this->saveUpdatedContact($contacts['update'], $account['subdomain']??'');
        }
    }

    public function lead($leads, $account): void
    {
        if (isset($leads['add'])) {
            $this->saveLead($leads['add'], $account['subdomain']??'');
            $this->saveUpdatedLead($leads['add'], $account['subdomain']??'');

        } elseif (isset($leads['update'])) {
            $this->saveLead($leads['update'], $account['subdomain']??'');
            $this->saveUpdatedLead($leads['update'], $account['subdomain']??'');
        }
    }

    public function saveContact($contacts, $user): void
    {
        foreach ($contacts as $contact) {

            $contact['created_at'] = Carbon::createFromTimestamp($contact['created_at']);
            $contact['updated_at'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact[ 'responsible_user'] = $user;

            Contact::updateOrCreate(['id'=>$contact['id']],$contact);
        }
    }

    public function saveUpdatedContact($contacts, $user): void
    {
        foreach ($contacts as $contact) {
            $contact['created_at'] = Carbon::createFromTimestamp($contact['created_at']);
            $contact['updated_at'] = Carbon::createFromTimestamp($contact['updated_at']);
            $contact['contact_id'] = $contact['id'];
            $contact[ 'responsible_user'] = $user;
            ContactHistory::create( $contact);
        }
    }

    public function saveLead($leads, $user): void
    {
        foreach ($leads as $lead) {
            $lead['created_at'] = Carbon::createFromTimestamp($lead['created_at']);
            $lead['updated_at'] = Carbon::createFromTimestamp($lead['updated_at']);
            $lead[ 'responsible_user'] = $user;
            Lead::updateOrCreate(['id'=>$lead['id']],$lead);

        }
    }

    public function saveUpdatedLead($leads, $user): void
    {
        foreach ($leads as $lead) {
            $lead['created_at'] = Carbon::createFromTimestamp($lead['created_at']);
            $lead['updated_at'] = Carbon::createFromTimestamp($lead['updated_at']);
            $lead['lead_id'] = $lead['updated_at'];
            $lead[ 'responsible_user'] = $user;
            LeadHistory::create( $lead);
        }
    }


}
