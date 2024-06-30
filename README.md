<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# Livewire Data Tables

```php
public static function scopeFilterActive($query)
{
    return $query->whereNotNull('started_at')
        ->where('completed_at', null)
        ->where('expired_at', '>=', now());
}

public static function scopeFilterExpired($query)
{
    return $query->where('expired_at', '<=', now());
}
```

```php
$query = self::$model::studentCourse()
    ->when($this->filterBy === 'active', fn ($query) => $query->filterActive())
    ->when($this->filterBy === 'expired', fn ($query) => $query->filterExpired())
$query = $this->applySearch($query);
$query = $this->applySorting($query);
```

```html
<button wire:click="$set('filterBy', 'active')"
    class="btn xs outline rounded-full primary">Active</button>
<button wire:click="$set('filterBy', 'expired')"
    class="btn xs outline rounded-full primary">Expired</button>
```