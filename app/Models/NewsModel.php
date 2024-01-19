<?php
namespace App\Models;

use CodeIgniter\Model;


class NewsModel extends Model 
{
    protected $table = 'news';

    protected $allowedFields = ['title', 'slug', 'body','img','img_thumb256_256'];
    protected $validationRules = ['title' =>'required|max_length[255]|min_length[3]',
    'body'  => 'required|max_length[5000]|min_length[10]'];
    protected $useSoftDeletes = true; //por defecto es así Guarda en delete_at como datetime (se puede cambiar a int o date)


    

    public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();

    }

}

