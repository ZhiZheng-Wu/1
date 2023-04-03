<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tenants Controller
 *
 * @property \App\Model\Table\TenantsTable $Tenants
 * @method \App\Model\Entity\Tenant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TenantsController extends AppController
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


        $tenant = $this->Tenants->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]
        /* Start Authorisation */
        $this->Authorization->authorize($tenant, 'index');
        /* End Authorisation */

        /* If not staff, show only limited info = start */
        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');

        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Shouldn't occur due policy, but just in case
            $tenants = NULL;
            $this->set(compact('tenants'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Show records that only belong to self
            $tenants = $this->paginate(
                $this->Tenants->find('all')->where(['user_id' => $curr_user->id])
            );
            $this->set(compact('tenants'));
        }
        else if ($amEmployee)
        {
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $tenants = $this->paginate($this->Tenants);
            $this->set(compact('tenants'));
        }
        /* If not staff, show only limited info = end*/

    }

    /**
     * View method
     *
     * @param string|null $id Tenant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tenant = $this->Tenants->get($id, [
            'contain' => ['Users', 'Applications'],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($tenant);
        /* End Authorisation */

        $this->set(compact('tenant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tenant = $this->Tenants->newEmptyEntity();

        /* Start Authorisation */
        $this->Authorization->authorize($tenant);
        /* End Authorisation */

        if ($this->request->is('post')) {
            $tenant = $this->Tenants->patchEntity($tenant, $this->request->getData());

            /* If it's not admin or staff, force the ID to be current users */
            $curr_user_role = $this->request->getAttribute('identity')->get('role');
            if(
                !(
                    ($curr_user_role === 'staff') ||
                    ($curr_user_role === 'admin')
                )
            )
            {
                $tenant->user_id = $this->request->getAttribute('identity')->getIdentifier();
            }
            /* Authorisation end */

            /* Ensure that the owning acc is a tenant only */
            $owner_id = $tenant->user_id;
            $owner = $this->Tenants->Users->findById($owner_id)->first();
            if
            (
                $owner->role === "tenant"
            )
            {
                /* Baked insert start */
                if ($this->Tenants->save($tenant)) {
                    $this->Flash->success(__('The tenant has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('ERROR: The tenant could not be saved. Please try again.'));
                /* Baked insert end */
            }
            else
            {
                $this->Flash->error(__('ERROR: The owner of this account is not a tenant. Please try again'));
            }
            /* Tenant role check end */
        }
        $users = $this->Tenants->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('tenant', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tenant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tenant = $this->Tenants->get($id, [
            'contain' => [],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($tenant);
        /* End Authorisation */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tenant = $this->Tenants->patchEntity($tenant, $this->request->getData());

            /* If it's not admin or staff, force the ID to be current users */
            if(
                !(
                    ($this->request->getAttribute('identity')->get('role') === 'staff') ||
                    ($this->request->getAttribute('identity')->get('role') === 'admin')
                )
            )
            {
                $tenant->user_id = $this->request->getAttribute('identity')->getIdentifier();
            }
            /* Authorisation end */


            /* Ensure that the owning acc is a tenant only */
            $owner_id = $tenant->user_id;
            $owner = $this->Tenants->Users->findById($owner_id)->first();
            if
            (
                $owner->role === "tenant"
            )
            {
                /* Baked insert start */
                if ($this->Tenants->save($tenant)) {
                    $this->Flash->success(__('The tenant has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('ERROR: The tenant could not be saved. Please try again.'));
                /* Baked insert end */
            }
            else
            {
                $this->Flash->error(__('ERROR: The owner of this account is not a tenant. Please try again'));
            }
            /* Tenant role check end */
        }
        $users = $this->Tenants->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('tenant', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tenant id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tenant = $this->Tenants->get($id);

        /* Start Authorisation */
        $this->Authorization->authorize($tenant);
        /* End Authorisation */

        if ($this->Tenants->delete($tenant)) {
            $this->Flash->success(__('The tenant has been deleted.'));
        } else {
            $this->Flash->error(__('ERROR: The tenant could not be deleted. Please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
