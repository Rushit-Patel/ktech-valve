<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description'
    ];

    /**
     * Get a setting value by key.
     */
    public static function get($key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value.
     */
    public static function set($key, $value, $type = 'text', $group = 'general', $label = null)
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'label' => $label ?: ucfirst(str_replace('_', ' ', $key))
            ]
        );

        Cache::forget("setting.{$key}");
        Cache::forget("settings.{$group}");

        return $setting;
    }

    /**
     * Get all settings by group.
     */
    public static function getByGroup($group)
    {
        return Cache::remember("settings.{$group}", 3600, function () use ($group) {
            return static::where('group', $group)->pluck('value', 'key');
        });
    }

    /**
     * Clear settings cache.
     */
    public static function clearCache()
    {
        $keys = static::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("setting.{$key}");
        }

        $groups = static::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("settings.{$group}");
        }
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget("settings.{$setting->group}");
        });

        static::deleted(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget("settings.{$setting->group}");
        });
    }

    /**
     * Get the formatted value based on type.
     */
    public function getFormattedValueAttribute()
    {
        return match($this->type) {
            'boolean' => (bool) $this->value,
            'json' => json_decode($this->value, true),
            'image' => $this->value ? asset('storage/' . $this->value) : null,
            default => $this->value
        };
    }

    /**
     * Scope to get settings by group.
     */
    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}