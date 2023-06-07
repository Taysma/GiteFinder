<?php

class  Review{

    private $id_review;
    private $id_user;
    private $id_rental;
    private $content;
    private $rating;
    private $created_at;
    

    public function __construct(array $post){
        $this->hydrate($post);
    }

    private function hydrate(array $post){
        foreach($post as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getId(){
        return $this->id_review;
    }

    public function getIdUser(){
        return $this->id_user;
    }

    public function getIdRental(){
        return $this->id_rental;
    }

    public function getContent(){
        return $this->content;
    }

    public function getRating(){
        return $this->rating;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    



    //SETTERS

    public function setId(int $id_review){
        $this->id_review=$id_review;
    }

    public function setIdUser(int $id_user){
        $this->id_user=$id_user;
    } 

    public function setIdRental(int $id_rental){
        $this->id_rental=$id_rental;
    }

    public function setContent(String $content){
        $this->content=$content;
    }

    public function setRating(int $rating){
        $this->rating=$rating;
    }

    public function setCreatedAt(String $created_at){
        $this->created_at= $created_at;
    }

   
}