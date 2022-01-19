<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class generateReportUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $startBirthDate;
    protected $endBirthDate;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $startBirthDate, $endBirthDate)
    {
        $this->title = $title;
        $this->startBirthDate = $startBirthDate;
        $this->endBirthDate = $endBirthDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $fileUrl= $this->saveReportGeneratedOnDisk($this->startBirthDate, $this->endBirthDate);
            $this->saveReportGeneratedOnDB($fileUrl);

        } catch (\Throwable $th) {
            return 'Error, al momento de generar reporte';
        }
    }

    private function generateReportQueue($startBirthDate, $endBirthDate)
    {
        generateReportUsers::dispatch($startBirthDate, $endBirthDate);
    }

    private function saveReportGeneratedOnDisk($startBirthDate, $endBirthDate)
    {
        $fileName = 'usersreport-'.Carbon::now()->timestamp.'.xlsx';
        Excel::store(new UsersExport('1981-01-01','1985-12-31'), $fileName);
        return $fileName;//'storage/reports/'
    }

    private function saveReportGeneratedOnDB($fileName)
    {
        Report::create([
            'title' => $this->title,
            'report_link' => $fileName
        ]);
    }
}
