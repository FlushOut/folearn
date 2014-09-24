<?php

class Functions {

    /**
     * Copiado do Google Maps para criar o algoritimo de roterizacao
     * get distance between to geocoords using great circle distance formula
     *
     * @param float $lat1
     * @param float $lat2
     * @param float $lon1
     * @param float $lon2
     * @param float $unit   M=miles, K=kilometers, N=nautical miles, I=inches, F=feet
     * @return float
     */
    public function geoGetDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K') {

        if ($lat1 != $lat2 && $lon1 != $lon2) {

            // calculate miles
            $M = 69.09 * rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2))));

            switch (strtoupper($unit)) {
                case 'M2':
                    // Metros
                    return (($M * 1.609344)*1000);
                    break;
                case 'K':
                    // kilometers
                    return $M * 1.609344;
                    break;
                case 'N':
                    // nautical miles
                    return $M * 0.868976242;
                    break;
                case 'F':
                    // feet
                    return $M * 5280;
                    break;
                case 'I':
                    // inches
                    return $M * 63360;
                    break;
                case 'M':
                default:
                    // miles
                    return $M;
                    break;
            }
        } else {

            return 0;
        }
    }

}