<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

use App\Traits\Hashidable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Hashidable;

    const PERSONAL = 1;
    const BUSINESS = 2;

    const ACCOUNT_TYPES = [
        self::PERSONAL,
        self::BUSINESS
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'business_name',
        'email',
        'bio',
        'password',
        'account_type',
        'address_1',
        'address_2',
        'town',
        'county',
        'country',
        'postcode',
        'latitude',
        'longitude',
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'latitude',
        'longitude',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'account_type',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_name',
        'business_name',
        'address_1',
        'address_2',
        'town',
        'postcode',
        'latitude',
        'longitude',
        'country',
        'county',
        'email',
        'email_verified_at',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'is_admin',
        'phone',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'displayName',
        'location',
    ];

    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }

    public function publishedBikes()
    {
        return $this->hasMany(Bike::class)->where('published', 1);
    }

    public function soldBikes()
    {
        return $this->hasMany(Bike::class)->where('sold', 1);
    }

    public function viewedBikes()
    {
        return $this->hasManyThrough(Bike::class,BikeView::class, 'user_id', 'id', 'id', 'bike_id');
    }

    public function publishedOrSoldBikes()
    {
        return $this->hasMany(Bike::class)->where(function ($q) {
            $q->where('published', 1)
                ->orWhere('sold', 1);
        });
    }

    public function verificationImages()
    {
        return $this->hasMany(VerificationImage::class);
    }

    public function bannerImages()
    {
        return $this->hasMany(BannerImage::class);
    }

    public function bannerImage()
    {
        return $this->bannerImages()->latest()->first();
    }

    public function profileImages()
    {
        return $this->hasMany(ProfileImage::class);
    }

    public function profileImage()
    {
        return $this->profileImages()->latest()->first();
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function favouriteBikes()
    {
        return $this->hasManyThrough(Bike::class,Favourite::class, 'user_id', 'id', 'id', 'bike_id');
    }

    public function conversations()
    {
        return $this->hasManyThrough(Conversation::class, ConversationParticipant::class, 'user_id', 'id', 'id', 'conversation_id');
    }

    public function unreadMessages()
    {
        return ConversationMessage::where('read', '=', 0)
            ->whereIn('conversation_id', $this->conversations->pluck('id'))
            ->where('user_id', '!=', $this->id)
            ->get();
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function getInitialsAttribute(): string
    {
        return $this->generateInitials($this->name);
    }

    public function getDisplayNameAttribute(): string
    {
        if ($this->account_type === self::BUSINESS) {
            return $this->business_name;
        }

        $parts = [];

        $parts[] = $this->first_name;

        if (!empty($this->last_name)) {
            $parts[] = $this->last_name[0] . '.';
        }

        return join(' ', $parts);
    }

    /**
     * Generate initials from a name
     *
     * @param string $name
     * @return string
     */
    public function generateInitials($name): string
    {
        $words = explode(' ', $this->name);

        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        }

        return $this->makeInitialsFromSingleWord($name);
    }

    /**
     * Make initials from a word with no spaces
     *
     * @param string $name
     * @return string
     */
    protected function makeInitialsFromSingleWord($name): string
    {
        preg_match_all('#([A-Z]+)#', $name, $capitals);

        if (count($capitals[1]) >= 2) {
            return substr(implode('', $capitals[1]), 0, 2);
        }

        return strtoupper(substr($name, 0, 2));
    }

    public function getNameAttribute(): string
    {
        return sprintf("%s %s", $this->first_name, $this->last_name);
    }

    public function getAddressAttribute(): string
    {
        $parts = [];

        if (!empty($this->address_1)) {
            $parts[] = $this->address_1;
        }

        if (!empty($this->address_2)) {
            $parts[] = $this->address_2;
        }

        if (!empty($this->town)) {
            $parts[] = $this->town;
        }

        if (!empty($this->county)) {
            $parts[] = $this->county;
        }

        if (!empty($this->postcode)) {
            $parts[] = $this->postcode;
        }

        /*
            if (!empty($this->country)) {
                $parts[] = $this->country;
            }
        */

        return implode("\n", $parts);
    }

    public function getLocationAttribute(): string
    {
        $parts = [];

        if (!empty($this->town)) {
            $parts[] = $this->town;
        }

        if (!empty($this->country)) {
            $parts[] = $this->country;
        }

        return implode(" ", $parts);
    }

    public function setFacebookAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['facebook'] = basename(preg_replace('/@/', '', $value, 1));
        } else {
            $this->attributes['facebook'] = null;
        }
    }

    public function setTwitterAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['twitter'] = basename(preg_replace('/@/', '', $value, 1));
        } else {
            $this->attributes['twitter'] = null;
        }
    }

    public function setInstagramAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['instagram'] = basename(preg_replace('/@/', '', $value, 1));
        } else {
            $this->attributes['instagram'] = null;
        }
    }

    public function setLinkedinAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['linkedin'] = basename(preg_replace('/@/', '', $value, 1));
        } else {
            $this->attributes['linkedin'] = null;
        }
    }

    public function accountType(): string
    {
        return $this->account_type === self::BUSINESS ? 'Business' : 'Personal';
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->displayName);
    }



    ////new////
    public function products(){
        return $this->hasMany('App\Models\Bike');
      }
    public function invoice(){
        return $this->hasMany('App\Models\Invoice');
      }
      public function report(){
          return $this->hasMany('App\Models\Report');
        }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
      }
}