<?php

namespace App\Controller;

use App\Entity\Localization;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{city}', name: 'app_weather')]
    public function city(
        #[MapEntity(mapping: ['country' => 'countryCode', 'city' => 'name'])]
        Localization $localization,
        WeatherUtil $util,
    ): Response
    {
        $measurements = $util->getWeatherForLocation($localization);

        return $this->render('weather/city.html.twig', [
            'localization' => $localization,
            'measurements' => $measurements,
        ]);
    }
}
