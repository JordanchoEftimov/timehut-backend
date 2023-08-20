<?php

namespace App\Helpers;

class NetToGross
{
    public static function netToGross($net)
    {
        // Constants
        $maxSafeInt = pow(2, 53) - 1;
        $maxGrossNetRatio = 10;
        $averageSalary = 43509;
        $personalAllowance = 9038;
        $minNet = 15229;
        $minGross = 22146;
        $maxBase = $averageSalary * 16;
        $minBase = $averageSalary / 2;

        // Function to calculate taxes based on net
        $calculateTaxes = function ($net) use ($personalAllowance) {
            $incomeTaxRate = 0.1; // Income tax rate

            return ($net - $personalAllowance) * $incomeTaxRate;
        };

        // Function to calculate contributions based on gross
        $calculateContributions = function ($gross) {
            $pension = 0.188; // Pension contribution rate
            $health = 0.075; // Health contribution rate
            $unemployment = 0.012; // Unemployment contribution rate
            $sickness = 0.005; // Sickness contribution rate

            return [
                'pension' => $gross * $pension,
                'health' => $gross * $health,
                'unemployment' => $gross * $unemployment,
                'sickness' => $gross * $sickness,
            ];
        };

        // Binary search function to find gross
        $findGross = function ($net) use (
            $maxSafeInt,
            $minGross,
            $calculateTaxes,
            $calculateContributions,
            $personalAllowance
        ) {
            $low = $minGross;
            $high = $maxSafeInt;

            while ($low <= $high) {
                $mid = $low + floor(($high - $low) / 2);
                $calculatedNet = self::grossToNet($mid, $personalAllowance, $calculateTaxes, $calculateContributions);

                if ($net < $calculatedNet) {
                    $high = $mid - 1;
                } elseif ($net > $calculatedNet) {
                    $low = $mid + 1;
                } else {
                    return $mid;
                }
            }

            return $high;
        };

        // Main logic
        $net = max($net, $minNet);
        $gross = $findGross($net);

        return $gross;
    }

    private static function grossToNet($gross, $personalAllowance, $calculateTaxes, $calculateContributions)
    {
        // Calculate taxes
        $taxableBase = $gross - $calculateContributions($gross)['pension'] - $personalAllowance;
        $taxes = $calculateTaxes($taxableBase);

        // Calculate contributions
        $contributions = array_sum($calculateContributions($gross));

        // Calculate net
        $net = $gross - $contributions - $taxes;

        return $net;
    }
}
