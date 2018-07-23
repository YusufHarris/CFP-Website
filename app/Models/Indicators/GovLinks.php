<?php

namespace App\Models\Indicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GovLinks extends Model
{
    // Returns the full list of Government Agencies Linked with
    // CFP and the number of trainees per agency
    public static function getGovAgencies()
    {

        $sqlQuery = 'SELECT `BN_GovAgencies`.`agencyName`, `BN_GovAgencies`.`agencyAcronym`,
                            `TR_GovTrainees`.`members`
                     FROM `BN_GovAgencies`
                     JOIN (
                            SELECT COUNT(`TR_LinkToGovMembers`.`id`) as members,
                                   `BN_GovMembers`.`id_BN_GovAgencies`
                            FROM `TR_LinkToGovMembers`
                            JOIN `BN_GovMembers`
                            ON `TR_LinkToGovMembers`.`id_BN_GovMembers` = `BN_GovMembers`.`id`
                            GROUP BY `BN_GovMembers`.`id_BN_GovAgencies`
                     ) AS `TR_GovTrainees`
                     ON `BN_GovAgencies`.`id` = `TR_GovTrainees`.`id_BN_GovAgencies`
                     WHERE `BN_GovAgencies`.`sroia`=1';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        return $result;
    }

    // Returns the full list of Government Agencies Linked with
    // CFP
    public static function getGovWorkshops()
    {

        $sqlQuery = 'SELECT `TR_Trainings`.`startDate`, `TR_Trainings`.`title`
                     FROM `TR_Trainings`
                     JOIN `TR_LinkToGovMembers`
                     ON `TR_Trainings`.`id` = `TR_LinkToGovMembers`.`id_TR_Trainings`
                     GROUP BY `TR_Trainings`.`startDate`, `TR_Trainings`.`title`';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        return $result;
    }
}
