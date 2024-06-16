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
    
    

    protected $KathimeriniModel;
    protected $NaftemporikiModel; 

    public function __construct()
 {

         //load the session library
         session(); 

        // Load the necessary helpers
        helper(['url', 'form']);

        // Initialize the KathimeriniModel
        $this->KathimeriniModel = new KathimeriniModel();
        $this->NaftemporikiModel = new NaftemporikiModel();

       
       
    }
   

     //Responsible for login page view 
     public function login()
    {
        
        return view('admin/login'); 
    }

    public function logout() {
        
        session()->destroy; 
        return view('admin/login'); 
    }

     //Responsible for dashboard page view / Handle both controllers
    public function dashboard() {


        $Naftemporiki = new NaftemporikiModel();
        $Kathimerini = new KathimeriniModel();

        $newsItems1 = $Kathimerini->getAllNews(); 
        $newsItems2 = $Naftemporiki->getAllNews();
        

        //source identifier to each news item
    foreach ($newsItems1 as &$item) {
        $item['source'] = 'Kathimerini';
    }
    foreach ($newsItems2 as &$item) {
        $item['source'] = 'Naftemporiki';
    }


        //Merge the data

        $newsItems = array_merge($newsItems1, $newsItems2);

        return view('admin/dashboard', ['news' => $newsItems]);
    }


    //Responsible for update button 

    public function update(){
        return view('admin/updateNews'); 
    }


    //Responsible for create News 
    public function create() {
        return view('admin/createNews'); 
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
                 session()->setFlashdata('success', 'News has been deleted successfully');
                return redirect()->to('admin/dashboard'); 
                 
                }





                public function edit($Id)
                {
                    // Retrieve data from both models
                    $newsItem1 = $this->KathimeriniModel->get_news($Id);
                    $newsItem2 = $this->NaftemporikiModel->get_news($Id);
            
                    $newsItem = $newsItem1 ?? $newsItem2;
            
                    if (!$newsItem) {
                        return redirect()->to('admin/dashboard')->with('message', 'News item not found.');
                    }
            
                    $modelType = $newsItem1 ? 'kathimerini' : 'naftemporiki';
            
                    // Pass the news item and model type to the view
                    return view('admin/updateNews', ['item' => $newsItem, 'modelType' => $modelType]);
                }
            
                public function updateNews()
                {
                    $Id = $this->request->getPost('Id');
                    $title = $this->request->getPost('title');
                    $date_time = $this->request->getPost('date_time');
                    $html_content = $this->request->getPost('html_content');
                    $modelType = $this->request->getPost('modelType'); // Get the model type from the POST data
                    $summary = $this->request->getPost('summary'); 
                    $tags = $this->request->getPost('tags');
                    $category =  $this->request->getPost('category');
                    $Image = $this->request->getPost('Image'); //current image url as a default 
            
                    $data = [
                        'title' => $title,
                        'date_time' => $date_time,
                        'html_content' => $html_content,
                        'summary' => $summary,
                        'tags'=> $tags, 
                        'category' =>$category, 
                        'Image' => $Image

                    ];

                     // Έλεγχος αν υπάρχει νέα εικόνα και αν έχει ανέβει
                     $imageFile = $this->request->getFile('imageFile');
                      if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                         $newImageName = $imageFile->getRandomName();
                         $imageFile->move(ROOTPATH . 'public/uploads', $newImageName);
                         $data['Image'] = '/uploads/' . $newImageName;  // ενημέρωση του ονόματος της εικόνας στη βάση δεδομένων
                        } else {
                          $data['Image'] = $Image;  // Κρατάμε την παλιά εικόνα αν δεν ανεβάστηκε νέα
                        }

                       // Update using the specified model
                       if ($modelType === 'kathimerini') {
                       $item = $this->KathimeriniModel->update($Id, $data);
                       } elseif ($modelType === 'naftemporiki') {
                          $item = $this->NaftemporikiModel->update($Id, $data);
                       } else {
                          throw new \Exception("Invalid model type specified");
                     }
            
                    if ($item) {
                        session()->setFlashdata('success', 'News has been updated successfully');
                        return redirect()->to('admin/dashboard');
                    } else {
                        session()->setFlashdata('fail', 'Something went wrong');
                        return redirect()->back();
                    }
                }

                public function createNews()
                       {
                          $title = $this->request->getPost('title');
                          $date_time = $this->request->getPost('date_time');
                          $html_content = $this->request->getPost('html_content');
                          $category =  $this->request->getPost('category'); 
                          $summary =  $this->request->getPost('summary'); 
                          $tags =  $this->request->getPost('tags'); 
                          $Image = $this->request->getPost('Image'); 
                          
                          $modelType = $this->request->getPost('modelType'); // Get the model type from the POST data

                         $data = [
                                'title' => $title,
                                'date_time' => $date_time,
                                'html_content' => $html_content,
                                'category'=> $category,
                                'summary' => $summary, 
                                'tags' => $tags, 
                                'Image' => $Image


                         ];

                   

                     $imageFile = $this->request->getFile('imageFile');
                     if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newImageName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/uploads', $newImageName);
                        $data['Image'] = '/uploads/' . $newImageName;  // ενημέρωση του ονόματος της εικόνας στη βάση δεδομένων
                     }

                            // Save using the specified model
                            if ($modelType === 'kathimerini') {
                                $item = $this->KathimeriniModel->insert($data);
                            } elseif ($modelType === 'naftemporiki') {
                               $item = $this->NaftemporikiModel->insert($data);
                            } else {
                                throw new \Exception("Invalid model type specified");
                            }




                       if ($item) {
                         session()->setFlashdata('success', 'News has been created successfully');
                         return redirect()->to('admin/dashboard');
                        } else {
                         session()->setFlashdata('fail', 'Something went wrong');
                         return redirect()->back();
                         }
                    }
        }
                    
                 


                


                



    


