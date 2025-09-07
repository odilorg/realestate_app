<?php

namespace App\Enums;

enum PropertyType: string
{
    case Apartment = 'apartment';
    case House = 'house';
    case Land = 'land';
    case Commercial = 'commercial';
    case Office = 'office';
    case Villa = 'villa';
}
