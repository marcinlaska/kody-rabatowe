# Generator kodów rabatowych
Aplikacja generująca kody rabatowe. Można określić ilość kodów do wygenerowania, ich długość oraz jakie znaki ma zawierać (tylko cyfry bądź cyfry oraz litery). Generator można uruchomić z poziomu przeglądarki (kody zostaną wyświetlone na stronie) oraz konsoli (kody zostaną zapisane do pliku tekstowego).

## Interfejs webowy
Uruchom na serwerze plik `index.php`, znajdujący się w katalogu `public`. Zostanie wyświetlona lista kodów, wygenerowanych na bazie domyślnych opcji. Opcje te możesz zmienić w formularzu, a następnie wygenerować nowe kody, wedle własnych upodobań.

## Interfejs konsolowy
Uruchom komendę `php bin/console make:discount-codes 3 4 numeric`, gdzie `3` to liczba kodów, `4` to ich długość, zaś `numeric` możesz zamienić na `alphanumeric`, by kody mogły zawierać litery, a nie tylko cyfry.
