<?php

namespace App\Entity;

use App\Repository\MeasurementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeasurementRepository::class)]
class Measurement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'measurements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Localization $localization = null;

    #[ORM\Column]
    private ?\DateTime $measuredAt = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 1)]
    private ?string $tempCelsius = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 1)]
    private ?string $precipitationMm = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 1)]
    private ?string $windSpeedKmh = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 1)]
    private ?string $pressureHpa = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $humidityPercent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalization(): ?Localization
    {
        return $this->localization;
    }

    public function setLocalization(?Localization $localization): static
    {
        $this->localization = $localization;

        return $this;
    }

    public function getMeasuredAt(): ?\DateTime
    {
        return $this->measuredAt;
    }

    public function setMeasuredAt(\DateTime $measuredAt): static
    {
        $this->measuredAt = $measuredAt;

        return $this;
    }

    public function getTempCelsius(): ?string
    {
        return $this->tempCelsius;
    }

    public function setTempCelsius(string $tempCelsius): static
    {
        $this->tempCelsius = $tempCelsius;

        return $this;
    }

    public function getPrecipitationMm(): ?string
    {
        return $this->precipitationMm;
    }

    public function setPrecipitationMm(string $precipitationMm): static
    {
        $this->precipitationMm = $precipitationMm;

        return $this;
    }

    public function getWindSpeedKmh(): ?string
    {
        return $this->windSpeedKmh;
    }

    public function setWindSpeedKmh(string $windSpeedKmh): static
    {
        $this->windSpeedKmh = $windSpeedKmh;

        return $this;
    }

    public function getPressureHpa(): ?string
    {
        return $this->pressureHpa;
    }

    public function setPressureHpa(string $pressureHpa): static
    {
        $this->pressureHpa = $pressureHpa;

        return $this;
    }

    public function getHumidityPercent(): ?int
    {
        return $this->humidityPercent;
    }

    public function setHumidityPercent(int $humidityPercent): static
    {
        $this->humidityPercent = $humidityPercent;

        return $this;
    }
}
