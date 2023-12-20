<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bike;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use JustSteveKing\LaravelPostcodes\Facades\Postcode;
use Livewire\Component;
use Livewire\WithPagination;

class Bikes extends Component
{
    use WithPagination;

    public $open = false;

    public $bike;

    public $title;
    public $description;
    public $model;
    public $frameNumber;
    public $manufacturerId;
    public $frameTypeId;
    public $conditionId;
    public $frameSizeId;
    public $wheelSizeId;
    public $genderId;
    public $uploadedToVeloeye;
    public $price;
    public $postcode;
    public $additionalDetails;
    public $moreThanOneAvailable;
    public $year;
    public $published;
    public $sold;

    // Filters
    public $search;
    public $perPage;

    protected $rules = [
        'title' => 'required|max:255',
        'description' => 'nullable|max:2000',
        'model' => 'nullable|max:255',
        'frameNumber' => 'nullable|required_if:uploaded_to_veloeye,1|max:255',
        'manufacturerId' => 'required|exists:manufacturers,id',
        'frameTypeId' => 'required|exists:frame_types,id',
        'conditionId' => 'required|exists:conditions,id',
        'frameSizeId' => 'nullable|exists:frame_sizes,id',
        'wheelSizeId' => 'nullable|exists:wheel_sizes,id',
        'genderId' => 'nullable|exists:genders,id',
        'uploadedToVeloeye' => 'nullable|boolean',
        'price' => 'required|numeric',
        'postcode' => 'nullable|string|max:255',
        'additionalDetails' => 'nullable|max:2000',
        'moreThanOneAvailable' => 'nullable|boolean',
    ];

    public function mount()
    {
        $this->resetBike();
    }

    public function render()
    {
        $bikes = $this->reloadBikes();

        return view('livewire.admin.bikes', [
            'bikes' => $bikes,
        ]);
    }

    public function reloadBikes(): LengthAwarePaginator
    {
        $query = Bike::query()->withTrashed();
        $search = $this->search;

        $query->when(!empty($search), function ($query) use ($search) {

            $query->where(function($query) use ($search) {
                return $query->where('bikes.title', 'like', '%' . $search . '%');
            });

        });

        $query->orderBy('updated_at', 'desc');

        return $query->paginate($this->perPage);
    }

    public function resetBike()
    {
        $this->bike = null;

        $this->title = null;
        $this->description = null;
        $this->model = null;
        $this->frameNumber = null;
        $this->manufacturerId = null;
        $this->frameTypeId = null;
        $this->conditionId = null;
        $this->frameSizeId = null;
        $this->wheelSizeId = null;
        $this->genderId = null;
        $this->uploadedToVeloeye = 0;
        $this->price = null;
        $this->postcode = null;
        $this->additionalDetails = null;
        $this->moreThanOneAvailable = 0;
        $this->year = null;
        $this->published = 0;
        $this->sold = 0;
    }

    public function addBike()
    {
        $this->resetBike();
        $this->open = true;
    }

    public function setBike($id)
    {
        $bike = Bike::withTrashed()->findOrFail($id);
        $this->bike = $bike;

        $this->title = $this->bike->title;
        $this->description = $this->bike->description;
        $this->model = $this->bike->model;
        $this->frameNumber = $this->bike->frame_number;
        $this->manufacturerId = $this->bike->manufacturer_id;
        $this->frameTypeId = $this->bike->frame_type_id;
        $this->conditionId = $this->bike->condition_id;
        $this->frameSizeId = $this->bike->frame_size_id;
        $this->wheelSizeId = $this->bike->wheel_size_id;
        $this->genderId = $this->bike->gender_id;
        $this->uploadedToVeloeye = $this->bike->uploaded_to_veloeye;
        $this->price = $this->bike->rawFormattedPrice();
        $this->postcode = $this->bike->postcode;
        $this->additionalDetails = $this->bike->additional_details;
        $this->moreThanOneAvailable = $this->bike->more_than_one_available;
        $this->year = $this->bike->year;
        $this->published = $this->bike->published;
        $this->sold = $this->bike->sold;

        $this->open = true;
    }


    public function save()
    {

        $this->validate();

        if (empty($this->bike)) {
            $this->bike = new Bike();
        }

        if (empty($this->moreThanOneAvailable)) {
            $this->moreThanOneAvailable = 0;
        }

        if (empty($this->uploadedToVeloeye)) {
            $this->uploadedToVeloeye = 0;
        }

        if (empty($this->conditionId)) {
            $this->conditionId = null;
        }

        if (empty($this->frameTypeId)) {
            $this->frameTypeId = null;
        }

        if (empty($this->frameSizeId)) {
            $this->frameSizeId = null;
        }

        if (empty($this->wheelSizeId)) {
            $this->wheelSizeId = null;
        }

        if (empty($this->genderId)) {
            $this->genderId = null;
        }

        if (!empty($this->postcode)) {
            try {
                $postcodeLookup = Postcode::getOutwardCode($this->postcode);
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                $this->addError('postcode', 'Please enter the FIRST part of a valid postcode');
                return false;
            }
        }

        $this->bike->postcode = null;
        $this->bike->latitude = null;
        $this->bike->longitude = null;
        $this->bike->district = null;
        $this->bike->country = null;

        if (isset($postcodeLookup->outcode)) {
            $this->bike->postcode = $postcodeLookup->outcode;
            $this->bike->latitude = $postcodeLookup->latitude;
            $this->bike->longitude = $postcodeLookup->longitude;
            $this->bike->district = $postcodeLookup->admin_district[0];
            $this->bike->country = $postcodeLookup->country[0];
        }

        $this->bike->title = $this->title;
        $this->bike->description = $this->description;

        $this->bike->model = $this->model;
        $this->bike->frame_number = $this->frameNumber;
        $this->bike->manufacturer_id = $this->manufacturerId;
        $this->bike->frame_type_id = $this->frameTypeId;
        $this->bike->condition_id = $this->conditionId;
        $this->bike->frame_size_id = $this->frameSizeId;
        $this->bike->wheel_size_id = $this->wheelSizeId;
        $this->bike->gender_id = $this->genderId;
        $this->bike->uploaded_to_veloeye = $this->uploadedToVeloeye;
        $this->bike->price = $this->price;
        $this->bike->additional_details = $this->additionalDetails;
        $this->bike->more_than_one_available = $this->moreThanOneAvailable;
        $this->bike->year = $this->year;
        $this->bike->published = $this->published;
        $this->bike->sold = $this->sold;

        $this->bike->save();

        $this->emitSelf('notify-saved');
    }

    public function delete(Bike $bike)
    {
        $bike->delete();

        $this->bike = $bike->refresh();

        $this->emitSelf('notify-deleted');
    }

    public function pause(Bike $bike)
    {
        $bike->pause();

        $this->bike = $bike->refresh();

        $this->emitSelf('notify-paused');
    }

    public function unpause(Bike $bike)
    {
        $bike->unpause();

        $this->bike = $bike->refresh();

        $this->emitSelf('notify-unpaused');
    }
}
