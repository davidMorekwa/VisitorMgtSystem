<?php

namespace App\Exports;

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitorExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
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
            ->join('saccos', 'visits.sacco_id', '=', 'saccos.id', type:'left')
            ->select(['visitors.*', 'visits.purpose_of_visit', 'visits.person_to_see', 'saccos.sacco_name', 'visits.time_in', 'visits.time_out'])
            ->get();
    }
}
