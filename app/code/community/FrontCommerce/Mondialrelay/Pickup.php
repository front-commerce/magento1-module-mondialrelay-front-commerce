<?php

class FrontCommerce_Mondialrelay_Pickup
{
    private $id;
    private $name;
    private $street;
    private $zipcode;
    private $city;
    private $latitude;
    private $longitude;
    private $countryCode;
    private $distance;
    private $schedule;

    public function __construct(
        string $id, string $name, array $street, string $zipcode,
        string $city, float $latitude, float $longitude, string $countryCode,
        float $distance, array $schedule
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->street = $street;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->countryCode = $countryCode;
        $this->distance = $distance;
        $this->schedule = $schedule;
    }

    private static function formatHour(string $hour): string
    {
        return substr($hour, 0, 2) . 'h' . substr($hour, 2, 2);
    }

    private static function isClosedOn(stdClass $dayScheduleSource): bool
    {
        return $dayScheduleSource->string[0] === "0000" && $dayScheduleSource->string[1] === "0000";
    }

    private static function hasASecondOpeningRange(stdClass $dayScheduleSource): bool
    {
        return $dayScheduleSource->string[2] !== "0000" && $dayScheduleSource->string[3] !== "0000";
    }

    private static function buildSchedule(stdClass $pickup): array
    {
        $days = [
            'monday' => 'Horaires_Lundi',
            'tuesday' => 'Horaires_Mardi',
            'wednesday' => 'Horaires_Mercredi',
            'thursday' => 'Horaires_Jeudi',
            'friday' => 'Horaires_Vendredi',
            'saturday' => 'Horaires_Samedi',
            'sunday' => 'Horaires_Dimanche',
        ];
        $schedule = [];
        foreach ($days as $dayEN => $keyFR) {
            $dayScheduleSource = $pickup->{$keyFR};
            if (self::isClosedOn($dayScheduleSource)) {
                continue;
            }
            $daySchedule = self::formatHour($dayScheduleSource->string[0]);
            $daySchedule .= ' - ';
            $daySchedule .= self::formatHour($dayScheduleSource->string[1]);
            if (self::hasASecondOpeningRange($dayScheduleSource)) {
                $daySchedule .= " / ";
                $daySchedule .= self::formatHour($dayScheduleSource->string[2]);
                $daySchedule .= ' - ';
                $daySchedule .= self::formatHour($dayScheduleSource->string[3]);
            }
            $schedule[$dayEN] = $daySchedule;
        }
        return $schedule;
    }

    public static function fromMondialRelayResult(stdClass $pickup): self
    {
        $schedule = self::buildSchedule($pickup);
        $street = [trim($pickup->LgAdr3)];
        if ($pickup->LgAdr4) {
            $street[] = trim($pickup->LgAdr4);
        }
        return new self(
            $pickup->Num,
            trim($pickup->LgAdr1) . (trim($pickup->LgAdr2) ? ' ' . trim($pickup->LgAdr2) : ''),
            $street,
            $pickup->CP,
            trim($pickup->Ville),
            (float) str_replace(',', '.', $pickup->Latitude),
            (float) str_replace(',', '.', $pickup->Longitude),
            $pickup->Pays,
            (float) $pickup->Distance,
            $schedule
       );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
