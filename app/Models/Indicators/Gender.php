<?php

namespace App\Models\Indicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gender extends Model
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

        $sqlQuery = 'SELECT `beneficiaryType`, "Female" as category, SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as amount
                     FROM `RE_SectorBeneficiaries`
                     GROUP BY  `beneficiaryType`
                     ';

        $sqlQuery2 = 'SELECT `beneficiaryType`, "Male" as category,SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as amount
                     FROM `RE_Beneficiaries`
                     GROUP BY  `beneficiaryType`
                     ';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
        return array_merge($result, $result2);
    }

    // Returns the Beneficiaries for the Bar Chart
    public static function getBenBar()
    {
        /* Final Beneficiaries by sector, region, district, and community*/
        $sqlQuery = 'SELECT `RE_SectorBeneficiaries`.`beneficiaryType`, `RE_SectorBeneficiaries`.`sector`,
                            `BN_ComDist`.`region`, `BN_ComDist`.`district`, `BN_ComDist`.`community`,
                            `RE_SectorBeneficiaries`.`mF`,
                            SUM(`RE_SectorBeneficiaries`.`totalBeneficiaries`) As tot
                     FROM `RE_SectorBeneficiaries`
                     JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`,
                                  `BN_Communities`.`community`
                            FROM `BN_Communities`
                            JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                     ON `RE_SectorBeneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                     GROUP BY `RE_SectorBeneficiaries`.`beneficiaryType`, `RE_SectorBeneficiaries`.`sector`,
                              `BN_ComDist`.`region`, `BN_ComDist`.`district`,
                              `BN_ComDist`.`community`, `RE_SectorBeneficiaries`.`mF`
                     ORDER BY `RE_SectorBeneficiaries`.`beneficiaryType` ASC,`RE_SectorBeneficiaries`.`sector` ASC,
                              `BN_ComDist`.`region` ASC, `BN_ComDist`.`district` ASC, `BN_ComDist`.`community` ASC,
                              `RE_SectorBeneficiaries`.`mF` ASC';

        /* Final Beneficiaries by region, district, and community */
        $sqlQuery2 = 'SELECT `RE_Beneficiaries`.`beneficiaryType`, "Total" AS `sector`, `BN_ComDist`.`region`,
                             `BN_ComDist`.`district`, `BN_ComDist`.`community`, `RE_Beneficiaries`.`mF`,
                             SUM(`RE_Beneficiaries`.`totalBeneficiaries`) As tot
                     FROM `RE_Beneficiaries`
                     JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`,
                                  `BN_Communities`.`community`
                           FROM `BN_Communities`
                           JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                     ON `RE_Beneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                     GROUP BY `RE_Beneficiaries`.`beneficiaryType`, `sector`, `BN_ComDist`.`district`,
                              `BN_ComDist`.`community`, `RE_Beneficiaries`.`mF`
                     ORDER BY `RE_Beneficiaries`.`beneficiaryType` ASC, `BN_ComDist`.`region` ASC,
                              `BN_ComDist`.`district` ASC, `BN_ComDist`.`community` ASC,
                              `RE_Beneficiaries`.`mF` ASC';

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

    public static function getGenders()
    {
        $sqlQuery = 'SELECT SUM(femMembers) as amount, "Women" as category
                      FROM `OP_00Outputs` AS `OP`
                      JOIN
                        (SELECT SUM(IF(mF = "F",1,0)) AS femMembers, COUNT(`BN_ComMembers`.id) AS members, `id_OP_00Outputs`
                           FROM `OP_00LinkToComMembers`
                           JOIN BN_ComMembers
                            ON `OP_00LinkToComMembers`.`id_BN_ComMembers` = `BN_ComMembers`.`id`
                           GROUP BY `id_OP_00Outputs`) AS `CG`
                        ON OP.id = CG.id_OP_00Outputs
                      JOIN `LK_KeyActivities` AS `KA`
                        ON OP.id_LK_KeyActivities = KA.id
                        WHERE (KA.keyActivity NOT LIKE "03%" AND
                        KA.keyActivity NOT LIKE "09%" AND
                        (CG.members) > 7)
                      ';

        $sqlQuery2 = 'SELECT SUM(malMembers) as amount, "Men" as category
                      FROM `OP_00Outputs` AS `OP`
                      JOIN
                        (SELECT SUM(IF(mF = "F",1,0)) AS femMembers, SUM(IF(mF = "M",1,0)) AS malMembers, `id_OP_00Outputs`
                           FROM `OP_00LinkToComMembers`
                           JOIN BN_ComMembers
                            ON `OP_00LinkToComMembers`.`id_BN_ComMembers` = `BN_ComMembers`.`id`
                           GROUP BY `id_OP_00Outputs`) AS `CG`
                        ON OP.id = CG.id_OP_00Outputs
                      JOIN `LK_KeyActivities` AS `KA`
                        ON OP.id_LK_KeyActivities = KA.id
                        WHERE (KA.keyActivity NOT LIKE "03%" AND
                        KA.keyActivity NOT LIKE "09%" AND
                        (CG.femMembers + CG.malMembers) > 7)';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
        return array_merge($result,$result2);
    }

    /*Returns the difference in firewood before and now*/
    public static function getIncomeControl()
    {
        $sqlQuery =  'SELECT "Yes, completely" AS category, SUM(IF(womenDecideIncomeUse = "Yes, completely",1,0)) AS amount
                     FROM `SV_Continuous`';
       $sqlQuery2 =  'SELECT "No, not at all" AS category, SUM(IF(womenDecideIncomeUse = "No, not at all",1,0)) AS amount
                    FROM `SV_Continuous`';
        $sqlQuery3 =  'SELECT "Yes, but consults with husband" AS category, SUM(IF(womenDecideIncomeUse = "Yes, but consult with husband",1,0)) AS amount
                     FROM `SV_Continuous`';


       $sqlQuery4 =  'SELECT "No, but husband consults with them" AS category, SUM(IF(womenDecideIncomeUse = "No, but husband consults with you",1,0)) AS amount
                    FROM `SV_Continuous`';




        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
        $result3 = DB::connection('mysql2')->select(DB::Raw($sqlQuery3));
        $result4 = DB::connection('mysql2')->select(DB::Raw($sqlQuery4));
        return array_merge($result,$result2,$result3,$result4);
    }
}
