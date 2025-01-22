<?php

// Function to filter array by ID
function getUserFullName($user) {
    return "{$user['surname']} {$user['name']} {$user['thirdname']}";
}
