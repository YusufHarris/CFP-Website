<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TreeDiagram extends Model
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

    // Returns the final beneficiaries in the format required
    // by the D3 tree structure:
    // Total -> By Sex -> By Sector -> By Key Activity
    public static function getD3TreeFinalBeneficiaries($idCom = NULL)
    {
        // Set the sign to determine if the results are for all communities
        // or for a single community
        if ($idCom) { $sign = '='; } else { $sign = '<>'; }

        // Get the total final beneficiaries by Sex and total them
        $sqlQuery = 'SELECT IFNULL(`mF`, "Total") as `mF`, finalBen
                    FROM (
                        SELECT `mF`,
                        SUM(IF(beneficiaryType = "Final Beneficiaries", totalBeneficiaries, NULL)) AS finalBen
                    FROM `RE_Beneficiaries`
                    WHERE `id_BN_Communities`' . $sign . '"' . $idCom . '"
                    GROUP BY `mF` WITH ROLLUP
                ) as DT';
        $allBens = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        // Set Total Node
        $tot = new \stdClass();
        $tot->name = "Total: " . number_format($allBens[sizeof($allBens)-1]->finalBen, 0, ".", ",");
        $tot->children = array();

        // Loop through the complete final beneficiaries by Sex ignoring the last row of the sql results, i.e. the Total beneficiaries
        // And set the Females and/or Males Nodes
        for ($i=0; $i < sizeof($allBens) - 1; $i++)
        {
            // Create the beneficiary by sex node
            $tot->children[$i] = new \stdClass();
            // Set the node sex according to the result
            if ($allBens[$i]->mF == 'F') { $sex = "Females: "; } else { $sex = "Males: "; }
            // Set the name and total beneficiaries by sex. e.g. Males: 12,544
            $tot->children[$i]->name = $sex . number_format($allBens[$i]->finalBen, 0, ".", ",");

            // Get the sector beneficiaries for the current sex
            $sqlQuery = 'SELECT `sector`, SUM(IF(beneficiaryType = "Final Beneficiaries", totalBeneficiaries, NULL)) AS finalBen
                        FROM `RE_SectorBeneficiaries`
                        WHERE `mF`="' . $allBens[$i]->mF . '"
                        AND `id_BN_Communities`' . $sign . '"' . $idCom . '"
                        GROUP BY `sector`';
            $sectorBens = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

            // Initialize an incrementor to loop through the sector results
            $inc = 0;

            // Loop through the female sector beneficiaries
            foreach ($sectorBens as $sectorBen)
            {
                // Create the sector beneficiary node
                $tot->children[$i]->children[$inc] = new \stdClass();
                $tot->children[$i]->children[$inc]->name = $sectorBen->sector . ": " . number_format($sectorBen->finalBen, 0, ".", ",");
                $tot->children[$i]->children[$inc]->children = array();

                // Get the key activity beneficiaries for the current sector
                $sqlQuery = 'SELECT `keyActivity`, SUM(IF(beneficiaryType = "Final Beneficiaries", totalBeneficiaries, NULL)) AS finalBen
                            FROM `RE_KeyActivityBeneficiaries`
                            JOIN `LK_KeyActivities` ON RE_KeyActivityBeneficiaries.id_LK_KeyActivities=LK_KeyActivities.id
                            WHERE `mF`="' . $allBens[$i]->mF . '"
                            AND `sector`="' . $sectorBen->sector . '"
                            AND id_BN_Communities' . $sign . '"' . $idCom . '"
                            GROUP BY `keyActivity`';
                $kABens = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

                // Initialize an incrementor to loop through the key activity results
                $kAinc = 0;

                foreach ($kABens as $kABen)
                {
                    // Set the key activity node value
                    $tot->children[$i]->children[$inc]->children[$kAinc] = new \stdClass;
                    $tot->children[$i]->children[$inc]->children[$kAinc]->name = $kABen->keyActivity . ": " . number_format($kABen->finalBen, 0, ".", ",");
                    // increment the key activity array location
                    $kAinc += 1;
                }

                // Increment to the next sector beneficiary node
                $inc += 1;
            }
        }

        return $tot;
    }

    // Returns the final beneficiaries for each sector
    public static function getFinalBeneficiariesBySector()
    {

        $sqlQuery = 'SELECT `sector`, sum(`totalBeneficiaries`) as totalBeneficiaries
                     FROM `RE_SectorBeneficiaries`
                     JOIN `BN_Communities` ON RE_SectorBeneficiaries.id_BN_Communities=BN_Communities.id
                     GROUP BY `sector`';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));
        return $result;
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

    public static function getFinalBeneficiariesByKeyActivity($withRollup=False)
    {

        $sqlQuery = 'SELECT `keyActivity`, `community`, `mF`, sum(`totalBeneficiaries`) as totalBeneficiaries
                     FROM `RE_KeyActivityBeneficiaries`
                     JOIN `LK_KeyActivities` ON RE_KeyActivityBeneficiaries.id_LK_KeyActivities=LK_KeyActivities.id
                     JOIN `BN_Communities` ON RE_KeyActivityBeneficiaries.id_BN_Communities=BN_Communities.id
                     WHERE `beneficiaryType`="Final Beneficiaries"
                     AND `sroia`=1
                     GROUP BY `keyActivity`, `community`, `mF`';

        $result = DB::connection('mysql2')->select(DB::Raw($sqlQuery));

        if($withRollup)
        {

        }


        return $result;
    }
}
