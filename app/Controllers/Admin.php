<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\NaftemporikiModel;
use App\Libraries\Hash;

class Admin extends BaseController
{
    
      
        //Enabling features 
    public function __construct()
    {
        helper(['url','form']); 
    }
      

     //Responsible for login page view 
     public function login()
    {
        return view('admin/login'); 
    }

    // //Responsible for dashboard page view 
    public function dashboard() {
        $model = new NaftemporikiModel();
        $newsItems = $model->getAllNews(); 
        return view('admin/dashboard', ['news' => $newsItems]);
    }




    public function loginAdmin() {
        helper(['form']);

        $validation = \Config\Services::validation();

        $validated = $this->validate([
            'username' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Your  username is required', 
                ], 
                ],
                'password' => [
                    'rules' => 'required|min_length[5]|max_length[20]', 
                    'errors' => [
                        'required' => 'Your password is required',
                        'min_length' => 'Password must be 5 characters long', 
                        'max_length' => 'Password cannot be longer than 20 characters ' 
                    ], 
                    ], 

                ]); 

                
                if(!$validated) {
                    // return view('admin/login',['validation' => $this->validator]); 
                    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                }
                 
                 else {

                    $username = $this->request->getPost('username'); 
                    $password = $this->request->getPost('password');


                    $adminModel = new AdminModel(); 

                    $adminInfo = $adminModel->where('username',$username)->first();

                    if ($adminInfo !== null) {
                        $checkPassword = password_verify($password, $adminInfo['password']);
                    
                        if (!$checkPassword) {
                            //password is wrong
                            session()->setFlashdata('fail', 'Incorrect password provided');
                            return redirect()->to('admin/login');
                        } else {
                            //Process admin info
                               $adminId = $adminInfo['id']; 

                            session()->set('loggedInAdmin', $adminId); 
                            return redirect()->to('admin/dashboard'); 
                        }
                    }   else {
                        // admin does not exist
                        session()->setFlashdata('fail', 'No admin found with that username');
                        return redirect()->to('admin/login');


                        
                    }
                                
                }

                 }



                 public function read($Id)
                 {
                     // Fetch the news item using the ID
                     $newsModel = new \App\Models\NaftemporikiModel();
                     $newsItem = $newsModel->find($Id);
             
                     // Check if the news item exists
                     if (!$newsItem) {
                         throw new \CodeIgniter\Exceptions\PageNotFoundException('News Item Not Found');
                     }
             
                     // Load the view and pass the news item data
                     return view('admin/readNews', ['newsItem' => $newsItem]);
                 }


                 public function confirmDelete($Id)
                 {
                     $newsModel = new \App\Models\NaftemporikiModel();
                     $newsItem = $newsModel->find($Id);

                    if (!$newsItem) {
                         return redirect()->to('admin/dashboard')->with('message', 'News item not found.');
                    }

                    return view('admin/confirmDelete', ['newsItem' => $newsItem]);
                 }



                 public function delete($Id)
                 {
                      $newsModel = new \App\Models\NaftemporikiModel();

                    if (!$newsModel->find($Id)) {
                      return redirect()->to('admin/dashboard')->with('error', 'News item not found.');
                    }

                    $newsModel->delete($Id);

                return redirect()->to('admin/dashboard')->with('message', 'News item successfully deleted.');
                }
    }


