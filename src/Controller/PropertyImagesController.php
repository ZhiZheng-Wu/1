<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PropertyImages Controller
 *
 * @property \App\Model\Table\PropertyImagesTable $PropertyImages
 * @method \App\Model\Entity\PropertyImage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyImagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $propertyImage = $this->PropertyImages->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]
        /* Start Authorisation */
        $this->Authorization->authorize($propertyImage, 'index');
        /* End Authorisation */

        /* Paginate edit start */
        $paginate = [
            'contain' => ['Properties'],
        ];
        /* Paginate edit end */

        /* If not staff, show only limited info = start */
        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');

        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Doesn't fully work correctly at the mo
            $prop = $this->PropertyImages->Properties->findByUserId($curr_user->id)->first();
            $propertyImages = $this->paginate(
                $this->PropertyImages->find('all')->where(['property_id' => $prop->id])
            );
            /*
            // Doesn't work at all
            $prop = $this->PropertyImages->Properties->findByUserId($curr_user->id)->select('Properties.id')->toList();
            //debug($prop); exit;
            $propertyImages = $this->paginate(
                $this->PropertyImages->find('all')->where(['property_id IN' => $prop->id])
            );
            */
            $this->set(compact('propertyImages'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Shouldn't occur due policy, but just in case
            $propertyImages = NULL;
            $this->set(compact('propertyImages'));
        }
        else if ($amEmployee)
        {
            $propertyImages = $this->paginate($this->PropertyImages);

            $this->set(compact('propertyImages'));
        }
        /* If not staff, show only limited info = end*/

    }

    /**
     * View method
     *
     * @param string|null $id Property Image id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $propertyImage = $this->PropertyImages->get($id, [
            'contain' => ['Properties'],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($propertyImage);
        /* End Authorisation */

        $this->set(compact('propertyImage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $propertyImage = $this->PropertyImages->newEmptyEntity();

        /* Start Authorisation */
        $this->Authorization->authorize($propertyImage);
        /* End Authorisation */

        if ($this->request->is('post')) {
            $propertyImage = $this->PropertyImages->patchEntity($propertyImage, $this->request->getData());

            /* landlord role check start */
            $curr_user = $this->Authentication->getIdentity();
            $amEmployee = ($curr_user->role === 'admin') || ($curr_user->role === 'staff');
            if(
                !($amEmployee)
            )
            {
                // If property isn't owned by current user, remove it
                //debug($propertyImage->property_id); exit;
                $assoc_prop = $this->PropertyImages->Properties->findById($propertyImage->property_id)->first();
                //debug($assoc_prop); exit;
                if(
                    $assoc_prop->user_id === $curr_user->id
                )
                {
                    /* baked code start */
                    if ($this->PropertyImages->save($propertyImage)) {
                        $this->Flash->success(__('The property image has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('ERROR: The property image could not be saved. Please try again.'));
                    /* baked code end */
                }
                else
                {
                    $this->Flash->error(__('Check property ownership'));
                }

            }
            else
            {

                /* baked code start */
                if ($this->PropertyImages->save($propertyImage)) {
                    $this->Flash->success(__('The property image has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('ERROR: The property image could not be saved. Please try again.'));
                /* baked code end */
            }
            /* landlord role check end */
        }
        $properties = $this->PropertyImages->Properties->find('list', ['limit' => 200])->all();
        $this->set(compact('propertyImage', 'properties'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Property Image id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propertyImage = $this->PropertyImages->get($id, [
            'contain' => [],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($propertyImage);
        /* End Authorisation */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyImage = $this->PropertyImages->patchEntity($propertyImage, $this->request->getData());

            /* landlord role check start */
            $curr_user = $this->Authentication->getIdentity();
            $amEmployee = ($curr_user->role === 'admin') || ($curr_user->role === 'staff');
            if(
                !($amEmployee)
            )
            {
                // If property isn't owned by current user, prevent data entry
                $assoc_prop = $this->PropertyImages->Properties->findById($propertyImage->property_id)->first();
                if(
                    $assoc_prop->user_id === $curr_user->id
                )
                {
                    /* baked code start */
                    if ($this->PropertyImages->save($propertyImage)) {
                        $this->Flash->success(__('The property image has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('ERROR: The property image could not be saved. Please try again.'));
                    /* baked code end */
                }
                else
                {
                    $this->Flash->error(__('Check property ownership'));
                }
            }
            else
            {
                /* baked code start */
                if ($this->PropertyImages->save($propertyImage)) {
                    $this->Flash->success(__('The property image has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The property image could not be saved. Please, try again.'));
                /* baked code end */
            }
            /* landlord role check end */
        }
        $properties = $this->PropertyImages->Properties->find('list', ['limit' => 200])->all();
        $this->set(compact('propertyImage', 'properties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Image id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyImage = $this->PropertyImages->get($id);

        /* Start Authorisation */
        $this->Authorization->authorize($propertyImage);
        /* End Authorisation */

        if ($this->PropertyImages->delete($propertyImage)) {
            $this->Flash->success(__('The property image has been deleted.'));
        } else {
            $this->Flash->error(__('ERROR: The property image could not be deleted. Please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
