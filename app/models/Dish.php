<?php

/**
 * @Entity
 */
class Dish extends BaseEntity {

    /**
     * @var AppUser
     * @ManyToOne(targetEntity="AppUser")
     * @JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $name;

    /**
     * @var int
     * @Column(type="integer", nullable=false)
     *
     * 1 to 5
     */
    private $preparationTime;

    /**
     * @var int
     * @Column(type="integer", nullable=false)
     *
     * Minimal number of weeks to wait before we re-suggest this dish
     */
    private $minWeeksBetweenSuggestion;

    /**
     * @var DishPicture[]
     * @OneToMany(targetEntity="DishPicture", mappedBy="dish", cascade="all")
     */
    private $pictures = array();


    /**
     * @var string
     * @Column(type="text", nullable=true)
     */
    private $url;

    /**
     * @var string
     * @Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @var bool
     * @Column(type="boolean", nullable=false, columnDefinition="boolean default false")
     */
    private $vegetarian;

    /**
     * @param int $minWeeksBetweenSuggestion
     */
    public function setMinWeeksBetweenSuggestion($minWeeksBetweenSuggestion) {
        $this->minWeeksBetweenSuggestion = $minWeeksBetweenSuggestion;
    }

    /**
     * @return int
     */
    public function getMinWeeksBetweenSuggestion() {
        return $this->minWeeksBetweenSuggestion;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param int $preparationTime
     */
    public function setPreparationTime($preparationTime) {
        $this->preparationTime = $preparationTime;
    }

    /**
     * @return int
     */
    public function getPreparationTime() {
        return $this->preparationTime;
    }

    /**
     * @param \AppUser $user
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * @return \AppUser
     */
    public function getUser() {
        return $this->user;
    }

    function __toString() {
        return $this->getName();
    }

    /**
     * @param \DishPicture[] $pictures
     */
    public function setPictures($pictures) {
        $this->pictures = $pictures;
    }

    /**
     * @return \DishPicture[]
     */
    public function getPictures() {
        return $this->pictures;
    }

    public function addPicture(DishPicture $picture) {
        $this->pictures[] = $picture;
    }

    /**
     * @return string
     */
    public function getNotes() {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes($notes) {
        $this->notes = $notes;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * @return boolean
     */
    public function isVegetarian() {
        return $this->vegetarian;
    }

    /**
     * @param boolean $vegetarian
     */
    public function setVegetarian($vegetarian) {
        $this->vegetarian = $vegetarian;
    }

}