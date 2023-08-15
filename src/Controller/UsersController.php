<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;


class UsersController extends AppController

{

    public function initialize(): void
    {
        parent::initialize();
        
        $this->fetchTable("Users");
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['register', 'activate', 'login', 'forgotPassword']);
    }

    public function register()
    {
        // Handle user registration
      $user =  $this->Users->newEmptyEntity();
      $Profile  =   TableRegistry::getTableLocator()->get('Profiles');  
      $profile =  $Profile->newEmptyEntity();
      $profileData = ['user_id'=>null];
      $this->set(compact('user'));
        if ($this->request->is('post')) {
            $user = $this->Users->newEntity($this->request->getData());
            $profile = $Profile->patchEntity($profile,$profileData);
            //form validations
            if($this->request->getData('password_confirm')!= $this->request->getData('password')){
                return $this->Flash->error(__('passwords do not match'));
            }
            $emailExists = $this->Users->exists(['email' => $this->request->getData('email')]);
            if($emailExists){
                return $this->Flash->error(__("email already used!"));
            }
            $user->activation_token = Security::randomString(32);
            if ($this->Users->save($user)) {
                //create profile for the user
                $profile->user_id=$user->id;
                $Profile->save($profile);
                // Send activation email
                $this->sendActivationEmail($user->email, $user->activation_token);
                $this->Flash->success('Registration successful. Please check your email to activate your account.');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('Registration failed. Please try again.');
        }
    }

    public function activate($token)
    {
        $user = $this->Users->findByActivationToken($token)->first();
        if ($user) {
            $user->activated = true;
            $this->Users->save($user);
            $this->Flash->success('Account activated. You can now log in.');
            return $this->redirect(['action' => 'login']);
        }
        $this->Flash->error('Invalid activation link.');
        return $this->redirect(['action' => 'login']);
    }

    public function login()
    {
        // Handle user login
        if ($this->request->is('post')) {
            $result = $this->Authentication->getResult();
            
            // Check if authentication is valid
            if ($result->isValid()) {
                // Check if the user's account is activated
                $user = $this->Authentication->getIdentity()->getOriginalData();
                if ($user['activated']) {
                    $redirect = $this->request->getQuery('redirect', [
                        'controller' => 'Employees',
                        'action' => 'index',
                    ]);
                    return $this->redirect($redirect);
                } else {
                    $this->Authentication->logout(); // Log out the user
                    $this->Flash->error('Your account is not activated. Please check your email for activation instructions.');
                }
            } else {
                $this->Flash->error('Invalid email or password.');
            }
        }
    }


 public function logout()

{
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}


    public function forgotPassword()
    {
        // Handle forgot password request
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->findByEmail($email)->first();
            if ($user) {
                $user->reset_token = Security::randomString(32);
                $user->reset_token_expiry = Time::now()->addMinutes(30);
                $this->Users->save($user);
                $this->sendPasswordResetEmail($user->email, $user->reset_token);
                $this->Flash->success('Password reset email sent. Please check your email.');
            } else {
                $this->Flash->error('Email not found.');
            }
        }
    }

    public function resetPassword($token)
    {
        $user = $this->Users->findByResetToken($token)->first();
        if ($user && $user->reset_token_expiry >= Time::now()) {
            if ($this->request->is('post')) {
                $user = $this->Users->patchEntity($user, [
                    'password' => $this->request->getData('password'),
                    'reset_token' => null,
                    'reset_token_expiry' => null,
                ]);
                if ($this->Users->save($user)) {
                    $this->Flash->success('Password reset successful. You can now log in.');
                    return $this->redirect(['action' => 'login']);
                }
                $this->Flash->error('Password reset failed. Please try again.');
            }
        } else {
            $this->Flash->error('Invalid or expired password reset link.');
            return $this->redirect(['action' => 'forgotPassword']);
        }
        $this->set(compact('token'));
    }

    // Email sending methods
    private function sendActivationEmail($email, $token)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($email)
            ->setSubject('Activate Your Account')
            ->setEmailFormat('html')
            ->setViewVars(['token' => $token])
            ->viewBuilder()
            ->setTemplate('activation');
        $mailer->send();
    }

    private function sendPasswordResetEmail($email, $token)
    {
        $mailer = new Mailer('default');
        $mailer
            ->setTo($email)
            ->setSubject('Password Reset')
            ->setEmailFormat('html')
            ->setViewVars(['token' => $token])
            ->viewBuilder()
            ->setTemplate('password_reset');
        $mailer->send();
    }
}
