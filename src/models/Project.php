<?php

class Project
{
    private $title;
    private $description;
    private $image;
    private $like;
    private $dislike;
    private $id;
    private $kcal;
    private $time;
    private $id_assigned_by;
    private $link;

    public function __construct($title, $description, $image, $kcal, $time, $link, $like = 0, $dislike = 0, $id = null, $id_assigned_by=null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->link = $link;
        $this->like = $like;
        $this->dislike = $dislike;
        $this->id = $id;
        $this->kcal = $kcal;
        $this->time = $time;
        $this->id_assigned_by = $id_assigned_by;

    }

    public function getLink(){
        return $this->link;
    }

    public function getIdAssigned(){
        return $this->id_assigned_by;
    }

    public function setIdAssigned($id_ass){
        $this->id_assigned_by = $id_ass;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getLike(): int
    {
        return $this->like;
    }

    public function setLike(int $like): void
    {
        $this->like = $like;
    }

    public function getDislike(): int
    {
        return $this->dislike;
    }

    public function setDislike(int $dislike): void
    {
        $this->dislike = $dislike;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getKcal(): int {
        return $this->kcal;
    }

    public function getTime(): int {
        return $this->time;
    }
}