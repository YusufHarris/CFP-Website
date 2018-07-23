<?php

namespace App\Models\Indicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agriculture extends Model
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
                      WHERE `RE_KeyActivityBeneficiaries`.`sector` = "Agriculture"
                      GROUP BY  `beneficiaryType`, `shortenedName`, `keyActivity`
                      ORDER BY `beneficiaryType` ASC, `keyActivity` ASC';
         $sqlQuery2 = 'SELECT `beneficiaryType`, "Total" as `shortenedName`,
                              "Total" as `keyActivity`,
                              SUM(`totalBeneficiaries`) As totalBeneficiaries,
                              SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as fTot,
                              SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as mTot
                      FROM `RE_SectorBeneficiaries`
                      WHERE `sector` = "Agriculture"
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
                     WHERE `RE_KeyActivityBeneficiaries`.`sector` = "Agriculture"
                     GROUP BY `RE_KeyActivityBeneficiaries`.`beneficiaryType`, `LK_KeyActivities`.`keyActivity`,
                              `LK_KeyActivities`.`shortenedName`,
                              `BN_ComDist`.`region`, `BN_ComDist`.`district`, `RE_KeyActivityBeneficiaries`.`mF`
                     ORDER BY `RE_KeyActivityBeneficiaries`.`beneficiaryType` ASC,`LK_KeyActivities`.`keyActivity` ASC,
                              `BN_ComDist`.`region` ASC, `BN_ComDist`.`district` ASC,
                              `RE_KeyActivityBeneficiaries`.`mF` ASC';

        /* Final Beneficiaries by region, and district */
        $sqlQuery2 = 'SELECT `RE_SectorBeneficiaries`.`beneficiaryType`, "Agriculture" AS `keyActivity`,
                             "Agriculture" AS `shortenedName`, `BN_ComDist`.`region`,
                             `BN_ComDist`.`district`, `RE_SectorBeneficiaries`.`mF`,
                             SUM(`RE_SectorBeneficiaries`.`totalBeneficiaries`) As tot
                     FROM `RE_SectorBeneficiaries`
                     JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`
                           FROM `BN_Communities`
                           JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                     ON `RE_SectorBeneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                     WHERE `RE_SectorBeneficiaries`.`sector` = "Agriculture"
                     GROUP BY `RE_SectorBeneficiaries`.`beneficiaryType`, `sector`, `BN_ComDist`.`district`,
                              `RE_SectorBeneficiaries`.`mF`
                     ORDER BY `RE_SectorBeneficiaries`.`beneficiaryType` ASC, `BN_ComDist`.`region` ASC,
                              `BN_ComDist`.`district` ASC, `RE_SectorBeneficiaries`.`mF` ASC';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));

        // Return the final beneficiaries
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

    // Returns the agriculture yield changes
    public static function getAgYieldChgs()
    {

        $sqlQuery = 'SELECT `yield01`, COUNT(`id`) as beneficiaries
                     FROM `SV_Continuous`
                     WHERE `yield01`<>"Null"
                     GROUP BY `yield01`';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }

    /*Returns the difference in KeyAts known before and known now*/
    public static function getIncreasedVegetables()
    {
        $sqlQuery =  'SELECT "Stayed the Same" AS category, SUM(IF((`consumption07` < `consumptionBefore07`)
                                                          ,1,0)) AS amount
                     FROM `SV_Continuous`
                    ';
        $sqlQuery2 =  'SELECT "Increased" AS category, SUM(IF(( `consumption07` > `consumptionBefore07`)
                                                          ,1,0)) AS amount
                     FROM `SV_Continuous`
                    ';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
        return array_merge($result, $result2);
    }

    // Returns the number of renewabe energy systems by district
    public static function getKitchenGardens()
    {
         $sqlQuery = 'SELECT (ROUND(SUM(IF(`beneficiaryType`="Final Beneficiaries", `totalBeneficiaries`/5.2, 0)) )) AS totalKitchens, `district`
                      FROM `RE_KeyActivityBeneficiaries`


                      JOIN `BN_Communities`
                          ON `RE_KeyActivityBeneficiaries`.id_BN_Communities = `BN_Communities`.id
                      JOIN `BN_Districts`
                          ON `BN_Communities`.id_BN_Districts = `BN_Districts`.id
                      JOIN `LK_KeyActivities`
                        ON `RE_KeyActivityBeneficiaries`.id_LK_KeyActivities = `LK_KeyActivities`.id
                        WHERE (keyActivity LIKE "07%")

                      GROUP BY `district`';


        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }

    // Returns the number of renewabe energy systems by district
    public static function getBeeHives()
    {
         $sqlQuery = 'SELECT COUNT(IF(`hiveType`="Langstroth" || `hiveType`="Top Bar", 1, 0)) as totalHives, `district`
                      FROM `OP_08Beehives`

                      JOIN `OP_08BeekeepingCooperatives`
                          ON `OP_08Beehives`.`id_OP_08BeekeepingCooperatives` = `OP_08BeekeepingCooperatives`.`id`
                      JOIN `OP_00Outputs`
                          ON `OP_08BeekeepingCooperatives`.`id_OP_00Outputs` = `OP_00Outputs`.id
                      JOIN `BN_Communities`
                          ON `OP_00Outputs`.id_BN_Communities = `BN_Communities`.id
                      JOIN `BN_Districts`
                          ON `BN_Communities`.id_BN_Districts = `BN_Districts`.id

                      GROUP BY `district`';


        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }

    // Returns the total area of Agroforests by district
    public static function getAgroArea()
    {
         $sqlQuery = 'SELECT ROUND(SUM(IFNULL(`areaMetersSquared`,0)) / 10000,1) as totalArea, `district`
                      FROM `OP_00Outputs`

                      JOIN `BN_Communities`
                          ON `OP_00Outputs`.id_BN_Communities = `BN_Communities`.id
                      JOIN `BN_Districts`
                          ON `BN_Communities`.id_BN_Districts = `BN_Districts`.id
                      JOIN `LK_KeyActivities`
                          ON `OP_00Outputs`.id_LK_KeyActivities = `LK_KeyActivities`.id
                          WHERE (keyActivity LIKE "01%")

                      GROUP BY `district`';


        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }

    // Returns the total area of Agroforests by district
    public static function getSpiceArea()
    {
         $sqlQuery = 'SELECT ROUND(SUM(IFNULL(`areaMetersSquared`,0)) / 10000,1) as totalArea, `district`
                      FROM `OP_00Outputs`

                      JOIN `BN_Communities`
                          ON `OP_00Outputs`.id_BN_Communities = `BN_Communities`.id
                      JOIN `BN_Districts`
                          ON `BN_Communities`.id_BN_Districts = `BN_Districts`.id
                      JOIN `LK_KeyActivities`
                          ON `OP_00Outputs`.id_LK_KeyActivities = `LK_KeyActivities`.id
                          WHERE (keyActivity LIKE "12%")

                      GROUP BY `district`';


        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
    }
}
