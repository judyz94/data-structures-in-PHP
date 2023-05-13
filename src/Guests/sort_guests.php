<?php

require 'guests_information.php';

/** Function to sort guests based on one or more keys */
function sortGuests(array $guests, array $sortKeys): array
{
    usort($guests, function($guest1, $guest2) use ($sortKeys) {
        foreach ($sortKeys as $key) {
            $valueGuest1 = getValue($guest1, $key);
            $valueGuest2 = getValue($guest2, $key);

            if ($valueGuest1 != $valueGuest2) {
                return $valueGuest1 > $valueGuest2 ? 1 : -1;
            }
        }

        return 0;
    });

    return $guests;
}

/** Function to search recursively a key in a multidimensional array */
function getValue(mixed $array, string $key): mixed
{
    if (is_array($array)) {
        foreach ($array as $subArray) {
            $value = getValue($subArray, $key);

            if (!is_null($value)) {
                return $value;
            }
        }
    } else if (is_object($array)) {
        return getValue(get_object_vars($array), $key);
    }

    return $array[$key] ?? null;
}

/** Call function to sort guest information */
$sortedGuests = sortGuests($guests, ['last_name', 'account_id']);
//$sortedGuests = sortGuests($guests, ['gender', 'first_name']);

/** Print the sorted guest array */
print_r($sortedGuests);



