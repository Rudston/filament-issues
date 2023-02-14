<?php

namespace App\Utilities;

use App\Models\StudentApplications;
use App\Models\Thinkspace_Vle\ThinkspaceVle;
use Illuminate\Support\Carbon;

class ApplicationsUtilities
{
    public static function getIntakeData(): array
    {
        // want 'intake_months' = ['Jan' => [app ids], 'May' => [app ids], 'Sep' => [app ids]
        // 'intake_years' => [2015 => [app ids], ....., 2024 => [app ids]]
        $intakeDataArray = [
            'intake_months' => ['Jan' => [], 'May' => [], 'Sep' => []],
            'intake_years' => []
        ];
        $intakeMonthsArray = [1 => "Jan", 5 => "May", 9 => "Sep"];
        $currentYearPlus2 = (int)Carbon::now()->format('Y') + 2;
        $startYear = 2015;
        for ($year = $startYear; $year <= $currentYearPlus2; $year++) {
            $intakeDataArray['intake_years'][$year] = [];
        }
        $allCompletedApplications = StudentApplications::where('form_part', '=', 99)->get();
        foreach ($allCompletedApplications as $application) {
            $applicationId = $application->id;
            $applicationIntakeMonth = substr($application->month_of_entry, 0, 3);
            $applicationIntakeYear = $application->academic_year_of_entry;
            $intakeData = ThinkspaceVle::getIntakeFromUcl($application->user_course_lookup_id);
            if ($intakeData) {
                $intakeMonthInt = (int)$intakeData->intake_month;
                $intakeYear = (int)$intakeData->intake_year;
                $intakeDataArray['intake_months'][$intakeMonthsArray[$intakeMonthInt]][] = $applicationId;
                $intakeDataArray['intake_years'][$intakeYear][] = $applicationId;
            } else {
                $intakeDataArray['intake_months'][$applicationIntakeMonth][] = $applicationId;
                $intakeDataArray['intake_years'][$applicationIntakeYear][] = $applicationId;
            }
        }
        return $intakeDataArray;
    }
}
