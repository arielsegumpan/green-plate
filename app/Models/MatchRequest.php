<?php

namespace App\Models;

use App\Models\RecipientRequest;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tenant_id', 'donation_id', 'recipient_request_id', 'matching_score', 'algorithm_result', 'status'])]
class MatchRequest extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'algorithm_result' => 'array',
        ];
    }

    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function donation() : BelongsTo
    {
        return $this->belongsTo(Donation::class, 'donation_id', 'id');
    }

    public function recipientRequest() : BelongsTo
    {
        return $this->belongsTo(RecipientRequest::class, 'recipient_request_id', 'id');
    }

}
