<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{



    /* Start Authentication */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
        $this->Authentication->addUnauthenticatedActions(['view']);
        $this->Authentication->addUnauthenticatedActions(['landlord']);
        $this->Authentication->addUnauthenticatedActions(['resetpassword']);
        $this->Authentication->addUnauthenticatedActions(['forgotpassword']);
    }
    /* End Authentication */

    public function forgotpassword()
    {
        $null = false;
        /* Start Authorisation */
        $this->Authorization->skipAuthorization();
        /* End Authorisation */
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $token = Security::hash(Security::randomBytes(25));

            $userTable = TableRegistry::get('Users');
            if ($email == NULL) {
                $this->Flash->error(__('Please insert your email address'));
                $null = true;
            }
            if	($user = $userTable->find('all')->where(['email'=>$email])->first()) {
                $user->verification_notes = $token;
                if ($userTable->save($user)){

                    $url = Router::url(
                        ['controller' => 'Users', 'action' => 'resetpassword',$token],
                        true
                    );
                    /* Commenting out the Mailer() version as setSender() seems to default to you@localhost sender [via the cPanel envir] when used with cPanel
                    $mailer = new Mailer('default');
                    $mailer->setTransport('mailtrap'); // Comment this line out to use the default email setup
                    //Commented out Zohaibs defaults, trying to get it to work on cPanel. See https://trello.com/c/PxlFml9P
                    /*$mailer->setSender('devtestattempt@dev.u22s1019.monash-ie.me','The Perfect Landlord - System')//('bob@mailtrap.io', 'Bob from Mailtrap')
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Forgot Password Request')
                        ->deliver('Hello<br/>Please click link below to reset your password<br/><br/><a href="'.$url.'">Reset Password</a>');*/
                    $mailer = new Email('default');
                    $mailer->setFrom(['3048.Team102@gmail.com' => 'The Perfect Landlord'])
                    ->setTo($email)
                    ->setEmailFormat('html')
                    ->setSubject('Forgot Password Request')
                    ->send('Hello<br/>Please click link below to reset your password<br/><br/><a href="'.$url.'">Reset Password</a><br/><br/>This email address is automated & unmonitored: do not reply to this email');

                }
                $this->Flash->success('Reset password link has been sent to your email ('.$email.'), please check your email');
                return $this->redirect(['controller' => 'Pages', 'action' => 'resetsuccess']);
            }
            if	(($total = $userTable->find('all')->where(['email'=>$email])->count()==0) && ($null != true)) {
                $this->Flash->error(__('Email is not registered in system'),'default', ['class' => 'notification'], 'notification');
            }
        }
    }

    public function resetsuccess(){
        /* Start Authorisation */
        $this->Authorization->skipAuthorization();
        /* End Authorisation */
    }

    public function resetpassword($token)
    {
        /* Start Authorisation */
        $this->Authorization->skipAuthorization();
        /* End Authorisation */
        if($this->request->is('post')){
            $hasher = new DefaultPasswordHasher();
            $pass = $this->request->getData('password');

            $userTable = TableRegistry::get('Users');

            $user = $userTable->find()->where(['verification_notes'=>$token])->first();
            $user->password = $pass;



            if ($userTable->save($user)) {

                $this->Flash->success('Password successfully reset. Please login using your new password');
                return $this->redirect(['action'=>'login']);
            }
        }
    }


    /* Paginate edit start */
    /*
    public $paginate = [
        'User' => [],
    ];
    */
    /* Paginate edit end */


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        /* Paginate edit start */
        $paginate = [
            'User' => [],
        ];
        /* Paginate edit end */


        $user = $this->Users->newEmptyEntity(); // Required to ensure authorisation can work with a user
        /* Start Authorisation */
        $this->Authorization->authorize($user, 'index');
        /* End Authorisation */

        /* If not staff, show only limited info = start */


        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');
        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Show records that are only belong to tenant roles - currently not using
            /*
            $users = $this->paginate(
                $this->Users->find('all')->where(['role' => 'tenant'])
            );
            $this->set(compact('users'));
            */
            $users = $this->paginate(
                $this->Users->find('all')->where(['id' => $curr_user->id])
            );
            $this->set(compact('users'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Show records that only belong to self
            $users = $this->paginate(
                $this->Users->find('all')->where(['id' => $curr_user->id])
            );
            $this->set(compact('users'));
        }

        elseif ($amEmployee)
        {
            /* If not staff, show only limited info = end*/
            //debug($users); exit;
            $users = $this->Users->find()->where(['site_access' => 1]);
            $this->set(compact('users'));
        }
        /* If not staff, show only limited info = end*/

    }


    /**
     * Archive method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function archives()
    {
        /* Paginate edit start */
        $paginate = [
            'User' => [],
        ];
        /* Paginate edit end */


        $user = $this->Users->newEmptyEntity(); // Required to ensure authorisation can work with a user
        /* Start Authorisation */
        $this->Authorization->authorize($user, 'index');
        /* End Authorisation */

        /* If not staff, show only limited info = start */


        $curr_user = $this->request->getAttribute('identity');
        $amEmployee = ($curr_user->role === 'staff') || ($curr_user->role === 'admin');
        if( !($amEmployee) && ($curr_user->role === 'landlord') )
        {
            // Show records that are only belong to tenant roles - currently not using
            /*
            $users = $this->paginate(
                $this->Users->find('all')->where(['role' => 'tenant'])
            );
            $this->set(compact('users'));
            */
            $users = $this->paginate(
                $this->Users->find('all')->where(['id' => $curr_user->id])
            );
            $this->set(compact('users'));
        }
        else if ( !($amEmployee) && ($curr_user->role === 'tenant') )
        {
            // Show records that only belong to self
            $users = $this->paginate(
                $this->Users->find('all')->where(['id' => $curr_user->id])
            );
            $this->set(compact('users'));
        }

        elseif ($amEmployee)
        {
            /* If not staff, show only limited info = end*/
            //debug($users); exit;
            $users = $this->Users->find()->where(['site_access' => 0]);
            $this->set(compact('users'));
        }
        /* If not staff, show only limited info = end*/

    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $user = $this->Users->get($id, [
            'contain' => ['Properties', 'Tenants'],
        ]);
        $this->set(compact('user'));
    }

  /**
   * Profile method
   *
   * @param string|null $id User id.
   * @return \Cake\Http\Response|null|void Renders profile
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function profile($id = null)
  {

    $user = $this->Users->get($id, [
      'contain' => ['Properties', 'Tenants'],
    ]);

        /* Start Authorisation */
        $this->Authorization->authorize($user, 'profile');
        /* End Authorisation */

    $this->set(compact('user'));
  }

  public function landlord($id=null)
  {
    $this->Authorization->skipAuthorization();
    $user = $this->Users->get($id, [
        'contain' => ['Properties', 'Tenants'],
    ]);
    $this->set(compact('user'));
  }
  
  /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user = $this->Users->newEmptyEntity();

        /* Start Authorisation */
        $this->Authorization->authorize($user);
        /* End Authorisation */

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
          $weekly_budget = 0;
          $moving_date = "2000-10-13";
