<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // ── Helpers ──────────────────────────────────────────────────────────────

    public function markAsRead(): void
    {
        $this->update([
            'status'  => 'read',
            'read_at' => now(),
        ]);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'unread'  => '<span class="badge badge-warning">Unread</span>',
            'read'    => '<span class="badge badge-info">Read</span>',
            'replied' => '<span class="badge badge-success">Replied</span>',
            default   => '<span class="badge">Unknown</span>',
        };
    }
}
