<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mainboard extends Model
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

    // Returns the final beneficiaries by sector
    public static function getBenPie()
    {

        $sqlQuery = 'SELECT `beneficiaryType`, `sector`,
                            SUM(`totalBeneficiaries`) as totalBeneficiaries,
                            SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as fTot,
                            SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as mTot
                     FROM `RE_SectorBeneficiaries`
                     GROUP BY  `beneficiaryType`, `sector`
                     ORDER BY `beneficiaryType` ASC, `sector` ASC';
        $sqlQuery2 = 'SELECT `beneficiaryType`, "Total" as `sector`,
                             SUM(`totalBeneficiaries`) As totalBeneficiaries,
                             SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as fTot,
                             SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as mTot
                     FROM `RE_Beneficiaries`
                     GROUP BY `sector`, `beneficiaryType`
                     ORDER BY `beneficiaryType` ASC, `sector` ASC';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
        return array_merge($result, $result2);
    }

    // Returns the Beneficiaries for the Bar Chart
    public static function getBenBar()
    {
          /* Final Beneficiaries by sector, region, district, and community*/
          $sqlQuery = 'SELECT `RE_SectorBeneficiaries`.`beneficiaryType`, `RE_SectorBeneficiaries`.`sector`,
                              `BN_ComDist`.`region`, `BN_ComDist`.`district`,
                              `RE_SectorBeneficiaries`.`mF`,
                              SUM(`RE_SectorBeneficiaries`.`totalBeneficiaries`) As tot
                       FROM `RE_SectorBeneficiaries`
                       JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`
                              FROM `BN_Communities`
                              JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                       ON `RE_SectorBeneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                       GROUP BY `RE_SectorBeneficiaries`.`beneficiaryType`, `RE_SectorBeneficiaries`.`sector`,
                                `BN_ComDist`.`region`, `BN_ComDist`.`district`, `RE_SectorBeneficiaries`.`mF`
                       ORDER BY `RE_SectorBeneficiaries`.`beneficiaryType` ASC,`RE_SectorBeneficiaries`.`sector` ASC,
                                `BN_ComDist`.`region` ASC, `BN_ComDist`.`district` ASC,
                                `RE_SectorBeneficiaries`.`mF` ASC';

          /* Final Beneficiaries by region, district, and community */
          $sqlQuery2 = 'SELECT `RE_Beneficiaries`.`beneficiaryType`, "Total" AS `sector`, `BN_ComDist`.`region`,
                               `BN_ComDist`.`district`, `RE_Beneficiaries`.`mF`,
                               SUM(`RE_Beneficiaries`.`totalBeneficiaries`) As tot
                       FROM `RE_Beneficiaries`
                       JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`
                             FROM `BN_Communities`
                             JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                       ON `RE_Beneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                       GROUP BY `RE_Beneficiaries`.`beneficiaryType`, `sector`, `BN_ComDist`.`district`,
                                `RE_Beneficiaries`.`mF`
                       ORDER BY `RE_Beneficiaries`.`beneficiaryType` ASC, `BN_ComDist`.`region` ASC,
                                `BN_ComDist`.`district` ASC, `RE_Beneficiaries`.`mF` ASC';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));

        // Return the final beneficiaries and final beneficiaries by sector
        return array_merge($result, $result2);
    }

    public static function getFinalBeneficiariesBySex()
    {
        $sqlQuery = 'SELECT IFNULL(`mF`, "Total") as `mF`, DirTrain, IndTrain, FinalBen
                    FROM (
                        SELECT `mF`,
                        SUM(IF(beneficiaryType = "Direct Trainees", totalBeneficiaries, NULL)) AS DirTrain,
                        SUM(IF(beneficiaryType = "Indirect Trainees", totalBeneficiaries, NULL)) AS IndTrain,
                        SUM(IF(beneficiaryType = "Final Beneficiaries", totalBeneficiaries, NULL)) AS FinalBen
                    FROM `RE_Beneficiaries`
                    GROUP BY `mF` WITH ROLLUP
                ) as DT';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }


    // Returns the final beneficiary communities for SROIA project
    public static function getCommunities()
    {
        $sqlQuery = 'SELECT `BN_Districts`.`district`,
                            `BN_Communities`.`community`
                    FROM `BN_Communities`
                    JOIN `BN_Districts`
                    ON `BN_Communities`.`id_BN_Districts`=`BN_Districts`.`id`
                    WHERE `BN_Communities`.`sroia`=1';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }

    // Returns the final beneficiary communities for SROIA project
    public static function getIncomeChange()
    {
        $sqlQuery = 'SELECT SUM(IF(`ovallIncomeChange`="Improved", 1, 0)) as improved,
                            SUM(IF(`ovallIncomeChange`="Declined", 1, 0)) as declined,
                            SUM(IF(`ovallIncomeChange`="Stayed the same", 1, 0)) as noChange
                     FROM `SV_Continuous`';
    }

    //returns activities
    public static function getActivities()
    {
        $sqlQuery = 'SELECT `sector`,`keyActivity` as activity
                    FROM `LK_KeyActivities`';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }

    // Returns the final beneficiaries by key activity
    public static function getFinalBeneficiariesByKeyActivity()
    {

        $sqlQuery = 'SELECT `sector`, `keyActivity`, sum(`totalBeneficiaries`) as totalBeneficiaries
                     FROM `RE_KeyActivityBeneficiaries`
                     JOIN `LK_KeyActivities` ON RE_KeyActivityBeneficiaries.id_LK_KeyActivities=LK_KeyActivities.id
                     JOIN `BN_Communities` ON RE_KeyActivityBeneficiaries.id_BN_Communities=BN_Communities.id
                     WHERE `beneficiaryType`="Final Beneficiaries"
                     AND `sroia`=1
                     GROUP BY `sector`, `keyActivity`';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }
}
