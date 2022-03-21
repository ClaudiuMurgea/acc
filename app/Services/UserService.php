<?php
namespace App\Services;

use App\Repositories\UserRepository;
use TheCodeRepublic\Repository\AbstractService;

class UserService extends AbstractService
{

    public  $userRepository ;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function UpdateRegistrationStep($user,$step){

        if ($user->registration_step < $step){
            $this->userRepository->update(
                $user->id,
                [
                    'registration_step' => $step
                ]
            );
        }

    }
}