/* Customised Add authorisation scenario start */
if
(
	// Either Admin user, or Staff user creating Landlord/Tenant accs
	(
		$this->request->getAttribute('identity')->get('role') === 'admin'
	) ||
	(
		($this->request->getAttribute('identity')->get('role') === 'staff') &&
		(
			($user->get('role') === 'landlord') ||
			($user->get('role') === 'tenant')
		)
	)
)
{
	// Create the acc
	if($this->Users->save($user))
	{
		// Save the record
                        // Imported from Zohaib's previous implementation
                        if($user->role === 'tenant')
                        {
                            $tenantsTable = $this->getTableLocator()->get('Tenants');
                            $newTenant = $tenantsTable->newEmptyEntity();
                            $newTenant->user_id = $user->id;
                            $newTenant->weekly_budget = $weekly_budget;
                            $newTenant->moving_date = $moving_date;

                            $newTenant->hidden = 1;


                            $tenantsTable->save($newTenant);
                        }
		$this->Flash->success(__('The user has been saved.'));
		return $this->redirect(['action' => 'index']);
	}
	$this->Flash->error(__('ERROR: The user could not be saved. Please try again.'));
}
else
{
	$this->Flash->error('You do not have right to add this account role');
}
} // Closing the *if ($this->request->is('post'))* IF condition: indentation left here to avoid proof reading issues
$this->set(compact('user'));
/* Customised Add authorisation scenario end */
    } // Add method end point

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        /* Start Authorisation */
        $this->Authorization->authorize($user);
        /* End Authorisation */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            /* Authorisation start: If it's not admin or staff, force the role to be previous */
            if(
                !(
                    ($this->request->getAttribute('identity')->get('role') === 'staff') ||
                    ($this->request->getAttribute('identity')->get('role') === 'admin')
                )
            )
            {
                if( $this->request->getAttribute('identity')->get('role') === 'landlord' )
                {
                    // Force it to stay landlord
                    $user->role = 'landlord';
                }
                else
                {
                    // Assume tenant acc
                    $user->role = 'tenant';
                }
            }


            /* Authorisation end */

            if ($this->Users->save($user)) {
                //$this->Flash->success(__('The user has been saved.'));
                $this->Flash->success('The user has been saved.');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ERROR: The user could not be saved. Please try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        /* Start Authorisation */
        $this->Authorization->authorize($user);
        /* End Authorisation */

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('ERROR: The user could not be deleted. Please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /* Start Authentication */
    public function login()
    {
        /* Start Authorisation */
        $this->Authorization->skipAuthorization();
        /* End Authorisation */

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /Users after login success
            if(($this->request->getAttribute('identity')->get('role') === 'staff') ||
            ($this->request->getAttribute('identity')->get('role') === 'admin'))
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'index',
            ]);
            else(
                $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Pages',
                'action' => 'tenantshome',
            ]));

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }
    public function logout()
    {
        /* Start Authorisation */
        $this->Authorization->skipAuthorization();
        /* End Authorisation */

        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success('You are now logged out');
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
    }
    /* End Authentication */
    
    public function viewPropertiesByUser($user_id)
    {
        $properties = $this->Property->find('all', [
            'conditions' => ['Property.user_id' => $user_id]
        ]);
    
        $this->set(compact('properties'));
    }
    
}
