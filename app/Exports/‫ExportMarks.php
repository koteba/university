<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportUsers implements FromCollection, WithHeadings
, ShouldAutoSize, WithEvents

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
return User::select('id','name->en','name->ar','email','department_id','year','created_at')->where('user_type',5)->get();

        // return User::all()->where('user_type',5)->pluck('id');
    }
public function headings(): array
    {
        return [
            '#',
            'Name(en)',
            'Name(ar)',
            'Email',
            'department id',
            'year',
            'Created at'
        ];
    }
 public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            }
        ];
    }
}
