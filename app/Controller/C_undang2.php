<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Database\Connection;

class C_undang2 extends Connection
    {

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
            $table = $this->hydrahon->table('post_uus');
            $query = $table->select(['id', 'tahun']);
            if(isset($id)){
                     $query->where('id', $id);
            }
            
            return new Response(json_encode($query->execute()), 200);

        }
    }
