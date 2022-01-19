<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Jobs\generateReportUsers;

use App\Http\Resources\Api\ReportResource;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $title = $request->get('title');
        $startBirthDate = $request->get('startBirthDate');
        $endBirthDate = $request->get('endBirthDate');
        generateReportUsers::dispatch($title, $startBirthDate, $endBirthDate);
        return response()->json([
            'status' => 200,
        ]);


    }

    public function getReport($report_id)
    {
        $report = Report::find($report_id);

        if($report){

            $isExistsReportFile = Storage::exists($report->report_link);

            if($isExistsReportFile) {
                $path = 'storage/reports/'.$report->report_link;
                return response()->download($path);
            }

            return 'No se encontro el archivo';

        } else {
            return 'No se encontro reporte';
        }

    }

    public function listReports()
    {
        return ReportResource::collection(
            Report::All()
        );
    }
}
