<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Database\Connection;
use Exception;

class C_undang2 
    {
        private $hydrahon;
        
        public function __construct()
        {
            $conn = new Connection;
            $this->hydrahon = $conn->stmt();
        }

        public function create(Request $request){

            $table = $this->hydrahon->table('undang2');
            $query = $table->insert(
                [
                ]
            );

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

            $table = $this->hydrahon->table('undang2');
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
            
            return new Response(json_encode($query->execute()), 200);

        }

        public function postJson(Request $request){

            $query = $this->hydrahon->table('undang2');

            $jsonBody = json_decode($request->getContent(), true);
            $insert = $query->insert()->values($jsonBody);

            try{

                $insert->execute();

                $data = [
                    'status' => 'success',
                    'data' => [
                            $query->select($query->raw('LAST_INSERT_ID() as id'))->first()
                            ]
                    ];
                $sCode = 201;

            }catch(Exception $e){

                $data = [
                    'status' => 'error',
                    'data' => [
                        $e
                        ]
                    ];
                $sCode = 500;
            
            }
            
            return new Response(json_encode($data, true), $sCode);

        }
    }
