<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use Illuminate\Http\Request;

class HookController extends Controller
{
    public function handel(Request $request)
    {
        if(isset($request->contacts)){
            $this->contact($request->contacts);
        }
        elseif (isset($request->leads)){
            $this->lead($request->leads);
        }

        info($request->all());
        return response()->json(['message' => 'Webhook processed successfully']);
    }

    public function contact($contacts): void
    {
        if($contacts->add){
            $this->createContact($contacts->add);
        }elseif ($contacts->update){
            $this->updateContact($contacts->update);
        }
    }
    public function lead($leads): void
    {
        if($leads->add){
            $this->createLead($leads->add);
        }elseif ($leads->update){
            $this->updateLead($leads->update);
        }
    }

    public function createContact($contact): void
    {
        Contact::create($contact);
    }

    public function updateContact($contacts): void
    {
        foreach ($contacts as $contact) {
            Contact::find($contact->id)->update($contact);
        }
    }
    public function createLead($lead): void
    {
        Lead::create($lead);
    }

    public function updateLead($leads): void
    {
        foreach ($leads as $lead){
            Lead::find($lead->id)->update($lead);
        }
    }



}
