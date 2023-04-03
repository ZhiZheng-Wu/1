<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * TenancyHistories Controller
 *
 * @property \App\Model\Table\TenancyHistoriesTable $TenancyHistories
 * @method \App\Model\Entity\TenancyHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TenancyHistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        /* Paginate edit start */
        $paginate = [
            'Tenant' => [],
        ];
        /* Paginate edit end */

        $tenancyHistory = $this->TenancyHistories->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]
        /* Start Authorisation */
        $this->Authorization->authorize($tenancyHistory, 'index');
        /* End Authorisation */

        /* If not staff, show only limited info = start */
        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');

        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Shouldn't occur due policy, but just in case
            $tenancyHistories = NULL;
            $this->set(compact('tenancyHistories'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Show records that only belong to self
            $t_u = $this->TenancyHistories->Tenants->findByUserId($curr_user->id)->first();
            $tenancyHistories = $this->paginate(
                $this->TenancyHistories->find('all')->where(['tenant_id' => $t_u->id])
            );
            //debug($tenancyHistories); exit;
            $this->set(compact('tenancyHistories'));
        }
        else if ($amEmployee)
        {

            $this->paginate = [
                'contain' => ['Tenants'],
            ];
            $tenancyHistories = $this->paginate($this->TenancyHistories);

            $this->set(compact('tenancyHistories'));
        }
        /* If not staff, show only limited info = end*/
    }

    /**
     * View method
     *
     * @param string|null $id Tenancy History id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tenancyHistory = $this->TenancyHistories->get($id, [
            'contain' => ['Tenants'],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($tenancyHistory);
        /* End Authorisation */

        $this->set(compact('tenancyHistory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tenancyHistory = $this->TenancyHistories->newEmptyEntity();

        /* Start Authorisation */
        $this->Authorization->authorize($tenancyHistory);
        /* End Authorisation */


        if ($this->request->is('post')) {
            $tenancyHistory = $this->TenancyHistories->patchEntity($tenancyHistory, $this->request->getData());

            /* Set tenant_id to be owned by the user, if user isn't admin/staff */
            $curr_user = $this->Authentication->getIdentity();
            $trueorfalse = ($curr_user->role === 'admin') || ($curr_user->role === 'staff');
            if(
                !($trueorfalse)
            )
            {
                // Set tenant_id to be owned at own
                // $curr_user = $this->Authentication->getIdentity('id');
                $assoc_ten_id = $this->TenancyHistories->Tenants->findByUserId($curr_user->id)->first();
                $tenancyHistory->tenant_id = $assoc_ten_id->id;
                //$this->Flash->error(__('something may have gone wrong? Be sure to check for whether assigned correct user' . $tenancyHistory));
                // $this->Flash->error(__('test msg'));

            }
            /* Check end */
            if ($this->TenancyHistories->save($tenancyHistory)) {
                $this->Flash->success(__('The tenancy history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tenancy history could not be saved. Please, try again.'));
        }
        $tenants = $this->TenancyHistories->Tenants->find('list', ['limit' => 200])->all();
        $this->set(compact('tenancyHistory', 'tenants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tenancy History id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tenancyHistory = $this->TenancyHistories->get($id, [
            'contain' => [],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($tenancyHistory);
        /* End Authorisation */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tenancyHistory = $this->TenancyHistories->patchEntity($tenancyHistory, $this->request->getData());

            /* Set tenant_id to be owned by the user, if user isn't admin/staff */
            $curr_user = $this->Authentication->getIdentity();
            $trueorfalse = ($curr_user->role === 'admin') || ($curr_user->role === 'staff');
            if(
                !($trueorfalse)
            )
            {
                // Set tenant_id to be owned at own
                $curr_user = $this->Authentication->getIdentity('id');//_id = $this->Authentication->getIdentity('id');
                $assoc_ten_id = $this->TenancyHistories->Tenants->findByUserId($curr_user->id)->first();
                $tenancyHistory->tenant_id = $assoc_ten_id->id;
                //$this->Flash->error(__('something may have gone wrong? Be sure to check for whether assigned correct user' . $tenancyHistory));
                // $this->Flash->error(__('test msg'));

            }
            /* Check end */


            if ($this->TenancyHistories->save($tenancyHistory)) {
                $this->Flash->success(__('The tenancy history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tenancy history could not be saved. Please, try again.'));
        }
        $tenants = $this->TenancyHistories->Tenants->find('list', ['limit' => 200])->all();
        $this->set(compact('tenancyHistory', 'tenants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tenancy History id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tenancyHistory = $this->TenancyHistories->get($id);

        /* Start Authorisation */
        $this->Authorization->authorize($tenancyHistory);
        /* End Authorisation */

        if ($this->TenancyHistories->delete($tenancyHistory)) {
            $this->Flash->success(__('The tenancy history has been deleted.'));
        } else {
            $this->Flash->error(__('The tenancy history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


  /**
   * Uploads method
   *
   * @return \Cake\Http\Response|null|void Redirects on successful uploads, renders view otherwise.
   */

  public function uploads($id = null)
  {

    $tenancyHistory = $this->TenancyHistories->newEmptyEntity();


    $curr_id = $this->request->getAttribute('identity')->get('id');


        /* Start Authorisation */
        $this->Authorization->authorize($tenancyHistory, 'upload');
        /* End Authorisation */


    $curr_user =  $this->request->getAttribute('identity')->get('id');
    if ($this->request->is('post')) {

      $rec_letter = $this->request->getData('rec_letter');


      $prev_add = $this->request->getData('prev_add');

      $original_rec_name = $rec_letter->getClientFilename();
      $original_add_name = $prev_add->getClientFilename();

      $tenantsTable = $this->getTableLocator()->get('TenancyHistories');

      if(empty($original_rec_name) && empty($original_add_name)){
        $this->Flash->success(__('No changes were made: No documents were uploaded'));

        return $this->redirect(['controller' => 'Users', 'action' => 'profile', $curr_id]);
      }
      if(!empty($original_rec_name)){
        $rec_ext = pathinfo($rec_letter->getClientFilename(),PATHINFO_EXTENSION);

        $record = $tenantsTable->newEmptyEntity();
        $record->category = 'Letter of Recommendation';
        $record->document = 'rec_letter.pdf';





        $curr_us = $this->Authentication->getIdentity('id');//_id = $this->Authentication->getIdentity('id');
        $assoc_ten_id = $this->TenancyHistories->Tenants->findByUserId($curr_us->id)->first();
        $tena = $assoc_ten_id->id;

//        debug($tena);
        $record->tenant_id =$tena;
//        $record->tenant_id = $assoc_ten_id->id;

//        debug($record);
//        exit;


        $name = 'rec_letter.pdf';

        $folder = new Folder(RESOURCES . $curr_user . DS, true, 0755);

        $targetPath = RESOURCES . $curr_user . DS . $name;

        $delete = false;

        if(file_exists($targetPath) && $delete = false){
          unlink('rec_letter.pdf');
          $delete = true;
        }

        $rec_letter->moveTo($targetPath);

        $tenantsTable->save($record);

      }
      if(!empty($original_add_name)){

        $prev_ext = pathinfo($prev_add->getClientFilename(),PATHINFO_EXTENSION);

        $record = $tenantsTable->newEmptyEntity();

        $record->category = 'Previous Addresses';
        $record->document = 'prev_add.pdf';


//        debug($tena);
        $record->tenant_id =$tena;
//        $record->tenant_id = $assoc_ten_id->id;

//        debug($record);
//        exit;
        $name = 'prev_add.pdf';

        $folder = new Folder(RESOURCES . $curr_user . DS, true, 0755);

        $targetPath = RESOURCES . $curr_user . DS . $name;

        $delete = false;

        if(file_exists($targetPath) && $delete = false){
          unlink('prev_add.pdf');
          $delete = true;
        }

        $prev_add->moveTo($targetPath);

        $tenantsTable->save($record);
      }


      if ($tenantsTable->save($record)) {
        $this->Flash->success(__('The tenancy history has been saved.'));

        return $this->redirect(['controller' => 'Users', 'action' => 'profile', $curr_id]);
      }
      $this->Flash->error(__('The tenancy history could not be saved. Please, try again.'));

      $tenants = $this->TenancyHistories->Tenants->find('list', ['limit' => 200])->all();
      $this->set(compact('tenancyHistory', 'tenants'));

    }


  }


}
