<?php

namespace App\Command;

use App\Repository\LocalizationRepository;
use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:location',
    description: 'Displays weather forecast for a location by its ID',
)]
class WeatherLocationCommand
{
    public function __construct(
        private readonly LocalizationRepository $localizationRepository,
        private readonly WeatherUtil $weatherUtil,
    ) {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Location ID')] int $id,
    ): int {
        $localization = $this->localizationRepository->find($id);

        if (!$localization) {
            $io->error(sprintf('Location with ID %d not found.', $id));
            return Command::FAILURE;
        }

        $measurements = $this->weatherUtil->getWeatherForLocation($localization);

        $io->writeln(sprintf('Location: %s', $localization->getName()));
        $io->table(['Date', 'Temperature'], array_map(fn($m) => [
            $m->getMeasuredAt()->format('Y-m-d'),
            $m->getTempCelsius(),
        ], $measurements));

        return Command::SUCCESS;
    }
}
