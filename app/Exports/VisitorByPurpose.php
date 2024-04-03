<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitorByPurpose implements FromCollection, WithHeadings
{
    public $purpose;
    public function __construct($purpose = "Accounts"){
        $this->purpose = $purpose;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'ID/Passport_number',
            'name',
            'phone_number',
            'email',
            'purpose_of_visit',
            'person_to_see',
            'sacco_name',
            'time_in',
            'time_out'
        ];
    }
    public function collection()
    {
        return DB::table('visitors')
            ->join('visits', 'visits.visitor_id', '=', 'visitors.id')
            ->join('saccos', 'visits.sacco_id', '=', 'saccos.id', type: 'left')
            ->where('visits.purpose_of_visit', '=', $this->purpose)
            ->select(['visitors.*', 'visits.purpose_of_visit', 'visits.person_to_see', 'saccos.sacco_name', 'visits.time_in', 'visits.time_out'])
            ->get();
    }
}
