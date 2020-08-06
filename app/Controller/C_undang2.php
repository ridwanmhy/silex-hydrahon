<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Database\Connection;

class C_undang2 
    {
        private $hydrahon;
        
        public function __construct()
        {
            $conn = new Connection;
            $this->hydrahon = $conn->stmt();
        }

        public function index(Request $request){
            
            $msg = $request->get('msg');
            return new Response('hallo '.$msg, 200);

        }

        public function id($id){

            return new Response('id kamu '.$id, 200);

        }

        public function withdb(){

            $table = $this->hydrahon->table('post_uus');
            return new Response(json_encode($table->select(['tahun'])->get()), 200);
        
        }

        public function withqb(Request $request){

            $id = $request->get('id');
            $tahun = $request->get('tahun');
            $nomor = $request->get('nomor');
            $tentang = $request->get('tentang');
            $created_at = $request->get('created_at');
            $updated_at = $request->get('update_at');



            $table = $this->hydrahon->table('post_uus');
            $query = $table->select();
            
            if(isset($id)){
                $query->where('id', $id);
            }

            if(isset($tahun)){
                $query->where('tahun', $tahun);
            }

            if(isset($nomor)){
                $query->where('nomor', $nomor);
            }

            if(isset($tentang)){
                $query->where('tentang', $tentang);
            }

            if(isset($created_at)){
                $query->where('created_at', 'LIKE', $created_at.'%');
            }

            if(isset($updated_at)){
                $query->where('updated_at', 'LIKE', $updated_at.'%');
            }
            
            return new Response(json_encode($query->execute()), 200);

        }
    }
