<?php

namespace App\Livewire;

use App\Mail\VisitorArrival;
use App\Models\Handler;
use App\Models\Sacco;
use App\Models\Saccos;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    public $personal_information = [
        "Name" => "",
        "ID_Number" => "",
        "Phone_Number" => "",
        "Email_Address" => ""
    ];
    public $isNext = false;

    #[On('click-next-event')]
    public function handleEvent($personal_information)
    {
        $this->isNext = true;
        $this->personal_information["Name"] = $personal_information["Name"];
        $this->personal_information["ID_Number"] = $personal_information["ID Number"];
        $this->personal_information["Phone_Number"] = $personal_information["Phone Number"];
        $this->personal_information["Email_Address"] = $personal_information["Email Address"];
        Log::info("This Personal Information ", [$this->personal_information]);
    }

    #[On('back-click-event')]
    public function handleBackClickEvent()
    {
        $this->isNext = false;
    }


    #[On('finish-click-event')]
    public function handleFinishClick($official_information)
    {
        $mail_to = "";
        $subject = "";
        Log::info("Finish click event handled");
        $visitor = [
            "name" => $this->personal_information["Name"],
            "phone_number" => $this->personal_information["Phone_Number"],
            "ID/Passport_number" => $this->personal_information["ID_Number"],
            "email" => $this->personal_information["Email_Address"],
            "purpose_of_visit" => $official_information["Selected Purpose"],
        ];

        if ($official_information["Selected Purpose"] == "Offical Visit") {
            $visitor["person_to_visit"] = $official_information["Person to Visit"];
        }
        if ($official_information["Selected Purpose"] == "Make a complaint" || $official_information["Selected Purpose"] == "Accounts") {
            $visitor["sacco_id"] = $official_information["SACCO_Name"];
            // $portfolio_id = $this->getSaccoPortfolioID($official_information["SACCO_Name"]);
            // Log::info("SACCO PORTFOIO: ", [$portfolio_id]);
            // Log::info("SACCO_ID", [$official_information["SACCO_Name"]]);
            $mail_to = $this->getPortfolioHandler($official_information["SACCO_Name"]);
            Log::info("SACCO HANDLER ",[$mail_to->name]);
            $subject = "VISITOR ARRIVAL: " . $official_information["Selected Purpose"];
            Log::info("SUBJECT: " . $subject);
        }
        Log::info("Visitor creaated ", [$visitor]);
        $email_sent = $this->sendEmail(
            to: $mail_to->email,
            subject: $subject,
            visitor_name: $this->personal_information["Name"],
            handler_name: $mail_to->name,
            purpose_of_visit: $official_information["Selected Purpose"],
            visitor_phone_number: $this->personal_information["Phone_Number"]
        );
        if ($email_sent) {
            Log::info("Email Sent Successfully");
            $this->save($visitor);
        } else {
            Log::error("Email Failed");
        }
    }
    function save($visitor)
    {
        $visitor = Visitor::create($visitor);
        if ($visitor) {
            Log::info("Visitor inserted into db", [$visitor]);
            return redirect()->route('visitor.thankyou')->with('status', 'Success!');
        }
    }
    function getPortfolioHandler($sacco_id)
    {
        $portfolio_id = $this->getSaccoPortfolioID($sacco_id);
        $handler = Handler::where('portfolio_id', '=', $portfolio_id)->first(['email', 'name']);
        return $handler;
    }
    function getSaccoPortfolioID($sacco_id)
    {
        $sacco = Sacco::find($sacco_id);
        return $sacco->portfolio_id;
    }
    function sendEmail($to, $subject, $visitor_name, $handler_name, $purpose_of_visit, $visitor_phone_number)
    {
        $email = new VisitorArrival(subject: $subject, visitor_name: $visitor_name, handler_name: $handler_name, purpose_of_visit: $purpose_of_visit, visitor_phone_number: $visitor_phone_number);
        return Mail::to($to)->send($email);
    }
    public function render()
    {
        return view('livewire.form')
            ->with("isNext", $this->isNext)
            ->layout('components.layouts.app', ["title" => "Registration"]);
    }
}
