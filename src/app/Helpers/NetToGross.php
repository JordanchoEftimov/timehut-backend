<?php

namespace App\Helpers;

class NetToGross
{
    const PERSONAL_ALLOWANCE = 9038;

    const CONTRIBUTION_FOR_MANDATORY_SOCIAL_SECURITY_PERCENTAGE = 0.188;

    const CONTRIBUTION_FOR_COMPULSORY_HEALTH_INSURANCE_PERCENTAGE = 0.075;

    const UNEMPLOYMENT_INSURANCE_CONTRIBUTION_PERCENTAGE = 0.012;

    const ADDITIONAL_CONTRIBUTION_FOR_MANDATORY_INSURANCE_IN_CASE_OF_INJURY_OR_OCCUPATIONAL_DISEASE_PERCENTAGE = 0.005;

    public static function netToGross($net): float
    {
        $grossWithoutContributions = self::calculateGrossWithoutContributions($net);

        $gross = $grossWithoutContributions / 0.72;

        return round($gross);
    }

    public static function calculateGrossWithoutContributions($net): float
    {
        return round(($net - 903.8) / 0.9);
    }

    public static function calculateContributionForMandatorySocialSecurity($net): float
    {
        $gross = self::netToGross($net);

        return round($gross * self::CONTRIBUTION_FOR_MANDATORY_SOCIAL_SECURITY_PERCENTAGE);
    }

    public static function calculateContributionForCompulsoryHealthInsurance($net): float
    {
        $gross = self::netToGross($net);

        return round($gross * self::CONTRIBUTION_FOR_COMPULSORY_HEALTH_INSURANCE_PERCENTAGE);
    }

    public static function calculateUnemploymentInsuranceContribution($net): float
    {
        $gross = self::netToGross($net);

        return round($gross * self::UNEMPLOYMENT_INSURANCE_CONTRIBUTION_PERCENTAGE);
    }

    public static function calculateAdditionalContributionForMandatoryInsuranceInCaseOfInjuryOrOccupationalDisease($net): float
    {
        $gross = self::netToGross($net);

        return round($gross * self::ADDITIONAL_CONTRIBUTION_FOR_MANDATORY_INSURANCE_IN_CASE_OF_INJURY_OR_OCCUPATIONAL_DISEASE_PERCENTAGE);
    }

    public static function calculatePersonalIncomeTax($net): float
    {
        $grossWithoutContributions = self::calculateGrossWithoutContributions($net);

        return round(($grossWithoutContributions - self::PERSONAL_ALLOWANCE) * 0.1);
    }
}
