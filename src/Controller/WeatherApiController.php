<?php

namespace App\Controller;

use App\Entity\Measurement;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherApiController extends AbstractController
{
    #[Route('/api/v1/weather', name: 'app_weather_api', methods: ['GET'])]
    public function index(
        WeatherUtil $util,
        #[MapQueryParameter('country')] string $country,
        #[MapQueryParameter('city')] string $city,
        #[MapQueryParameter('format')] string $format = 'json',
        #[MapQueryParameter('twig')] bool $twig = false,
    ): Response
    {
        if (!in_array($format, ['json', 'csv'], true)) {
            throw new BadRequestHttpException('Allowed formats: json, csv');
        }

        $measurements = $util->getWeatherForCountryAndCity($country, $city);

        if ($twig) {
            $response = $this->render('weather_api/index.' . $format . '.twig', [
                'city' => $city,
                'country' => $country,
                'measurements' => $measurements,
            ]);
            $response->headers->set('Content-Type', $format === 'csv' ? 'text/plain' : 'application/json');

            return $response;
        }

        if ($format === 'csv') {
            $lines = ['city,country,date,celsius,fahrenheit'];
            foreach ($measurements as $m) {
                $lines[] = implode(',', [
                    $city,
                    $country,
                    $m->getMeasuredAt()->format('Y-m-d'),
                    $m->getTempCelsius(),
                    $m->getFahrenheit(),
                ]);
            }

            return new Response(implode("\n", $lines), 200, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return $this->json([
            'city' => $city,
            'country' => $country,
            'measurements' => array_map(fn(Measurement $m) => [
                'date' => $m->getMeasuredAt()->format('Y-m-d'),
                'celsius' => $m->getTempCelsius(),
                'fahrenheit' => $m->getFahrenheit(),
            ], $measurements),
        ]);
    }
}
