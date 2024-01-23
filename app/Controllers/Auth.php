<?php 

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use App\Libraries\Hash;
use CodeIgniter\Exceptions\PageNotFoundException;


class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('templates/head', $data)
            .view('templates/navbar')
            . view('auth/login')
            . view('templates/footer');
    }

    public function check() {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => "Email Field Required",
                    'valid_email' => "Not a valid email",
                    'is_not_unique' => "Email not registered",
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Password Field Required"
                ]
            ],
        ]);
        if(!$validation) {
            $data = [
                'title' => 'Login',
            ];
            return view('templates/head', $data)
            .view('templates/navbar')
            . view('auth/login', ['validation' => $this->validator])
            . view('templates/footer'); 
        }
        else {

            auth()->logout();

            $credentials = [
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password')
            ];

            $loginAttempt = auth()->remember()->attempt($credentials);

            if (! $loginAttempt->isOK()) {
                return redirect()->back()->with('error', $loginAttempt->reason());
            }

            if ($loginAttempt->isOK()) {
                $user = $loginAttempt->extraInfo();
                return redirect()->to("news/lista");
            }

        }

           /*  
           //----Sin usar Shield--//
           // Get the User Provider (UserModel by default)
            $users = auth()->getProvider();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $userModel = new UserModel();
            $userInfo = $userModel->where('email_usr', $email)->first();
            $checkPassword = password_verify(strval($password), $userInfo['password_usr']);
            if(!$checkPassword) {
                session()->setFlashdata('fail', 'Incorrect password');
                return redirect()->to('login')->withInput();
            } else {
                $loggedUserId = $userInfo['id_usr'];
                $loggedUserName = $userInfo['firstname_usr'];

                session()->set('loggedUserId' , $loggedUserId);
                session()->set('loggedUserFullName' , $loggedUserName);

                session()->setFlashdata('success', 'Login success');
                return redirect()->to('news/lista')->withInput();
            } */        
    }

    public function register()
    {
        $data = [
            'title' => 'Registration',
        ];
        return view('templates/head', $data)
        .view('templates/navbar')
        . view('auth/register')
        . view('templates/footer');
    }

    public function save() {
        $validation = $this->validate([
            'userName' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Username Field Required"
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => "Email Field Required",
                    'valid_email' => "Please add a valid email",
                    'is_unique' => "Email already exist",
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[72]|strong_password',
                'errors' => [
                    'required' => "Password Field Required",
					'min_length[6]' => "Minimum length 6 characters"
                ]
            ],
        ]);
        if(!$validation) {
            $data = [
                'title' => 'Register',
            ];
            return view('templates/head', $data)
            .view('templates/navbar')
            . view('auth/register', ['validation' => $this->validator])
            . view('templates/footer'); 
        } 
        else {
            // Get the User Provider (UserModel by default)
            $users = auth()->getProvider();

            $user = new User([
                'username' => $this->request->getPost('userName'),
                'email'    =>  $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);

            $users->save($user);

            // To get the complete user object with ID, we need to get from the database
            $user = $users->findById($users->getInsertID());

            // Add to default group
            $users->addToDefaultGroup($user);

        }
    }

    public function logout() {
        if (auth()->loggedIn()) {
            auth()->logout();
        }        
        return redirect()->to('news/lista');
    }

    public function profile(){
        $user = auth()->user();
        if($user){
            $user_lastname = "Not defined";
            if(auth()->user()->lastname){$user_lastname = auth()->user()->lastname;};
            $data = ["title" => "profile",
                "user" => ["username" => auth()->user()->username,
                "lastname" => $user_lastname,
                "email" => auth()->user()->email],
            ];

            return view('templates/head', $data)
            .view('templates/navbar')
            . view('auth/profile')
            . view('templates/footer'); 
        }
        else{
            return redirect()->to("login");
        }
    }




}