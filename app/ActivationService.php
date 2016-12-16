<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }


    /*
    * Send an email to user with instruction to confirm account registration
    */
    public function sendActivationMail($user)
    {

        if ($user->active || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user_setpass', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        $this->mailer->send('emails.user_signup',compact('user','link'), function (Message $m) use ($user) {
            $m->to($user->email)->subject('Account confirmation');
        });


    }

    /*
    * Get the user base on the activation token
    */
    public function getUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        return $user;

    }

    /*
    * Set user status to active and also set the password for this user
    */
    public function activateUser($token,$password)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->active = true;
        $user->password = bcrypt($password);

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}