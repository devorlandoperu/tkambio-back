<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements FromView
{
    protected $startBirthDate;
    protected $endBirthDate;

    public function __construct($startBirthDate, $endBirthDate) {
        $this->startBirthDate = $startBirthDate;
        $this->endBirthDate = $endBirthDate;
    }

    /**
    * @return Illuminate\Contracts\View\View
    */
    public function view(): View
    {
        $model = User::query();
        $model->whereBetween('birth_date', [$this->startBirthDate, $this->endBirthDate]);
        $users = $model->get();
        return view('api.reports.user', ["users" => $users]);
    }
}
