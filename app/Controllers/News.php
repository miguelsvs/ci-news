<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use App\Models\NewsModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Paths;

class News extends BaseController
{
    protected static $validationImgUpload = [
        'title' => 'required|max_length[255]|min_length[3]',
        'body'  => 'required|max_length[5000]|min_length[10]',
        'userfile' => [
            'label' => 'Image File',
            'rules' => [
                'uploaded[userfile]',
                'is_image[userfile]',
                'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                'max_size[userfile,5000]',
                'max_dims[userfile,3840,2160]',
            ],
        ],
    ];

    protected static $uploadedImgFolder= "uploads/";
    

    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/head', $data)
            .view('templates/navbar')
            . view('news/index')
            . view('templates/footer');
    }

    public function show($slug = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews(esc($slug));

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/head', $data)
            .view('templates/navbar')
            . view('news/view')
            . view('templates/footer');
    }

    public function formCreate()
    {
        helper('form');

        return view('templates/head', ['title' => 'Create a news item'])
            .view('templates/ckEditorCreate')
            .view('templates/navbar')
            . view('news/create')
            . view('templates/footer');
    }



    public function create(){
        helper('form');

        $data = $this->request->getPost(['title', 'body','upload']);

 /*     // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        } */

        // Gets the validated data.
        //$post = $this->validator->getValidated();

        //Check if image is valid

    

        if (! $this->validate(static::$validationImgUpload)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('createForm', $data);
        }

/*         $img = $this->request->getFile('userfile');
        $extension = $img->getClientExtension();
        $slug  = url_title($data['title'], '-', true);
        $imgName = $slug.".".$extension;
        $thumbName = $slug."thumb.".$extension;
        $uploadsDirectory = "/";

        //Save the image if still on temp
        if (!$img->hasMoved()) {
            $img->store($uploadsDirectory, $imgName);
        }

        $baseUrl = base_url();
        $imgPath = "public/uploads/" . $imgName;


        $thumbnail = \Config\Services::image('gd');

        $thumbnail->withFile($baseUrl.$imgPath)
        ->fit(100, 100, 'center')
        ->save($baseUrl.$thumbName);  */

        $img = $this->request->getFile('userfile');
        $extension = $img->getClientExtension();
        $slug = url_title($data['title'], '-', true);
        $imgName = $slug . "." . $extension;
        $thumbName = $slug . "thumb." . $extension;
        
        // Save the image if still in temp
        if (!$img->hasMoved()) {
            $img->move(WRITEPATH . 'uploads', $imgName);
        }
        
        $imgPath = static::$uploadedImgFolder . $imgName;
        $thumbPath = static::$uploadedImgFolder . $thumbName;
        
        $thumbnail = \Config\Services::image('gd');
        
        $thumbnail->withFile(WRITEPATH.$imgPath)
            ->fit(256, 256, 'center')
            ->save(WRITEPATH . $thumbPath);

        $model = model(NewsModel::class);

        try {            
            // Save to database
            $model->save([
                'title' => $data['title'],
                'slug'  => $slug,
                'body'  => $data['body'],
                'img'   => $imgName,
                'img_thumb256_256' => $thumbName,
            ]);
        } catch (\Exception $e) {
            // Log the error message
            log_message('error', $e->getMessage());
            return $this->formCreate();
        }
        
        return view('templates/head', ['title' => 'Create a news item'])
            .view('templates/ckEditorCreate')
            .view('templates/navbar')
            . view('news/success', ['action' => 'News added'])
            . view('templates/footer');
    }

    public function formDelete()
    {
        helper('form');

        return view('templates/head', ['title' => 'Choose item to remove'])
            .view('templates/navbar')
            . view('news/delete')
            . view('templates/footer');
    }

    public function delete()
    {
        helper('form');

        $data = $this->request->getPost(['title']);

        $model = model(NewsModel::class);

        $noticia = $model->where('title', $data['title'])->first();
        if($noticia){
            $model->where('title',$data['title'])->delete();    
            
            //Success
            return view('templates/head', ['title' => 'Delete a news item'])
            .view('templates/navbar')
            . view('news/success', ['action' => "Delete new"])
            . view('templates/footer');
        }
        else{
            return $this->formDelete();
        }

/*         $model->where('title',$data['title'])->delete(); //devuelve 1 salvo error en la query
        //DEVUELVE ÉXITO AUNQUE NO HAYA BORRADO NADA !!

        return view('templates/head', ['title' => 'Delete a news item'])
            . view('news/success', ['action' => "Delete new"])
            . view('templates/footer') */;
    }

    public function formDeleteOptions()
    {
        helper('form');


        return view('templates/head', ['title' => 'Choose item to remove'])
            .view('templates/navbar')
            . view('news/deleteOptions')
            . view('templates/footer');

    }

    public function deleteOptions()
    {
        helper('form');

        $data = $this->request->getPost(['title']);
        $action = $this->request->getPost('action');
        $model = model(NewsModel::class);
        if($action == 'softDelete'){
           
            $noticia = $model->where('title', $data['title'])->first();
            if($noticia)
                {
                    $model->where('title',$data['title'])->delete(); 
                    return view('templates/head', ['title' => 'Delete a news item'])
                    .view('templates/navbar')
                    . view('news/success', ['action' => "Soft delete new"])
                    . view('templates/footer'); 
                }
            else {
                return $this->formDeleteOptions();
            }

                  
        }
        if($action = 'trueDelete')
        {   
            //nombre de la tabla asociada
            $table = $model ->table;

            //query
            $model->db->query("DELETE FROM $table WHERE title = ?",$data['title']);
            
            $deleted = $model->db->affectedRows() > 0;
            if ($deleted) {
                return view('templates/head', ['title' => 'Delete a news item'])
                .view('templates/navbar')
                . view('news/success', ['action' => "True delete new"])
                . view('templates/footer'); 
            } else {
                return $this->formDeleteOptions();
            }
        }
    }

    public function listNews()
    {
        helper('form');
        log_message("info","listnews");
        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/head', $data)
            .view('templates/navbar')
            . view('templates/video')
            . view('news/lista')
            . view('templates/footer');

    }

    public function listaDelete()
    {
        helper('form');

        $data = $this->request->getPost(['title']);

        $model = model(NewsModel::class);

        $model->where('title',$data['title'])->delete();   

        return redirect()->to('news/lista');
    }

    public function bin()
    {
        helper('form');

        $model = model(NewsModel::class);

        $builder = $model->builder();       


        $data = [
            'news' => $builder->where('deleted_at IS NOT NULL')->get()->getResultArray(),
            'title' => 'News archive',
        ];

        return view('templates/head', $data)
            .view('templates/navbar')
            . view('news/bin')
            . view('templates/footer');

    }

    public function binDelete()
    {
        $data = $this->request->getPost(['title']);

        $model = model(NewsModel::class);

        $builder = $model->builder();  

        $builder->where('title',$data['title']);
        $builder->delete();

        return redirect()->to('news/bin');
    }

    public function binRestore()
    {
        $data = $this->request->getPost(['title']);

        $model = model(NewsModel::class);

        $builder = $model->builder();  

        $builder->set('deleted_at', NULL);
        $builder->where('title', $data['title']);
        $builder->update();

        return redirect()->to('news/bin');
    }

    public function editor()
    {
        helper('form');

        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'Editor',
        ];
        
        return view('templates/head', $data)
            .view('templates/ckEditorEditor')
            .view('templates/navbar')
            . view('news/listaEditor')
            . view('templates/footer');
    }

    public function listaUpdate()
    {
        $data = $this->request->getPost(['title','body']);

        $model = model(NewsModel::class);

        $builder = $model->builder();  

        $builder->set('body', $data['body']);
        $builder->where('title', $data['title']);
        $builder->update();

        return redirect()->to('news/editor');

    }

    public function pruebas()
    {
        helper('form');

        $model = model(NewsModel::class);

        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('news/pruebas');
/*         return view('templates/head', $data)
            .view('templates/navbar')
            . view('templates/video')
            . view('news/pruebas')
            . view('templates/footer'); */
    }

}


