# Projektregeln

## Stack
- PHP 8.4
- Laravel 13
- MySQL
- Blade, Livewire 4, Tailwind
- Keine neue Production Dependency ohne Begründung

## Architektur
- Modularer Monolith
- Businesslogik nicht in Controllern oder Livewire-Komponenten
- Keine Microservices
- Keine separate REST API, solange kein externer Client existiert

## Qualität
- Vor Abschluss: composer test
- Datenbankänderungen ausschließlich über Migrationen
- Keine Secrets oder personenbezogenen Daten committen
- Neue Funktionen benötigen mindestens einen Feature-Test

## Definition of Done
- Tests grün
- Migration vorwärts und rückwärts geprüft
- Berechtigungen serverseitig geprüft
- Keine Debug-Ausgaben