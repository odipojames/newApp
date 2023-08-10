<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;


/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfilesController extends AppController
{

    

    public function initialize(): void
    {
        parent::initialize();
        // Load the Comments model
        $this->fetchTable('Profiles');
        
    }


    

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $profiles = $this->paginate($this->Profiles);

        $this->set(compact('profiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('profile'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * 
     */


    
     
    public function add()

    {
        $personalData = TableRegistry::getTableLocator()->get('PersonalDetails');
        $acadamicData = TableRegistry::getTableLocator()->get('AcadamicQualification');  
       
        $programs = ['masters'=>'masters','degree'=>'degree','diploma'=>'diploma'];
        $id = $this->request->getSession()->read('Auth.id');
        $profile = $this->Profiles->find()->where(['user_id'=>$id])->first();
        $profileArray= $this->Profiles->find()->where(['user_id'=>$this->request->getSession()->read('Auth.id')])->first()->toArray();
        
       
        
        if(!$profile){
            $profile = $this->Profiles->newEmptyEntity();
            
        }
        $details = $personalData->newEmptyEntity();
        if($profileArray['personal_details']){
            $details = $personalData->find()->where(['id'=>$profile->personal_details])->first();
        }
        $acadamic = $acadamicData->newEmptyEntity();
        if($profileArray['acadamic_qualification']){
            $acadamic  = $acadamicData->find()->where(['id'=>$profile->acadamic_qualification])->first();
        }
        $this->set(compact('details','acadamic'));
        if($this->request->is(['patch','post','put'])){
           
           if($this->request->getData('phone_number')){
            $details = $personalData->patchEntity($details,$this->request->getData());
            if($personalData->save($details)){
              $profile = $this->Profiles->patchEntity($profile, $profileArray);
              $profile->personal_details=$details->id;
              $this->Profiles->save($profile);
              $tabToOpen = 'profile';
              $this->Flash->success(__('personal details Saved! move to acadamic'));
              $this->redirect(['action' => 'add', '?' => ['tab' => $tabToOpen]]);
            }

           }
        
           if($this->request->getData('course')){
            $acadamic = $acadamicData->patchEntity($acadamic,$this->request->getData());
            if($acadamicData->save($acadamic)){
              $profile = $this->Profiles->patchEntity($profile, $profileArray);
              $profile->acadamic_qualification=$acadamic->id;
              if($this->Profiles->save($profile)){
                $this->Flash->success(__('profile updated!'));
                $this->set(compact('details','acadamic'));
              }
              else{
                $this->Flash->error(__("error profile not updated!"));
              }
            }
            
           }
            
        }
        $this->set(compact('acadamic','profile','details','programs'));
   
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $users = $this->Profiles->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('profile', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
