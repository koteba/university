<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUsers implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  collection(Collection $rows)
    {
// dd($rows);

//  $collage->name = ['en' => $request->name_en, 'ar' => $request->name];
// 
 foreach ($rows as $row) 
        {User::create([
            'name' =>['en' => $row['nameen'], 
                      'ar' => $row['namear']] ,
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'year' => $row['year'],
            'phone' => $row['phone'],
            'user_type' => 5,
            'department_id' => $row['department_id'],

        ]);}
    toastr()->success(trans('messages.success'));

return redirect(view('pages.excel.import'));
    }

public function headingRow(): int
    {
        return 3;
    }
}
