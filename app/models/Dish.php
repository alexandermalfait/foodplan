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


} 