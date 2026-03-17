<?php

namespace App\Helpers;

use Carbon\Carbon;

class ParkingHelper
{
    /**
     * Formatea la diferencia de tiempo de forma amigable
     * Ejemplos: "2h 30m", "1d 3h 15m", "45m"
     */
    public static function formatDuration(Carbon $start, Carbon $end): string
    {
        $diff = $start->diff($end);
        
        $parts = [];
        
        if ($diff->d > 0) {
            $parts[] = $diff->d . 'd';
        }
        
        if ($diff->h > 0) {
            $parts[] = $diff->h . 'h';
        }
        
        if ($diff->i > 0) {
            $parts[] = $diff->i . 'm';
        }
        
        // Si es 0 minutos, mostrar "menos de 1 minuto"
        if (empty($parts)) {
            return '< 1m';
        }
        
        return implode(' ', $parts);
    }

    /**
     * Formatea la experiencia de usuario para tiempo en parqueo
     * Ejemplos: "2 horas y 30 minutos", "1 día, 3 horas"
     */
    public static function formatDurationUX(Carbon $start, Carbon $end): string
    {
        $diff = $start->diff($end);
        
        $parts = [];
        
        if ($diff->d > 0) {
            $parts[] = $diff->d . ' día' . ($diff->d > 1 ? 's' : '');
        }
        
        if ($diff->h > 0) {
            $parts[] = $diff->h . ' hora' . ($diff->h > 1 ? 's' : '');
        }
        
        if ($diff->i > 0) {
            $parts[] = $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '');
        }
        
        if (empty($parts)) {
            return 'Menos de 1 minuto';
        }
        
        if (count($parts) === 1) {
            return $parts[0];
        }
        
        $last = array_pop($parts);
        return implode(', ', $parts) . ' y ' . $last;
    }

    /**
     * Obtiene la zona horaria de Colombia
     */
    public static function colombiaTimezone(): string
    {
        return 'America/Bogota';
    }

    /**
     * Obtiene ahora en Colombia
     */
    public static function now(): Carbon
    {
        return Carbon::now(self::colombiaTimezone());
    }
}
