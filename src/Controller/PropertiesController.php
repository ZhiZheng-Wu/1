<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Properties Controller
 *
 * @property \App\Model\Table\PropertiesTable $Properties
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertiesController extends AppController
{
    /* Authentication */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['details']);
        $this->Authentication->addUnauthenticatedActions(['projects']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $property = $this->Properties->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]
        /* Start Authorisation */
        $this->Authorization->authorize($property, 'index');
        /* End Authorisation */

        /* Paginate edit start */
        $paginate = [
            'contain' => ['Users'],
        ];
        /* Paginate edit end */

        /* If not staff, show only limited info = start */
        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');

        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Show properties that belong to this landlord
            $properties = $this->paginate(
                $this->Properties->find('all')->where(['user_id' => $curr_user->id, 'available' => 1])
            );
            $this->set(compact('properties'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Shouldn't occur technically - but regardless
            $properties = $this->paginate(
                $this->Properties->find('all')->where(['user_id' => $curr_user->id, 'available' => 1])
            );
            $this->set(compact('properties'));
        }
        else if ($amEmployee)
        {
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $properties = $this->Properties->find()->where(['available' => 1]);

            $this->set(compact('properties'));
        }
        /* If not staff, show only limited info = end*/
    }

    /**
     * View method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $property = $this->Properties->get($id, [
            'contain' => ['Users', 'Applications'],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($property);
        /* End Authorisation */

        $this->set(compact('property'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $property = $this->Properties->newEmptyEntity();

        /* Start Authorisation */
        $this->Authorization->authorize($property);
        /* End Authorisation */

        if ($this->request->is('post')) {
            $property = $this->Properties->patchEntity($property, $this->request->getData());
           
            /* Landlord role start */
            $owner_id = $property->user_id;
            $owner = $this->Properties->Users->findById($owner_id)->first();
            $curr_user_role = $this->request->getAttribute('identity')->get('role');
            $amemployee = ($curr_user_role === 'staff') || ($curr_user_role === 'admin');

            // If the user isn't a staff/admin, set the ID to be of current users
            if($amemployee){
                if($owner->role === "landlord") {
                    if (!$property->getErrors) {
                        
                         $property->short_description = '';
            
                        
                        $image1 = $this->request->getData('image_file');

                        $name = $image1->getClientFilename();
                        $size = $image1->getSize();

                        $targetPath = WWW_ROOT . 'images' . DS . $name;


                        //get file name +  extension in two different variables
                        $actual_name = pathinfo($name, PATHINFO_FILENAME);
                        $extension = pathinfo($name, PATHINFO_EXTENSION);

                        //check if file exists in the folder, if it does then keep increasing $i until it gets to a number which doesn't exist, then save the path for it
                        $i = 1;
                        $exist = false;
                        while (file_exists($targetPath)) {
                            $actual = (string)$actual_name . ' (' . $i . ')';
                            $name1 = $actual . '.' . $extension;
                            $targetPath = WWW_ROOT . 'images' . DS . $name1;
                            $exist = true;
                            $i++;

                        }

                        if ($name) {
                            //if file exists, append the new name and save it otherwise save the default file name
                            if ($exist) {
                                $targetPath = WWW_ROOT . 'images' . DS . $name1;
                                $image1->moveTo($targetPath);
                                $property->placeholder = $name1;

                            } else {
                                $image1->moveTo($targetPath);
                                $property->placeholder = $name;
                            }

                        }
                        /* Baked insert start */
                        if ($this->Properties->save($property)) {
                            $this->Flash->success(__('Success! The property has been saved.'));

                            return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('ERROR: The property could not be saved. Please try again.'));
                        /* Baked insert end */
                    }
                }
                else if($curr_user_role === "admin"){

                    if(!$property->getErrors) {
                        $image1 = $this->request->getData('image_file');

                        $name = $image1->getClientFilename();
                        $size = $image1->getSize();

                        $targetPath = WWW_ROOT.'images'.DS.$name;
                        
  

                        //get file name +  extension in two different variables
                        $actual_name = pathinfo($name,PATHINFO_FILENAME);
                        $extension = pathinfo($name, PATHINFO_EXTENSION);

                        //check if file exists in the folder, if it does then keep increasing $i until it gets to a number which doesn't exist, then save the path for it
                        $i = 1;
                        $exist = false;
                        while(file_exists($targetPath))
                        {
                            $actual = (string)$actual_name.' (' . $i . ')';
                            $name1 = $actual.'.'.$extension;
                            $targetPath = WWW_ROOT.'images'.DS.$name1;
                            $exist = true;
                            $i++;

                        }
            
                        if($name){
                            //if file exists, append the new name and save it otherwise save the default file name
                            if($exist){
                                $targetPath = WWW_ROOT.'images'.DS.$name1;
                                $image1->moveTo($targetPath);
                                $property->placeholder = $name1;

                            }else{
                                $image1->moveTo($targetPath);
                                $property->placeholder = $name;
                            }

                        }

                        /* Baked insert start */
                            if ($this->Properties->save($property)) {
                                $this->Flash->success(__('Success! The property has been saved.'));

                                return $this->redirect(['action' => 'index']);
                            }
                            $this->Flash->error(__('ERROR: The property could not be saved. Please try again.'));
                            /* Baked insert end */

                    }
                }
                else{
                    $this->Flash->error(__('ERROR: The owner of this account is not a landlord. Please try again'));
                }
            }
            else{
                // Not a staff member: set property user_ID to be the users
                $property->user_id = $this->request->getAttribute('identity')->get('id');
                /* Baked insert start */
                if ($this->Properties->save($property)) {
                    $this->Flash->success(__('Success! The property has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('ERROR: The property could not be saved. Please try again.'));
                /* Baked insert end */
            }
// Slight leakable code below: can reuse for other thins
            /*
                    if
                    (
                        $owner->role === "landlord"
                    )
                    {

                        // If the user isn't a staff/admin, set the ID to be of current users
                        if(
                            !(
                                $amemployee
                            )
                        )
                        {
                            $property->user_id = $this->request->getAttribute('identity')->get('id');
                        }

                        // Baked insert start
                                if ($this->Properties->save($property)) {
                                    $this->Flash->success(__('The property has been saved.'));

                                    return $this->redirect(['action' => 'index']);
                                }
                                $this->Flash->error(__('The property could not be saved. Please, try again.'));
                        // Baked insert end
                    }
                    else
                    {
                        // Reducing possible info exposures
                        if($amemployee)
                        {
                            $this->Flash->error(__('Owner account is not landlord, check again'));
                        }
                        else
                        {
                            $this->Flash->error(__('Something went wrong: try again'));
                        }
                    }
            */
            /* Landlord role end */
        }
        $users = $this->Properties->Users->find('list', ['limit' => 200, 'conditions' => ['Users.role =' => 'landlord']])->all();
//            ->where(['Users.role' => 'landlord']);
        $this->set(compact('property', 'users'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $property = $this->Properties->get($id, [
            'contain' => [],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($property);
        /* End Authorisation */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $property = $this->Properties->patchEntity($property, $this->request->getData());

            /* Landlord role start */
            $owner_id = $property->user_id;
            $owner = $this->Properties->Users->findById($owner_id)->first();
            $curr_user_role = $this->request->getAttribute('identity')->get('role');
            $amemployee = ($curr_user_role === 'staff') || ($curr_user_role === 'admin');
            // If the user isn't a staff/admin, set the ID to be of current users
            if($amemployee)
            {
                if
                (
                    $owner->role === "landlord"
                )
                {
                    /* Baked insert start */
                    if ($this->Properties->save($property)) {
                        $this->Flash->success(__('Success! The property has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('ERROR: This property could not be saved. Please try again.'));
                    /* Baked insert end */
                }
                else
                {
                    $this->Flash->error(__('ERROR: The property is not owned by a landlord, please make sure the correct landlord is correct'));
                }
            }
            else
            {
                // Not a staff member: set property user_ID to be the users
                $property->user_id = $this->request->getAttribute('identity')->get('id');
                /* Baked insert start */
                if ($this->Properties->save($property)) {
                    $this->Flash->success(__('Success! The property has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('ERROR: The property could not be saved. Please try again.'));
                /* Baked insert end */
            }
            /*
                    if
                    (
                        $owner->role === "landlord"
                    )
                    {

                        // If the user isn't a staff/admin, set the ID to be of current users
                        if(
                            !(
                                $amemployee
                            )
                        )
                        {
                            $property->user_id = $this->request->getAttribute('identity')->get('id');
                        }
                        // Baked insert start
                                if ($this->Properties->save($property)) {
                                    $this->Flash->success(__('The property has been saved.'));

                                    return $this->redirect(['action' => 'index']);
                                }
                                $this->Flash->error(__('The property could not be saved. Please, try again.'));
                        // Baked insert end
                    }
                    else
                    {
                        // Reducing possible info exposures
                        if($amemployee)
                        {
                            $this->Flash->error(__('Owner account is not landlord, check again'));
                        }
                        else
                        {
                            $this->Flash->error(__('Something went wrong: try again'));
                        }
                    }
            */
            /* Landlord role end */
        }
        $users = $this->Properties->Users->find('list', ['limit' => 200, 'conditions' => ['Users.role =' => 'landlord']] )->all();
        $this->set(compact('property', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $property = $this->Properties->get($id);

        /* Start Authorisation */
        $this->Authorization->authorize($property);
        /* End Authorisation */

        if ($this->Properties->delete($property)) {
            $this->Flash->success(__('The property has been deleted.'));
        } else {
            $this->Flash->error(__('ERROR: The property could not be deleted. Please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function projects()
    {
        $this->Authorization->skipAuthorization();


        // Retrieving all data from table
//        $properties = $this->Properties->find();
//
//        $this->set(compact('properties'));

        $suburb = $this->request->getQuery('suburb');
        $room_min = $this->request->getQuery('room_min');
        $room_max = $this->request->getQuery('room_max');
        $price_min = $this->request->getQuery('price_min');
        $price_max = $this->request->getQuery('price_max');



        if($suburb or $price_min or $price_max or $room_min or $room_max){
            $query = $this->Properties->find()->where(['available' => 1])->limit(3);

            $query->where(
                function ($exp, $query) use($suburb,$price_min,$price_max,$room_min,$room_max) {

                    $cond1 = 'Properties.suburb';
                    $cond2 = 'Properties.weekly_rent';
                    $cond3 = 'Properties.number_of_bedrooms';


                    if($price_min == ''){
                        $price_min= '0';
                    }

                    if($price_max == ''){
                        $price_max= '9999';
                    }

                    if($room_min == ''){
                        $room_min= '0';
                    }

                    if($room_max == ''){
                        $room_max= '99';
                    }


//                    return $exp->or([])
//                        ->like($concat, $search)
//                        ->like($cond2, $search)
//                        ->like($cond3, $search)
//                        ->like($cond4, $search);

                    if(empty($suburb)){
                        return $exp->and([])
                            ->gte($cond2, $price_min)
                            ->lte($cond2, $price_max)
                            ->gte($cond3, $room_min)
                            ->lte($cond3, $room_max);
                    }
                    else{
                        return $exp->and([])
                            ->like($cond1, $suburb)
                            ->gte($cond2, $price_min)
                            ->lte($cond2, $price_max)
                            ->gte($cond3, $room_min)
                            ->lte($cond3, $room_max);
                    }
                });
        }
        else{
            $query = $this->Properties->find()->where(['available' => 1])->limit(3);
        }
        $properties = $this->paginate($query);
        $this->set(compact('properties'));


        // Keeping this for reference

//            $concat = $query->func()->concat([
//                'Properties.first_name' => 'identifier',
//                ' ',
//                'Properties.last_name' => 'identifier'
//            ]);
//
//            if($search){
//                $query = $this->Documents->find('all')
//                    ->where(['Or'=>['Documents.type like' => '%'.$search.'%',
//                        'Documents.files like' => '%'.$search.'%',
//                        'Documents.comment like' => '%'.$search.'%']]);
//            }
//            else{
//                $query = $this ->Documents;
//            }
    }

    /**
     * Archives method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function archives()
    {
        $property = $this->Properties->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]
        /* Start Authorisation */
        $this->Authorization->authorize($property, 'index');
        /* End Authorisation */

        /* Paginate edit start */
        $paginate = [
            'contain' => ['Users'],
        ];
        /* Paginate edit end */

        /* If not staff, show only limited info = start */
        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');

        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Show properties that belong to this landlord
            $properties = $this->paginate(
                $this->Properties->find('all')->where(['user_id' => $curr_user->id,'available' => 0])
            );
            $this->set(compact('properties'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Shouldn't occur technically - but regardless
            $properties = $this->paginate(
                $this->Properties->find('all')->where(['user_id' => $curr_user->id, 'available' => 0])
            );
            $this->set(compact('properties'));
        }
        else if ($amEmployee)
        {
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $properties = $this->Properties->find()->where(['available' => 0]);

            $this->set(compact('properties'));
        }
        /* If not staff, show only limited info = end*/
    }

    public function viewFile($filename){
        $property = $this->Properties->newEmptyEntity(); // Required to ensure authorisation can work [needs defined 1st]

        /* Start Authorisation */
        $this->Authorization->authorize($property, 'view');
        /* End Authorisation */

        $path  = WWW_ROOT.'images'.DS.$filename;

        if (!(file_exists(WWW_ROOT.'images'.DS.$filename))){
            $this->Flash->error(__('ERROR: The document does not exist. Please try again.'));
            return $this->redirect(['action' => 'view']);
        }
        $response = $this->response->withFile(

            $path
        );

        return $response;
    }

    public function landlord($id = null)
{
    $this->Authorization->skipAuthorization();
    
    $user = $this->loadModel('Users')->get($id, [
        'contain' => ['Properties', 'Tenants'],
    ]);

    $this->set(compact('user'));
}

        public function details($id = null)
    {
        $this->Authorization->skipAuthorization();


        $property = $this->Properties->get($id, [
            'contain' => ['Users', 'Applications'],
        ]);

        $this->set('property', $property);

        // Get the user_id of the landlord
        $landlord_id = $property->user_id;
    
        // Pass the landlord_id to the landlordProfile view
        $this->set('landlord_id', $landlord_id);

        $this->set(compact('property'));
    }

    public function membership()
{
    $this->Authorization->skipAuthorization();


    // Retrieving all data from table
//        $properties = $this->Properties->find();
//
//        $this->set(compact('properties'));

    $suburb = $this->request->getQuery('suburb');
    $room_min = $this->request->getQuery('room_min');
    $room_max = $this->request->getQuery('room_max');
    $price_min = $this->request->getQuery('price_min');
    $price_max = $this->request->getQuery('price_max');



    if($suburb or $price_min or $price_max or $room_min or $room_max){
        $query = $this->Properties->find()->where(['available' => 1]);

        $query->where(
            function ($exp, $query) use($suburb,$price_min,$price_max,$room_min,$room_max) {

                $cond1 = 'Properties.suburb';
                $cond2 = 'Properties.weekly_rent';
                $cond3 = 'Properties.number_of_bedrooms';


                if($price_min == ''){
                    $price_min= '0';
                }

                if($price_max == ''){
                    $price_max= '9999';
                }

                if($room_min == ''){
                    $room_min= '0';
                }

                if($room_max == ''){
                    $room_max= '99';
                }


//                    return $exp->or([])
//                        ->like($concat, $search)
//                        ->like($cond2, $search)
//                        ->like($cond3, $search)
//                        ->like($cond4, $search);

                if(empty($suburb)){
                    return $exp->and([])
                        ->gte($cond2, $price_min)
                        ->lte($cond2, $price_max)
                        ->gte($cond3, $room_min)
                        ->lte($cond3, $room_max);
                }
                else{
                    return $exp->and([])
                        ->like($cond1, $suburb)
                        ->gte($cond2, $price_min)
                        ->lte($cond2, $price_max)
                        ->gte($cond3, $room_min)
                        ->lte($cond3, $room_max);
                }
            });
    }
    else{
        $query = $this->Properties->find()->where(['available' => 1]);
    }
    $properties = $this->paginate($query);
    $this->set(compact('properties'));


    // Keeping this for reference

//            $concat = $query->func()->concat([
//                'Properties.first_name' => 'identifier',
//                ' ',
//                'Properties.last_name' => 'identifier'
//            ]);
//
//            if($search){
//                $query = $this->Documents->find('all')
//                    ->where(['Or'=>['Documents.type like' => '%'.$search.'%',
//                        'Documents.files like' => '%'.$search.'%',
//                        'Documents.comment like' => '%'.$search.'%']]);
//            }
//            else{
//                $query = $this ->Documents;
//            }
}

        
}

