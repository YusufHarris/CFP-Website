<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSVSurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql2')->create('SV_Continuous', function(Blueprint $table)
		{
			$table->text('additionalProducts08')->nullable();
			$table->text('airQuality05')->nullable();
			$table->text('airQualityBefore05')->nullable();
			$table->text('annual01')->nullable();
			$table->text('annual02A')->nullable();
			$table->text('annual02B')->nullable();
			$table->text('annual04')->nullable();
			$table->text('annual05')->nullable();
			$table->text('annual06')->nullable();
			$table->text('annual07')->nullable();
			$table->text('annual08')->nullable();
			$table->text('annual09')->nullable();
			$table->text('annual12')->nullable();
			$table->text('annualCropTypes01')->nullable();
			$table->text('annualCropTypes07')->nullable();
			$table->text('annualSeedsFromCFP01')->nullable();
			$table->text('annualSeedsFromCFP07')->nullable();
			$table->text('buildingMethod06')->nullable();
			$table->text('buildingMethodOther06')->nullable();
			$table->text('buildingMethodWhy06')->nullable();
			$table->text('buildingMethodWhyOther06')->nullable();
			$table->smallInteger('bundlesWeek05')->nullable();
			$table->smallInteger('bundlesWeekBefore05')->nullable();
			$table->text('challenge')->nullable();
			$table->text('challenges08')->nullable();
			$table->text('chargeLocation09')->nullable();
			$table->text('comments')->nullable();
			$table->text('construct06')->nullable();
			$table->text('constructChallenges06')->nullable();
			$table->text('constructWhyNot06')->nullable();
			$table->smallInteger('consumption07')->nullable();
			$table->smallInteger('consumptionBefore07')->nullable();
			$table->text('consumptionChallenges07')->nullable();
			$table->text('consumptionChange07')->nullable();
			$table->text('consumptionPrevent07')->nullable();
			$table->smallInteger('costCharcoal05')->nullable();
			$table->text('costCollecting03')->nullable();
			$table->text('costCollectingBefore03')->nullable();
			$table->dateTime('createTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('createUser')->nullable();
			$table->smallInteger('daysCharcoalLast05')->nullable();
			$table->smallInteger('daysCharcoalLastBefore05')->nullable();
			$table->text('distanceElectricity09')->nullable();
			$table->text('distanceElectricityBefore09')->nullable();
			$table->text('earthBlockQuality06')->nullable();
			$table->text('earthBlockQualityWhy06')->nullable();
			$table->text('elecCost09')->nullable();
			$table->text('elecCostBefore09')->nullable();
			$table->text('elecUse09')->nullable();
			$table->text('elecUseBefore09')->nullable();
			$table->text('elecUseBeforeOther09')->nullable();
			$table->text('elecUseOther09')->nullable();
			$table->text('fertility01')->nullable();
			$table->text('fertility12')->nullable();
			$table->text('fertilityChallenge01')->nullable();
			$table->text('fertilityChallenge12')->nullable();
			$table->text('fertilityPrevent01')->nullable();
			$table->text('fertilityPrevent12')->nullable();
			$table->text('fuelSources05')->nullable();
			$table->text('gardenLocation07')->nullable();
			$table->smallInteger('group01')->nullable();
			$table->smallInteger('group02A')->nullable();
			$table->smallInteger('group02B')->nullable();
			$table->smallInteger('group04')->nullable();
			$table->smallInteger('group05')->nullable();
			$table->smallInteger('group06')->nullable();
			$table->smallInteger('group07')->nullable();
			$table->smallInteger('group08')->nullable();
			$table->smallInteger('group09')->nullable();
			$table->smallInteger('group12')->nullable();
			$table->text('guidelinesChallenges')->nullable();
			$table->text('highestIncome')->nullable();
			$table->text('hivetypes08')->nullable();
			$table->text('hoursCollect05')->nullable();
			$table->text('hoursCollectBefore05')->nullable();
			$table->smallInteger('hoursCollecting03')->nullable();
			$table->smallInteger('hoursCollectingBefore03')->nullable();
			$table->string('id', 36)->unique('id');
			$table->string('id_LK_KeyActivitiesAwareness', 36)->nullable();
			$table->string('id_LK_KeyActivitiesAwarenessBefore', 36)->nullable();
			$table->string('id_LK_KeyActivitiesPractice', 36)->nullable();
			$table->string('id_LK_KeyActivitiesPracticeOthers', 36)->nullable();
			$table->string('id_SV_Surveys', 36)->nullable();
			$table->text('improveWaterAccess01')->nullable();
			$table->text('improveWaterAccess07')->nullable();
			$table->text('improveWaterAccess12')->nullable();
			$table->text('improveWaterAccessChallenges01')->nullable();
			$table->text('improveWaterAccessChallenges07')->nullable();
			$table->text('improveWaterAccessChallenges12')->nullable();
			$table->text('improveWaterAccessHow01')->nullable();
			$table->text('improveWaterAccessHow07')->nullable();
			$table->text('improveWaterAccessHow12')->nullable();
			$table->text('improveWaterAccessHowOther01')->nullable();
			$table->text('improveWaterAccessHowOther07')->nullable();
			$table->text('improveWaterAccessHowOther12')->nullable();
			$table->text('improveWaterAccessWhyNot01')->nullable();
			$table->text('improveWaterAccessWhyNot07')->nullable();
			$table->text('improveWaterAccessWhyNot12')->nullable();
			$table->text('improvedAccess03')->nullable();
			$table->text('improvedAccess09')->nullable();
			$table->text('improvedAccessChallenges03')->nullable();
			$table->text('improvedAccessChallenges09')->nullable();
			$table->text('improvedAccessPrevent09')->nullable();
			$table->text('improvedAccessWhyNot03')->nullable();
			$table->text('improvedSeeds01')->nullable();
			$table->text('improvedSeedsChallenges01')->nullable();
			$table->text('improvedSeedsImprovement01')->nullable();
			$table->text('improvedSeedsNoImprovement01')->nullable();
			$table->text('improvedSeedsWhyNot01')->nullable();
			$table->smallInteger('income01')->nullable();
			$table->smallInteger('income02A')->nullable();
			$table->smallInteger('income02B')->nullable();
			$table->smallInteger('income04')->nullable();
			$table->smallInteger('income05')->nullable();
			$table->smallInteger('income06')->nullable();
			$table->smallInteger('income07')->nullable();
			$table->smallInteger('income08')->nullable();
			$table->smallInteger('income09')->nullable();
			$table->smallInteger('income12')->nullable();
			$table->smallInteger('involveRating')->nullable();
			$table->smallInteger('livelihoods')->nullable();
			$table->smallInteger('livelihoodsOther')->nullable();
			$table->dateTime('modTS')->nullable()->default('0000-00-00 00:00:00');
			$table->text('noGuidelines')->nullable();
			$table->text('ovallIncomeChange')->nullable();
			$table->text('partsFailure09')->nullable();
			$table->text('partsUpgrade09')->nullable();
			$table->text('perennialCropTypes01')->nullable();
			$table->text('perennialCropTypes07')->nullable();
			$table->text('perennialSeedsFromCFP01')->nullable();
			$table->text('perennialSeedsFromCFP07')->nullable();
			$table->text('prevent')->nullable();
			$table->text('primLighting09')->nullable();
			$table->text('primLightingBefore09')->nullable();
			$table->text('primarySeedSource01')->nullable();
			$table->text('primarySeedSource07')->nullable();
			$table->text('primarySeedSource12')->nullable();
			$table->text('primarySeedSourceOther01')->nullable();
			$table->text('primarySeedSourceOther07')->nullable();
			$table->text('primarySeedSourceOther12')->nullable();
			$table->text('primaryWaterSource03')->nullable();
			$table->text('primaryWaterSourceBefore03')->nullable();
			$table->text('primaryWaterSourceBeforeOther03')->nullable();
			$table->text('primaryWaterSourceOther03')->nullable();
			$table->text('priorLandManagement01')->nullable();
			$table->text('priorLandManagement12')->nullable();
			$table->text('priorLandManagementOther01')->nullable();
			$table->text('priorLandManagementOther12')->nullable();
			$table->text('producing06')->nullable();
			$table->text('producingChallenges06')->nullable();
			$table->text('producingWhyNot06')->nullable();
			$table->text('productChallenges08')->nullable();
			$table->text('productPrevent08')->nullable();
			$table->smallInteger('profitSharingGuidelines01')->nullable();
			$table->smallInteger('profitSharingGuidelines02A')->nullable();
			$table->smallInteger('profitSharingGuidelines02B')->nullable();
			$table->smallInteger('profitSharingGuidelines04')->nullable();
			$table->smallInteger('profitSharingGuidelines05')->nullable();
			$table->smallInteger('profitSharingGuidelines06')->nullable();
			$table->smallInteger('profitSharingGuidelines07')->nullable();
			$table->smallInteger('profitSharingGuidelines08')->nullable();
			$table->smallInteger('profitSharingGuidelines09')->nullable();
			$table->smallInteger('profitSharingGuidelines12')->nullable();
			$table->text('rainwaterSystemDrySeasons03')->nullable();
			$table->text('reproducedAnnualSeedsFromCFP01')->nullable();
			$table->text('reproducedAnnualSeedsFromCFP07')->nullable();
			$table->text('reproducedPerennialSeedsFromCFP01')->nullable();
			$table->text('reproducedPerennialSeedsFromCFP07')->nullable();
			$table->text('reproducedSpiceSeedsFromCFP12')->nullable();
			$table->text('sawCookStove05')->nullable();
			$table->text('seasons07')->nullable();
			$table->text('sellPercent08')->nullable();
			$table->text('spiceSeedsFromCFP12')->nullable();
			$table->text('spices12')->nullable();
			$table->text('spicesOther12')->nullable();
			$table->smallInteger('tripsPerWeek03')->nullable();
			$table->smallInteger('tripsPerWeekBefore03')->nullable();
			$table->text('useCookStoveDaily05')->nullable();
			$table->text('useCookStoveDailyWhyNot05')->nullable();
			$table->text('useCookStoveSometimes05')->nullable();
			$table->text('useKeroCandle09')->nullable();
			$table->text('useKeroCandlewhy09')->nullable();
			$table->text('useOldStove05')->nullable();
			$table->text('useOldStoveWhy05')->nullable();
			$table->text('whyAway07')->nullable();
			$table->text('whyAwayOther07')->nullable();
			$table->text('womenDecideIncomeUse')->nullable();
			$table->text('womenDecideIncomeWhyNot')->nullable();
			$table->text('womenIncomeUse')->nullable();
			$table->text('womenIncomeUseOther')->nullable();
			$table->text('yield01')->nullable();
			$table->text('yieldChallenge01')->nullable();
			$table->text('yieldPrevent01')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('mysql2')->drop('SV_Surveys');
	}

}
