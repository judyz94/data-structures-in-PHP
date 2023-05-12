<?php

require 'guests_information.php';

/** Function to print guests as key-value pairs */
function printGuestInformation(array $guests): void
{
    foreach ($guests as $index => $guest) {
        if (array_key_exists('guest_id', $guest)) {
            echo "\nGUEST INFORMATION " . ($index+1) . ":\n\n";
        }

        foreach ($guest as $key => $value) {
            if (is_array($value)) {
                echo "\n" . formatString($key) . ":\n";

                foreach ($value as $subkey => $subvalue) {
                    if (is_array($subvalue)) {
                        printGuestInformation([$subvalue]);
                    } else {
                        if (!is_null($subvalue)) {
                            echo "$subkey: $subvalue\n";
                        }
                    }
                }
            } else {
                if (!is_null($value)) {
                    if (is_bool($value)) {
                        $value = var_export($value, true);
                    }
                    echo "$key: $value\n";
                }
            }
        }
    }
}

/** Function to format a string readably */
function formatString(string $str): string
{
    $str = str_replace('_', ' ', $str);
    $str = ucwords($str);

    return $str;
}

/** Call function to print guest information */
printGuestInformation($guests);
