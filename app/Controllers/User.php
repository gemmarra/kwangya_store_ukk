<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;

class User extends BaseController
{
    public function index()
    {
        $validasiForm=[
            'search' => 'required'
        ];
        
        if($validasiForm){
        $name=$this->request->getPost('search');
        $data = [
            'page_title' => 'User',
            'UserList' => $checkRecord=$this->user->searching($name),
            'search' => '
            <div class="search">
                <form action="/user/search" method="post">
                    <input type="text" name="search" id="" placeholder="Search user name here..." autocomplete="off">
                </form>
            </div>
            '
        ];

        return view('User/select', $data);
    }
    }

    public function login(){
        return view('Auth/login');
    }

    public function auth()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $this->user->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'email'    => $data['email'],
                    'name'     => $data['name'],
                    'role'     => $data['role'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('failmessage', '<p class="failmessage">Wrong Password</p>');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('failmessage', '<p class="failmessage">Email is not found</p>');
            return redirect()->to('/');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    // public function login()
    // {
    //     $session = session();

    //     // Redirect if already logged in
    //     if ($session->get('isLoggedIn')) {
    //         return redirect()->to('/dashboard');
    //     }

    //     helper('form');

    //     if ($this->request->getMethod() === 'post') {

    //         $email = $this->request->getPost('email');
    //         $password = $this->request->getPost('password');

    //         $user = $this->user->find($email);

    //         if ($user) {
    //             if (hash('sha1', $password) === $user['password']) {
    //                 // Set user session
    //                 $session->set([
    //                     'isLoggedIn' => true,
    //                     'user' => $user
    //                 ]);

    //                 return redirect()->to('/dashboard');
    //             } else {
    //                 $session->setFlashdata('error', 'Invalid email or password');
    //             }
    //         } else {
    //             $session->setFlashdata('error', 'User not found');
    //         }
    //     }

    //     return view('Auth/login');
    // }

    // public function logout()
    // {
    //     $session = session();
    //     $session->destroy();
    //     return redirect()->to('login');
    // }

//     public function login()
// {
//     $validationRules = [
//         'email' => 'required',
//         'password' => 'required'
//     ];

//     if ($this->validate($validationRules)) {
//         $email = $this->request->getPost('email');
//         $password = $this->request->getPost('password');

//         // Assuming you're using an ORM, replace 'UserModel' with your actual model name
//         $user = $this->user->where('email', $email)->first();

//         if ($user && password_verify($password, $user['password'])) {
//             // Authentication successful

//             $userData = [
//                 'email' => $user['email'],
//                 'name' => $user['name'],
//                 'role' => $user['role'],
//                 'isLoggedIn' => true
//             ];

//             // Store user data in session
//             session()->set($userData);

//             return redirect()->to('/dashboard');
//         } else {
//             // Authentication failed
//             return redirect()->to('/')->with('failmessage', '<p class="failmessage">Password or Email is wrong!</p>');
//         }
//     }

//     return view('Auth/login');
// }

//     public function logout(){
//         session()->destroy();
//         return redirect()->to('/');
//     }

    // protected $session;

    // public function __construct()
    // {
    //     $this->session = session();
    // }

    // public function login()
    // {
    //     $data = [];
    
    //     if ($this->request->getMethod() == 'post') {
    //         $rules = [
    //             'email' => 'required|valid_email',
    //             'password' => 'required|min_length[8]'
    //         ];
    
    //         if ($this->validate($rules)) {
    //             $email = $this->request->getVar('email');
    //             $password = $this->request->getVar('password');
    
    //             $user = $this->user->findAll($email);
    
    //             if ($user && password_verify($password, $user['password'])) {
    //                 $this->session->set('user', $user);
    //                 return redirect()->to('/dashboard');
    //             } else {
    //                 $data['validation'] = $this->validator;
    //                 $data['message'] = 'Invalid email or password';
    //             }
    //         }
    //     }
    
    //     return view('login', $data);
    // }

    // public function logout()
    // {
    //     $this->session->remove('user');
    //     return redirect()->to('/');
    // }

    public function insert()
    {   
        $data = [
            'page_title' => 'Add User'
        ];
        
        return view('User/insert', $data);
    }

    public function save()
{
    // Validation rules
    $rules = [
        'email' => 'valid_email|is_unique[user.email]',
        'password' => 'min_length[8]', 
        'confirmPassword' => 'matches[password]'
    ];

    $messages = [
        'email' => [
            'valid_email' => 'Email is not valid',
            'is_unique' => 'This email has been used'
        ],
        'password' => [
            'min_length' => 'Password is too short'
        ],
        'confirmPassword' => [
            'matches' => 'Passwords do not match'
        ]
    ];

    // Validate input
    if (!$this->validate($rules, $messages)) {
        return view('User/insert', [
            'page_title' => 'Add User',
            'validation' => $this->validator
        ]);
    }

    // Prepare data to be inserted
    $data = [
        'email' => $this->request->getPost('email'),
        'name' => $this->request->getPost('name'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'role' => $this->request->getPost('role')
    ];

    // Insert user data
    $this->user->inserting($data);

    // Set flash message
    session()->setFlashdata('message', '<p class="message">Data saved</p>');

    return redirect()->to('/user/select');
}


    public function delete($email){
        		// if(session()->get('role')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }
        
        $this->user->deleting($email);
        session()->setFlashdata('message','<p class="message">Data deleted</p>');
        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be deleted</p>');
		return redirect()->to('/user/select');
    }

    
	public function edit($email)
	{
		// if(session()->get('role')!='Admin'){
		// 	return redirect()->to('tampil-product');
		// 	exit;		
		// }
		
		$syarat=[
			'email'=>$email
		];

		$data=[
            'page_title' => 'Edit User',
            'RoleList' => $this->user->findAll(),
	 		'detailuser' => $this->user->where($syarat)->findAll()
		];
		
		return view('User/edit', $data);
	}

	public function update($email)
{
        $this->user->save([
            'email'=>$email,
            'name'=>$this->request->getPost('name'),
            'password'=>$this->request->getPost('password'),
            'role'=>$this->request->getPost('role'),
            'profile_picture'=>$this->request->getPost('profile_picture')
        ]);

        session()->setFlashdata('message','<p class="message">Data updated</p>');

        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be updated</p>');

    return redirect()->to('/user/select');
}

    public function edit_password($email){
        $syarat=[
			'email'=>$email
		];

        $data = [
            'page_title' => 'Edit Password',
            'detailuser' => $this->user->where($syarat)->findAll()
        ];

        return view('User/edit_password', $data);
    }

    public function update_password($email){
        $rules = [
            'old_password_2' => 'matches[old_password_1]', 
            'new_password' => 'min_length[8]', 
            'confirmPassword' => 'matches[new_password]'
        ];

        $messages= [
            'old_password_2' => [
                'matches' => 'Old password is wrong'
            ],
            'new_password' => [
                'min_length' => 'Password is too short'
            ],
            'confirmPassword' => [
                'matches' => 'Does not match'
                ]
        ];

        $syarat=[
			'email'=>$email
		];

        if(!$this->validate($rules, $messages)) {
            return view ('User/edit_password', [
                'page_title' => 'Edit Password',
                "validation" => $this->validator,
                'detailuser' => $this->user->where($syarat)->findAll()
            ]);
        }

        $this->user->save([
            'email'=>$email,
            'password'=>$this->request->getPost('new_password')
        ]);

        session()->setFlashdata('message','<p class="message">Data updated</p>');

        session()->setFlashdata('failmessage','<p class="failmessage">Data fail to be updated</p>');

    return redirect()->to('/user/select');
    }
}
