<?php 

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\Hash;
use CodeIgniter\Exceptions\PageNotFoundException;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

	public function register()
    {
        return view('auth/register');
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
                'rules' => 'required|valid_email|is_unique[user_usr.email_usr]',
                'errors' => [
                    'required' => "Email Field Required",
                    'valid_email' => "Please add a valid email",
                    'is_unique' => "Email already exist",
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[255]',
                'errors' => [
                    'required' => "Password Field Required",
					'min_length[6]' => "Minimum length 6 characters"
                ]
            ],
        ]);
        if(!$validation) {
            return view('user/register', ['validation' => $this->validator]);
        } else {
            $userName = $this->request->getPost('userName');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $values = [
                'firstname_usr' => $userName,
                'email_usr' => $email,/* 
                'password_usr' => password_hash($email, PASSWORD_BCRYPT), */
            ];

            $userModel = new UserModel();
            $query = $userModel->insert($values);
            if(!$query) {
                return redirect()->back()->with('fail', "Something went wrong");
            } else {
                return redirect()->to('users')->with('success', "Account created successfully");
            }
        }
    }

	public function check() {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[user_usr.email_usr]',
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
            return view('auth/login', ['validation' => $this->validator]);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $userModel = new UserModel();
            $userInfo = $userModel->where('email_usr', $email)->first();
/*             $checkPassword = password_verify($password, $userInfo['password_usr']);
            if(!$checkPassword) {
                session()->setFlashdata('fail', 'Incorrect password');
                return redirect()->to('auth')->withInput();
            } else {
                $loggedUserId = $userInfo['id_usr'];
                $loggedUserFullName = $userInfo['firstname_usr'].' '.$userInfo['lastname_usr'];

                session()->set('loggedUserId' , $loggedUserId);
                session()->set('loggedUserFullName' , $loggedUserFullName);

                session()->setFlashdata('success', 'Login success');
                return redirect()->to('news/lista')->withInput();
            } */
        }
    }

	public function logout() {
        if(session()->has('loggedUserId')) {
            session()->remove('loggedUserId');
            return redirect()->to('auth')->with('fail', "You are logged out.");
        }
    }

    public function login(){
        return view("auth/login");
    }

    public function pruebas(){
        $data = [
            'title' => 'News archive',
        ];
        return view('templates/head', $data)
            .view('templates/navbar')
            . view('auth/login')
            . view('templates/footer');
    }
}




   
