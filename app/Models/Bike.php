<?php

namespace App\Models;

use App\Jobs\BikeExpirationNotification;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

use App\Traits\Hashidable;

class Bike extends Model
{
    use HasFactory, SoftDeletes, Hashidable;

    protected $guarded = ['id'];

    protected $hidden = [
        'postcode',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'paused_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function pauses()
    {
        return $this->hasMany(BikePause::class);
    }

    public function latestRunningPause()
    {
        return $this->hasOne(BikePause::class)->latest()->whereNull('unpaused_at');
    }

    public function favouritedUsers()
    {
        return $this->belongsToMany(User::class, 'favourites');
    }

    public function views()
    {
        return $this->hasMany(BikeView::class);
    }

    public function viewedUsers()
    {
        return $this->belongsToMany(User::class, 'bike_views');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function frameType()
    {
        return $this->belongsTo(FrameType::class);
    }

    public function frameSize()
    {
        return $this->belongsTo(FrameSize::class);
    }

    public function wheelSize()
    {
        return $this->belongsTo(WheelSize::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function images()
    {
        return $this->hasMany(BikeImage::class)->orderBy('order', 'asc');
    }

    public function coverImage()
    {
        return $this->images()->first();
    }

    public function scopeThirtyDaysOld($query)
    {
        return $query->where('published_at', '<=', self::thirtyDaysAgo());
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', '=', 0);
    }

    public function scopePublished($query)
    {
        return $query->where('published', '=', 1);
    }

    public function scopeUnpaused($query)
    {
        return $query->where('paused', '=', 0);
    }

    public function scopePaused($query)
    {
        return $query->where('paused', '=', 1);
    }

    public function scopeUnsold($query)
    {
        return $query->where('sold', '=', 0);
    }

    public function scopeSold($query)
    {
        return $query->where('sold', '=', 1);
    }

    public function markAsSold()
    {
        $this->sold = 1;
        $this->sold_at = now();
        $this->save();
    }

    public function publish()
    {
        $this->published = 1;
        $this->published_at = now();

        $this->save();
    }

    public function unpublish()
    {
        $this->published = 0;
        $this->save();
    }

    public function pause()
    {
        $this->paused = 1;
        $this->paused_at = now();
        $this->save();

        $pause = new BikePause();
        $pause->paused_at = $this->paused_at;

        $this->pauses()->save($pause);
    }

    public function unpause()
    {
        $pause = $this->latestRunningPause;
        $pause->unpaused_at = now();

        $pause->pause_total = $pause->unpaused_at->diffInSeconds($pause->paused_at);
        $pause->running_total = $pause->siblings()->sum('pause_total') + $pause->pause_total;
        $pause->save();

        $this->updatePauseTotal();

        $this->paused = 0;
        $this->paused_at = null;

        $this->save();
    }

    public function pauseTotal()
    {
        // only use pauses since the bike was last published
        return $this->pauses()
            ->where('paused_at', '>=', $this->published_at)
            ->sum('pause_total');
    }

    public function formattedPauseTotal()
    {
        return CarbonInterval::seconds($this->pauseTotal())->cascade()->forHumans();
    }

    public function lifetimePauseTotal()
    {
        // only use pauses since the bike was last published
        return $this->pauses()
            ->sum('pause_total');
    }

    public function formattedLifetimePauseTotal()
    {
        return CarbonInterval::seconds($this->lifetimePauseTotal())->cascade()->forHumans();
    }

    public function updatePauseTotal()
    {
        $this->total_pause_duration = $this->pauseTotal();
        $this->save();
    }

    public function addView(?User $user = null)
    {
        $this->view_count = $this->view_count + 1;
        $this->save();

        if (!empty($user) && $user->id !== $this->user_id && !$user->isAdmin()) {
            $this->viewedBy($user);
        }
    }

    public function viewedBy(User $user)
    {
        $this->viewedUsers()->attach($user);
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->title);
    }

    public function getStatusAttribute(): string
    {
        if ($this->trashed()) {
            return 'Deleted';
        }

        if ($this->sold) {
            return 'Sold';
        }

        if ($this->paused) {
            return 'Paused';
        }

        if ($this->published) {
            return 'Published';
        }

        if (!$this->published) {
            return 'Unpublished';
        }
    }

    public function rowColour(): string
    {
        if ($this->trashed()) {
            return 'red-100';
        }

        if ($this->sold) {
            return 'green-100';
        }

        if ($this->paused) {
            return 'yellow-100';
        }

        if ($this->published) {
            return 'blue-100';
        }

        if (!$this->published) {
            return 'grey-100';
        }
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function rawFormattedPrice()
    {
        return sprintf("%s", number_format($this->price / 100, 2, '.', ''));
    }
    public function formattedPrice()
    {
        return sprintf("£%s", number_format($this->price / 100, 2));
    }

    public function favouritedBy(User $user)
    {
        $this->favouritedUsers()->attach($user);
    }

    public function unfavouritedBy(User $user)
    {
        $this->favouritedUsers()->detach($user);
    }

    public static function featuredBikes(?Bike $ignoredBike = null)
    {
        $query = self::published()
            ->unsold()
            ->unpaused()
            ->latest()
            ->take(10);

        if ($ignoredBike) {
            $query->where('id', '!=', $ignoredBike->id);
        }

        return $query->get();
    }

    public function alsoViewed()
    {
        $bikeId = $this->id;

        // get the users who've viewed this bike and then find what other books they have viewed
        $users = $this->viewedUsers->unique();
        $bikes = new Collection();

        foreach ($users as $user) {
            $bikes = $bikes->merge($user->viewedBikes->unique());
        }

        $bikes = $bikes->unique();

        // remove the current bike
        $bikes = $bikes->filter(function ($bike, $key) use ($bikeId) {
            return $bike->id !== $bikeId;
        });

        if ($bikes->count() === 0) {
            // $bikes = self::featuredBikes($this);
            $bikes = self::featuredBikes();
        }

        return $bikes;
    }

    public function imageUrls()
    {
        $array = [];

        foreach ($this->images as $image) {
            $array[] = ['src' => $image->url()];
        }

        return $array;
    }

    public function location() {

        if (!empty($this->latitude) && !empty($this->longitude)) {
            $parts = [];

            if (!empty($this->postcode)) {
                $parts[] = $this->postcode;
            }

            /*
            if (!empty($this->district)) {
                $parts[] = $this->district;
            }
            if (!empty($this->country)) {
                $parts[] = $this->country;
            }
            */

            return implode(', ', $parts);
        }

        if (!empty($this->postcode)) {
            return $this->postcode;
        }

        return null;
    }

    public function shouldBeUnpublished(): bool
    {
        // check if it's been published
        if (empty($this->published_at)) {
            return false;
        }

        if ($this->endDate()->gte(now())) {
            return true;
        }

        return false;
    }

    public static function expireListings()
    {
        // listings need to be at least thirty days old,
        // we will take pauses in to account
        $bikes = self::published()
            ->thirtyDaysOld()
            ->get();

        foreach ($bikes as $bike) {
            if ($bike->shouldBeUnpublished()) {
                $bike->expire();
            }
        }
    }

    public function expire(): void
    {
        $this->unpublish();

        BikeExpirationNotification::dispatch($this);
    }

    public static function thirtyDaysAgo()
    {
        return today()->subDays(30);
    }

    public function endDate()
    {
        if (empty($this->published_at)) {
           return null;
        }

        $totalPauseDuration = $this->pauseTotal();
        return $this->published_at->addDays(30)->addSeconds($totalPauseDuration);
    }

}