<?php

namespace App\Livewire;

use App\Http\Controllers\HandlerController;
use App\Http\Controllers\SaccoController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use App\Mail\VisitorArrival;
use App\Models\Handler;
use App\Models\Sacco;
use App\Models\Saccos;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;

class Form extends Component
{
    // protected $visitorController;
    // function __construct(VisitorController $visitorController){
    //     $this->visitorController = $visitorController;
    // }
   
    public $personal_information = [
        "id"=>"",
        "Name" => "Sample",
        "ID_Number" => "Sample",
        "Phone_Number" => "Sample",
        "Email_Address" => "Sample"
    ];
    public $isNext = false;
    public $visitorExists = false;

    #[On('visitor-exists-event')]
    public function handleVisitorExistsEvent($visitor)
    {
        Log::info("VISITOR EXISTS EVENT HANDLED");
        $this->visitorExists = true;
        $this->isNext = true;
        $this->personal_information["id"] = $visitor["id"];
        $this->personal_information["Name"] = $visitor["name"];
        $this->personal_information["ID_Number"] = $visitor["ID/Passport_number"];
        $this->personal_information["Phone_Number"] = $visitor["phone_number"];
        $this->personal_information["Email_Address"] = $visitor["email"];
    }

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
        
        if(!$this->visitorExists){
            $visitor = [
                "name" => $this->personal_information["Name"],
                "phone_number" => $this->personal_information["Phone_Number"],
                "ID/Passport_number" => $this->personal_information["ID_Number"],
                "email" => $this->personal_information["Email_Address"],
            ];
            $visitor_id = $this->saveVisitorProfile($visitor);
        } else {
            $visitor_id = $this->personal_information["id"];
        }
        $timestamp = strtotime(date("F j, Y, g:i a"));
        $time_in = date('Y-m-d H:i:s', $timestamp);


        $visit = [
            "purpose_of_visit" => $official_information["Selected Purpose"],
            "visitor_id" => $visitor_id,
            "time_in" => $time_in
        ];

        if ($visit["purpose_of_visit"] == "Offical Visit" || $visit["purpose_of_visit"] == "Delivery") {
            $visit["person_to_visit"] = $official_information["Person to Visit"];
        }
        if ($visit["purpose_of_visit"] == "Make a complaint" || $visit["purpose_of_visit"] == "Accounts") {
            $visit["sacco_id"] = intval($official_information["SACCO_Name"]);
            $mail_to = $this->getPortfolioHandler($official_information["SACCO_Name"]);

            $subject = "VISITOR ARRIVAL: " . $official_information["Selected Purpose"];
        }
        Log::info("OFFICIAL INFO: ", [$visit]);
        // $email_sent = $this->sendEmail(
        //     to: $mail_to->email,
        //     subject: $subject,
        //     visitor_name: $this->personal_information["Name"],
        //     handler_name: $mail_to->name,
        //     purpose_of_visit: $official_information["Selected Purpose"],
        //     visitor_phone_number: $this->personal_information["Phone_Number"]
        // );
        // Log::info("EMAIL SENT", [$email_sent]);
        // if ($email_sent) {
        //     $this->saveVisitInformation($visit);
        //     $this->dispatch('visitor-saved-event');
        //     redirect()->route('thank-you');
        // }
        return redirect()->route('thank-you');
        // $this->dispatch('visitor-saved-event');
    }
    function saveVisitorProfile($visitor)
    {
        $controller = new VisitorController();
        $visitor = $controller->saveVisitor($visitor);
        if ($visitor) {
            Log::info("Visitor inserted into db", [$visitor]);
            return $visitor;
        }
    }
    // TODO: Check why it is not redirecting
    function saveVisitInformation($visitInfo){
        Visit::create($visitInfo);
        Log::info("Visitor created");
    }
    function getPortfolioHandler($sacco_id)
    {
        $controller = new HandlerController();
        $portfolio_id = $this->getSaccoPortfolioID($sacco_id);
        $handler = $controller->getPortfolioHandler($portfolio_id);
        return $handler;
    }
    function getSaccoPortfolioID($sacco_id)
    {
        $controller = new SaccoController();
        $sacco = $controller->getSaccoPortfolioID($sacco_id);
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
            ->with('visitor', $this->personal_information)
            ->with('visitor_exists', $this->visitorExists)
            ->layout('components.layouts.app', ["title" => "Registration"]);
    }
}
