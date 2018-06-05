<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Forestry extends Model
{
    // Returns the full list of SROIA communities including the id,
    // community name, and GPS location
    public static function getSROIACommunities()
    {

        $sqlQuery = 'SELECT `id`, `community`, `latitude`, `longitude`
                     FROM `BN_Communities`
                     WHERE `sroia`=1';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        return $result;
    }

    // Returns the final beneficiaries by agricultural key activity
    public static function getBenPie()
    {
         $sqlQuery = 'SELECT `RE_KeyActivityBeneficiaries`.`beneficiaryType`,
                             `LK_KeyActivities`.`shortenedName`,
                             `LK_KeyActivities`.`keyActivity`,
                             SUM(`totalBeneficiaries`) as totalBeneficiaries,
                             SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as fTot,
                             SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as mTot
                      FROM `RE_KeyActivityBeneficiaries`
                      JOIN `LK_KeyActivities`
                      ON `RE_KeyActivityBeneficiaries`.`id_LK_KeyActivities` = `LK_KeyActivities`.`id`
                      WHERE `RE_KeyActivityBeneficiaries`.`sector` = "Forestry"
                      GROUP BY  `beneficiaryType`, `shortenedName`, `keyActivity`
                      ORDER BY `beneficiaryType` ASC, `keyActivity` ASC';
         $sqlQuery2 = 'SELECT `beneficiaryType`, "Total" as `shortenedName`,
                              "Total" as `keyActivity`,
                              SUM(`totalBeneficiaries`) As totalBeneficiaries,
                              SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as fTot,
                              SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as mTot
                      FROM `RE_SectorBeneficiaries`
                      WHERE `sector` = "Forestry"
                      GROUP BY `beneficiaryType`, `shortenedName`, `keyActivity`
                      ORDER BY `beneficiaryType` ASC, `keyActivity` ASC';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
        return array_merge($result, $result2);
    }

    // Returns the Beneficiaries for the Bar Chart
    public static function getBenBar()
    {
        /* Final Beneficiaries by sector, region, and district */
        $sqlQuery = 'SELECT `RE_KeyActivityBeneficiaries`.`beneficiaryType`,
                            `LK_KeyActivities`.`keyActivity`,
                            `LK_KeyActivities`.`shortenedName`,
                            `BN_ComDist`.`region`, `BN_ComDist`.`district`,
                            `RE_KeyActivityBeneficiaries`.`mF`,
                            SUM(`RE_KeyActivityBeneficiaries`.`totalBeneficiaries`) As tot
                     FROM `RE_KeyActivityBeneficiaries`
                     JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`
                            FROM `BN_Communities`
                            JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                     ON `RE_KeyActivityBeneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                     JOIN `LK_KeyActivities`
                     ON `RE_KeyActivityBeneficiaries`.`id_LK_KeyActivities` = `LK_KeyActivities`.`id`
                     WHERE `RE_KeyActivityBeneficiaries`.`sector` = "Forestry"
                     GROUP BY `RE_KeyActivityBeneficiaries`.`beneficiaryType`, `LK_KeyActivities`.`keyActivity`,
                              `LK_KeyActivities`.`shortenedName`,
                              `BN_ComDist`.`region`, `BN_ComDist`.`district`, `RE_KeyActivityBeneficiaries`.`mF`
                     ORDER BY `RE_KeyActivityBeneficiaries`.`beneficiaryType` ASC,`LK_KeyActivities`.`keyActivity` ASC,
                              `BN_ComDist`.`region` ASC, `BN_ComDist`.`district` ASC,
                              `RE_KeyActivityBeneficiaries`.`mF` ASC';

        /* Final Beneficiaries by region, and district */
        $sqlQuery2 = 'SELECT `RE_SectorBeneficiaries`.`beneficiaryType`, "Forestry" AS `keyActivity`,
                             "Forestry" AS `shortenedName`, `BN_ComDist`.`region`,
                             `BN_ComDist`.`district`, `RE_SectorBeneficiaries`.`mF`,
                             SUM(`RE_SectorBeneficiaries`.`totalBeneficiaries`) As tot
                     FROM `RE_SectorBeneficiaries`
                     JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`
                           FROM `BN_Communities`
                           JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                     ON `RE_SectorBeneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                     WHERE `RE_SectorBeneficiaries`.`sector` = "Forestry"
                     GROUP BY `RE_SectorBeneficiaries`.`beneficiaryType`, `sector`, `BN_ComDist`.`district`,
                              `RE_SectorBeneficiaries`.`mF`
                     ORDER BY `RE_SectorBeneficiaries`.`beneficiaryType` ASC, `BN_ComDist`.`region` ASC,
                              `BN_ComDist`.`district` ASC, `RE_SectorBeneficiaries`.`mF` ASC';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));

        // Return the final beneficiaries
        return array_merge($result, $result2);
    }
}
