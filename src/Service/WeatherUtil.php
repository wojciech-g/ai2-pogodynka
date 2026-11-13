<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Localization;
use App\Entity\Measurement;
use App\Repository\LocalizationRepository;
use App\Repository\MeasurementRepository;

class WeatherUtil
{
    public function __construct(
        private readonly LocalizationRepository $localizationRepository,
        private readonly MeasurementRepository $measurementRepository,
    ) {
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForLocation(Localization $localization): array
    {
        return $this->measurementRepository->findByLocation($localization);
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $localization = $this->localizationRepository->findOneBy([
            'countryCode' => $countryCode,
            'name' => $city,
        ]);

        if (!$localization) {
            return [];
        }

        return $this->getWeatherForLocation($localization);
    }
}
