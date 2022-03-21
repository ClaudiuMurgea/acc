<?php
namespace App\Services;

use App\Repositories\FacilityRepository;
use TheCodeRepublic\Repository\AbstractService;

class FacilityService extends AbstractService
{

    public $facilityrepository;

    public function __construct(FacilityRepository $facilityRepository)
    {
        $this->facilityrepository = $facilityRepository;
    }

    public function UpdateFacilityRegistrationStep($facility,$step){

        if ($facility && $facility->registration_step < $step){
            $this->facilityrepository->update(
                $facility->id,
                [
                    'registration_step' => $step
                ]
            );
        }
    }
}
