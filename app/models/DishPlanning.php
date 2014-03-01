<?php

/**
 * @Entity
 * @Table(uniqueConstraints={@UniqueConstraint(name="unique_date_user", columns={"user_id", "date"})})
 */
class DishPlanning extends BaseEntity {

    /**
     * @var AppUser
     * @ManyToOne(targetEntity="AppUser")
     */
    private $user;

    /**
     * @var DateTime
     * @Column(type="date")
     */
    private $date;

    /**
     * @var Dish
     * @ManyToOne(targetEntity="Dish")
     * @JoinColumn(nullable=false)
     */
    private $dish;

    /**
     * @param \DateTime $date
     */
    public function setDate($date) {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param \Dish $dish
     */
    public function setDish($dish) {
        $this->dish = $dish;
    }

    /**
     * @return \Dish
     */
    public function getDish() {
        return $this->dish;
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


} 