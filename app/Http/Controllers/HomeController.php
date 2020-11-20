<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Goutte\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private $subcategorias = [];
    private $categorias = [];
    private $output = '';
    public function index(Client $client) //funcion para buscar categorias y subcategorias
    {
        $crawler = $client->request('GET', 'https://www.milanuncios.com/');

        $crawler->filter('.sui-CollapsibleBasic')->each(function ($item) 
        {   
            $this->output = $item->filter('.ma-MainCategory-mainCategoryNameLink')->text();
            $item->filter('.ma-SharedCrosslinks')->each(function ($item2) 
                {
                    array_push($this->subcategorias,[$this->output, $item2->text()]); //extrae categorias y subcategorias y guarda en Array
                });
        });

        $crawler->filter('.ma-MainCategory-mainCategoryNameLink')->each(function ($item) 
        {   
            array_push($this->categorias,$item->text()); //extrae categorias para comparar posteriormente
        });

        $categorias = $this->categorias;
        $subcategorias = $this->subcategorias;

        return view('home', compact(['categorias','subcategorias'])); //manda categorias y subcategorias a la vista
    }   
    
    public function buscar(Client $client, $categ) //funcion para buscar 1 sola categoria
    {
        if ($categ == 'Informática') 
        {
            $categ = 'informatica-segunda-mano';
        }
        elseif ($categ == 'Formación y libros') 
        {
            $categ = 'formacion';
        }
        elseif ($categ == 'Empleo') 
        {
            $categ = 'ofertas-de-empleo';
        }

        $crawler = $client->request('GET', 'https://www.milanuncios.com/'.$categ.'/'); 

        print_r($crawler->html());
    }
}
