<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 * @method \App\Model\Entity\Application[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicationsController extends AppController
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
            'contain' => ['Tenants', 'Properties'],
        ];
        /* Paginate edit end */


        $application = $this->Applications->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]
        /* Start Authorisation */
        $this->Authorization->authorize($application, 'index');
        /* End Authorisation */

        /* If not staff, show only limited info = start */
        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');

        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            $prop = $this->Applications->Properties->findByUserId($curr_user->id)->first();
            $applications = $this->paginate(
                $this->Applications->find('all')->where(['property_id' => $prop->id])
            );
            $this->set(compact('applications'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Show records that only belong to self
            $t_u = $this->Applications->Tenants->findByUserId($curr_user->id)->first();
            $applications = $this->paginate(
                $this->Applications->find('all')->where(['tenant_id' => $t_u->id])
            );
            $this->set(compact('applications'));
        }
        else if ($amEmployee)
        {

            $this->paginate = [
                'contain' => ['Tenants', 'Properties'],
            ];
            $applications = $this->paginate($this->Applications);

            $this->set(compact('applications'));
        }
        /* If not staff, show only limited info = end*/

    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => ['Tenants', 'Properties'],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($application);
        /* End Authorisation */

        $this->set(compact('application'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $application = $this->Applications->newEmptyEntity();

        /* Start Authorisation */
        $this->Authorization->authorize($application);
        /* End Authorisation */

        if ($this->request->is('post')) {
            $application = $this->Applications->patchEntity($application, $this->request->getData());

            /* Set tenant_id to be owned by the user, if user isn't admin/staff */
            $curr_user = $this->Authentication->getIdentity();
            $amemployee = ($curr_user->role === 'admin') || ($curr_user->role === 'staff');
            if(
                (!($amemployee)) &&
                ($curr_user->role === 'tenant')
            )
            {
                // Set tenant_id to be owned at own
                $curr_user = $this->Authentication->getIdentity('id');
                $assoc_ten_id = $this->Applications->Tenants->findByUserId($curr_user->id)->first();
                $application->tenant_id = $assoc_ten_id->id;

                // Defaults for landlord fields
                $application->landlord_hide = FALSE;
                $application->landlord_cancel = FALSE;
                $application->accpeted = FALSE;

            }
            /* Check end */



            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application could not be saved. Please, try again.'));
        }
        $tenants = $this->Applications->Tenants->find('list', ['limit' => 200])->all();
        $properties = $this->Applications->Properties->find('list', ['limit' => 200])->all();
        $this->set(compact('application', 'tenants', 'properties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id, [
            'contain' => [],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($application);
        /* End Authorisation */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->getData());


            /* Set tenant_id to be owned by the user, if user isn't admin/staff */
            $curr_user = $this->Authentication->getIdentity();
            $amemployee = ($curr_user->role === 'admin') || ($curr_user->role === 'staff');
            if(
                !($amemployee) &&
                ($curr_user->role === 'tenant')
            )
            {
                // Am tenant
                // Set tenant_id to be owned at own
                //$curr_user = $this->Authentication->getIdentity('id');
                $assoc_ten_id = $this->Applications->Tenants->findByUserId($curr_user->id)->first();
                $application->tenant_id = $assoc_ten_id->id;


                // Ensure old fields are old fields: property id, tenant id [already set], landlord hide, landlord cancel, accept
                $old = $this->Applications->get($application->id, [
                    'contain' => ['Tenants', 'Properties']
                ]);
                //debug($old); exit;
                $application->property_id = $old->property_id;
                $application->landlord_hide = $old->landlord_hide;
                $application->landlord_cancel = $old->landlord_cancel;
                $application->accepted = $old->accepted;

                /* Baked start */
                if ($this->Applications->save($application)) {
                    $this->Flash->success(__('The application has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
                /* Baked end */

            }
            else if(
                !($amemployee) &&
                ($curr_user->role === 'landlord')
            )
            {
                // Am landlord
                // Check if the property is owned by current user [landlord]
                //$curr_user = $this->Authentication->getIdentity('id');
                $assoc_prop = $this->Applications->Properties->findById($application->property_id)->first();
                if(
                    $assoc_prop->user_id === $curr_user->id
                )
                {

                    // Ensure old fields are old fields: property id, tenant id [already set], landlord hide, landlord cancel, accept
                    $old = $this->Applications->get($application->id, [
                        'contain' => ['Tenants', 'Properties']
                    ]);
                    //debug($old); exit;
                    $application->property_id = $old->property_id;
                    $application->tenant_id = $old->tenant_id;
                    $application->tenant_hide = $old->tenant_hide;
                    $application->tenant_cancel = $old->tenant_cancel;

                    /* baked code start */
                    if ($this->Applications->save($application)) {
                        $this->Flash->success(__('The application has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The application edit could not be saved. Please, try again.'));
                    /* baked code end */
                }
                else
                {
                    $this->Flash->error(__('Check property ownership'));
                }
            }
            else if($amemployee)
            {
                // Am employee
                /* Baked start */
                if ($this->Applications->save($application)) {
                    $this->Flash->success(__('The application has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The application could not be saved. Please, try again.'));
                /* Baked end */
            }
            /* Check end */
        }
        $tenants = $this->Applications->Tenants->find('list', ['limit' => 200])->all();
        $properties = $this->Applications->Properties->find('list', ['limit' => 200])->all();
        $this->set(compact('application', 'tenants', 'properties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($id);

        /* Start Authorisation */
        $this->Authorization->authorize($application);
        /* End Authorisation */

        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
