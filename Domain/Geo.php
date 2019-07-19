<?php

declare(strict_types=1);

namespace App\Services\PrimaryDivision\Domain;

use App\Entity\City;
use App\Entity\Region;

class Geo
{
    private $region;

    private $city;

    public function __construct(Region $region, City $city)
    {
        $this->region = $region;
        $this->city = $city;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getCity(): City
    {
        return $this->city;
    }
}
