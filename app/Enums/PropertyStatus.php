<?php

namespace App\Enums;

enum PropertyStatus: string
{
    case Draft = 'draft';
    case PendingReview = 'pending_review';
    case Active = 'active';
    case UnderOffer = 'under_offer';
    case Reserved = 'reserved';
    case Sold = 'sold';
    case Leased = 'leased';
    case Archived = 'archived';
}
