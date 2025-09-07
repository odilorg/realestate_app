<?php

namespace App\Enums;

enum PropertyStatus:string
{
    case DRAFT = 'draft';
    case PENDING_REVIEW = 'pending_review';
    case ACTIVE = 'active';
    case UNDER_OFFER = 'under_offer';
    case RESERVED = 'reserved';
    case SOLD = 'sold';
    case LEASED = 'leased';
    case ARCHIVED = 'archived';
}
