<?php

namespace App\Models\Indicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Water extends Model
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
                      WHERE `RE_KeyActivityBeneficiaries`.`sector` = "Water"
                      GROUP BY  `beneficiaryType`, `shortenedName`, `keyActivity`
                      ORDER BY `beneficiaryType` ASC, `keyActivity` ASC';
         $sqlQuery2 = 'SELECT `beneficiaryType`, "Total" as `shortenedName`,
                              "Total" as `keyActivity`,
                              SUM(`totalBeneficiaries`) As totalBeneficiaries,
                              SUM(IF(`mF`="F", `totalBeneficiaries`, 0)) as fTot,
                              SUM(IF(`mF`="M", `totalBeneficiaries`, 0)) as mTot
                      FROM `RE_SectorBeneficiaries`
                      WHERE `sector` = "Water"
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
                     WHERE `RE_KeyActivityBeneficiaries`.`sector` = "Water"
                     GROUP BY `RE_KeyActivityBeneficiaries`.`beneficiaryType`, `LK_KeyActivities`.`keyActivity`,
                              `LK_KeyActivities`.`shortenedName`,
                              `BN_ComDist`.`region`, `BN_ComDist`.`district`, `RE_KeyActivityBeneficiaries`.`mF`
                     ORDER BY `RE_KeyActivityBeneficiaries`.`beneficiaryType` ASC,`LK_KeyActivities`.`keyActivity` ASC,
                              `BN_ComDist`.`region` ASC, `BN_ComDist`.`district` ASC,
                              `RE_KeyActivityBeneficiaries`.`mF` ASC';

        /* Final Beneficiaries by region, and district */
        $sqlQuery2 = 'SELECT `RE_SectorBeneficiaries`.`beneficiaryType`, "Water" AS `keyActivity`,
                             "Water" AS `shortenedName`, `BN_ComDist`.`region`,
                             `BN_ComDist`.`district`, `RE_SectorBeneficiaries`.`mF`,
                             SUM(`RE_SectorBeneficiaries`.`totalBeneficiaries`) As tot
                     FROM `RE_SectorBeneficiaries`
                     JOIN (SELECT `BN_Communities`.`id`, `BN_Districts`.`district`, `BN_Districts`.`region`
                           FROM `BN_Communities`
                           JOIN `BN_Districts` ON BN_Communities.id_BN_Districts=BN_Districts.id) AS `BN_ComDist`
                     ON `RE_SectorBeneficiaries`.`id_BN_Communities`=`BN_ComDist`.`id`
                     WHERE `RE_SectorBeneficiaries`.`sector` = "Water"
                     GROUP BY `RE_SectorBeneficiaries`.`beneficiaryType`, `sector`, `BN_ComDist`.`district`,
                              `RE_SectorBeneficiaries`.`mF`
                     ORDER BY `RE_SectorBeneficiaries`.`beneficiaryType` ASC, `BN_ComDist`.`region` ASC,
                              `BN_ComDist`.`district` ASC, `RE_SectorBeneficiaries`.`mF` ASC';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));

        // Return the final beneficiaries
        return array_merge($result, $result2);
    }

    // Returns the total number of beneficiary households with access to clean drinking water
    public static function getWaterHH()
    {
         $sqlQuery = 'SELECT "Achieved" as status, ROUND(SUM(`totalBeneficiaries`) / 5.2,0) as totalHH,
                             ROUND(100 * (SUM(`totalBeneficiaries`) / 5.2)/400,0) as pct
                      FROM `RE_KeyActivityBeneficiaries`
                      JOIN `LK_KeyActivities`
                      ON `RE_KeyActivityBeneficiaries`.`id_LK_KeyActivities` = `LK_KeyActivities`.`id`
                      WHERE `LK_KeyActivities`.`keyActivity` LIKE "03%" AND
                            `RE_KeyActivityBeneficiaries`.`beneficiaryType` = "Final Beneficiaries"';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));


        // Grab the unachieved households if it hasn't hit the 400 household target
        if ($result[0]->totalHH < 400) {
            $sqlQuery2 = 'SELECT "Unachieved" as status, 400 - ROUND(SUM(`totalBeneficiaries`) / 5.2,0) as totalHH,
                                 ROUND(100 * (400 - SUM(`totalBeneficiaries`) / 5.2)/400,0) as pct
                         FROM `RE_KeyActivityBeneficiaries`
                         JOIN `LK_KeyActivities`
                         ON `RE_KeyActivityBeneficiaries`.`id_LK_KeyActivities` = `LK_KeyActivities`.`id`
                         WHERE `LK_KeyActivities`.`keyActivity` LIKE "03%" AND
                               `RE_KeyActivityBeneficiaries`.`beneficiaryType` = "Final Beneficiaries"';

            $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
            $result = array_merge($result, $result2);
        }
        return $result;
        #return array_merge($result, $result2);
    }

    // Returns the total number of beneficiary households with access to clean drinking water
    public static function getWaterSystems()
    {
         $sqlQuery = 'SELECT "Achieved" as status, COUNT(id) as totalSystems,
                             ROUND(100 * COUNT(id)/6,0) as pct
                      FROM `OP_03RainwaterHarvestingSystems`';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));


        // Grab the unachieved households if it hasn't hit the 400 household target
        if ($result[0]->totalSystems < 6) {
            $sqlQuery2 = 'SELECT "Unachieved" as status, 6 - COUNT(id) as totalSystems,
                                ROUND(100 * (6 - COUNT(id))/6,0) as pct
                         FROM `OP_03RainwaterHarvestingSystems`';

            $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
            $result = array_merge($result, $result2);
        }
        return $result;
        #return array_merge($result, $result2);
    }

    // Returns the total number of beneficiary households with access to clean drinking water
    public static function getWaterCapacity()
    {
         $sqlQuery = 'SELECT "Achieved" as status, SUM(reservoirCapacity) as totalCapacity,
                             ROUND(100 * SUM(reservoirCapacity)/400000,0) as pct
                      FROM `OP_03Reservoirs`';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));


        // Grab the unachieved households if it hasn't hit the 400 household target
        if ($result[0]->totalCapacity < 400000) {
            $sqlQuery2 = 'SELECT "Unachieved" as status, 6 - SUM(reservoirCapacity) as totalCapacity,
                                ROUND(100 * (400000 - SUM(reservoirCapacity))/400000,0) as pct
                         FROM `OP_03Reservoirs`';

            $result2 = DB::connection('mysql2')->select(DB::Raw($sqlQuery2));
            $result = array_merge($result, $result2);
        }
        return $result;
        #return array_merge($result, $result2);
    }

    // Returns the total number of beneficiary households with improved access to water for agriculture
    public static function getWaterAgriculture()
    {
        // Get Agroforestry Beneficiaries
        $sqlQuery = 'SELECT KA.keyActivity, KA.shortenedName, SUM(IF(`SV`.`improveWaterAccess01` = "Yes", 1, 0)) as totalHH
                      FROM `SV_Continuous` AS SV,
                            (SELECT keyActivity, shortenedName
                            FROM LK_KeyActivities
                            WHERE keyActivity LIKE "01%") AS KA
                      GROUP BY keyActivity';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        // Get Kitchen Garden Beneficiaries
        $sqlQuery = 'SELECT KA.keyActivity, KA.shortenedName, SUM(IF(`SV`.`improveWaterAccess07` = "Yes", 1, 0)) as totalHH
                      FROM `SV_Continuous` AS SV,
                            (SELECT keyActivity, shortenedName
                            FROM LK_KeyActivities
                            WHERE keyActivity LIKE "07%") AS KA
                      GROUP BY keyActivity';
        $result = array_merge($result, DB::connection('mysql2')->select(DB::Raw($sqlQuery)));

        // Get Spice Forestry beneficiaries
        $sqlQuery = 'SELECT KA.keyActivity, KA.shortenedName, SUM(IF(`SV`.`improveWaterAccess12` = "Yes", 1, 0)) as totalHH
                      FROM `SV_Continuous` AS SV,
                            (SELECT keyActivity, shortenedName
                            FROM LK_KeyActivities
                            WHERE keyActivity LIKE "12%") AS KA
                      GROUP BY keyActivity';
        $result = array_merge($result, DB::connection('mysql2')->select(DB::Raw($sqlQuery)));
        return $result;
    }

    // Returns the total area with improved catchment conservation
    public static function getCatchConsArea()
    {
        // Get Agroforestry Beneficiaries
        $sqlQuery = 'SELECT KA.keyActivity, KA.shortenedName, ROUND(SUM(OP_00Outputs.areaMetersSquared)/10000,1) AS hectares
                     FROM (SELECT DISTINCT `OP_Link`.`id_OP_00Outputs`
                                /*Get the community members that indicate their access to water increased*/
                         FROM (SELECT `SV`.`id_BN_ComMember`
                                FROM `SV_Continuous` AS `SC`
                                JOIN `SV_Surveys` AS `SV`
                                ON `SC`.`id_SV_Surveys` = `SV`.`id`
                                WHERE `SC`.`improveWaterAccess01` = "Yes") AS BN
                        JOIN `OP_00LinkToComMembers` as OP_Link
                        ON `BN`.`id_BN_ComMember` = `OP_Link`.`id_BN_ComMembers`) AS OP
                    JOIN `OP_00Outputs`
                    ON `OP`.`id_OP_00Outputs` = `OP_00Outputs`.`id`
                    JOIN `LK_KeyActivities` AS KA
                    ON `OP_00Outputs`.`id_LK_KeyActivities` = `KA`.`id`
                    WHERE KA.keyActivity LIKE "01%"
                    GROUP BY KA.keyActivity, KA.shortenedName';
        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        // Get Kitchen Garden Beneficiaries
        $sqlQuery = 'SELECT KA.keyActivity, KA.shortenedName, ROUND(SUM(OP_00Outputs.areaMetersSquared)/10000,1) AS hectares
                     FROM (SELECT DISTINCT `OP_Link`.`id_OP_00Outputs`
                                /*Get the community members that indicate their access to water increased*/
                         FROM (SELECT `SV`.`id_BN_ComMember`
                                FROM `SV_Continuous` AS `SC`
                                JOIN `SV_Surveys` AS `SV`
                                ON `SC`.`id_SV_Surveys` = `SV`.`id`
                                WHERE `SC`.`improveWaterAccess12` = "Yes") AS BN
                        JOIN `OP_00LinkToComMembers` as OP_Link
                        ON `BN`.`id_BN_ComMember` = `OP_Link`.`id_BN_ComMembers`) AS OP
                    JOIN `OP_00Outputs`
                    ON `OP`.`id_OP_00Outputs` = `OP_00Outputs`.`id`
                    JOIN `LK_KeyActivities` AS KA
                    ON `OP_00Outputs`.`id_LK_KeyActivities` = `KA`.`id`
                    WHERE KA.keyActivity LIKE "12%"
                    GROUP BY KA.keyActivity, KA.shortenedName';
        $result = array_merge($result, DB::connection('mysql2')->select(DB::Raw($sqlQuery)));
        return $result;
    }

}
