<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\NaftemporikiModel;
use App\Models\KathimeriniModel; 
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

     //Responsible for dashboard page view / Handle both controllers
    public function dashboard() {
        $Naftemporiki = new NaftemporikiModel();
        $Kathimerini = new KathimeriniModel();

        $newsItems1 = $Kathimerini->getAllNews(); 
        $newsItems2 = $Naftemporiki->getAllNews();
        
        //Merge the data

        $newsItems = array_merge($newsItems1, $newsItems2);

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
                     $newsModel1 = new \App\Models\NaftemporikiModel();
                     $newsModel2 = new  \App\Models\KathimeriniModel();
                    
                     $newsItem1 = $newsModel1->find($Id);
                     $newsItem2 = $newsModel2->find($Id); 


                     $newsItem = $newsItem1 ?? $newsItem2;

             
                     // Check if the news item exists
                     if (!$newsItem) {
                         throw new \CodeIgniter\Exceptions\PageNotFoundException('News Item Not Found');
                     }
             
                     // Load the view and pass the news item data
                     return view('admin/readNews', ['newsItem' => $newsItem]);
                 }


                 public function confirmDelete($Id)
                 {
                     $newsModel1 = new \App\Models\NaftemporikiModel();
                     $newsModel2 = new  \App\Models\KathimeriniModel();
                     


                     $newsItem1 = $newsModel1->find($Id);
                     $newsItem2 = $newsModel2->find($Id); 


                     $newsItem = $newsItem1 ?? $newsItem2;

                    if (!$newsItem) {
                         return redirect()->to('admin/dashboard')->with('message', 'News item not found.');
                    }

                    return view('admin/confirmDelete', ['newsItem' => $newsItem]);
                 }



                 public function delete($Id)
                 {
                      $newsModel1 = new \App\Models\NaftemporikiModel();
                      $newsModel2 = new  \App\Models\KathimeriniModel();

                      
                     $newsItem1 = $newsModel1->find($Id);
                     $newsItem2 = $newsModel2->find($Id); 


                    

                    if (!$newsItem1 && !$newsItem2) {
                      return redirect()->to('admin/dashboard')->with('error', 'News item not found.');
                    }

                    if ($newsItem1) {
                        $newsModel1->delete($Id);
                    }
                    if ($newsItem2) {
                        $newsModel2->delete($Id);
                    }

                return redirect()->to('admin/dashboard')->with('message', 'News item successfully deleted.');
                }
    }


