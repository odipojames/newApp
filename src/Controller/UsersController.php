<?php
declare(strict_types=1);

namespace App\Controller;


class UsersController extends AppController

{

    public function initialize(): void
    {
        parent::initialize();
        
        $this->fetchTable("Users");
    }

 
    public function beforeFilter(\Cake\Event\EventInterface $event)
{
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login','register']);
}

public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        // redirect to /articles after login success
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Employees',
            'action' => 'index',
        ]);

        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }

}

public function register(){
  $user =  $this->Users->newEmptyEntity();
  if($this->request->is('post')){
    //form validations
    if($this->request->getData('password_confirm')!= $this->request->getData('password')){
        $this->Flash->error(_('passwords do not match'));
    }

    if(strlen($this->request->getData('password'))<4){
         $this->Flash->error(_('passwords must be four characters and above!'));
    }

    $emailExists = $this->Users->exists(['email' => $this->request->getData('email')]);
    if($emailExists){
        $this->Flash->error(_("email already used!"));
    }
   
    $user = $this->Users->patchEntity($user,$this->request->getData());
    if($this->Users->save($user)){
        $this->Flash->success(_("sign up successful! Login now"));
        $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
   else{
    $this->Flash->error(_("error occured try again!"));
   }

  }
  $this->set(compact('user'));

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



}
