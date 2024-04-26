<?php

function calcularEdad($birthDate) {
    // Convert the birthDate string to a DateTime object
    $birthDateObject = new DateTime($birthDate);

    // Calculate the current date
    $today = new DateTime();

    // Calculate the age difference in years
    $age = $today->diff($birthDateObject)->y;

    // Return the calculated age
    return $age;
}