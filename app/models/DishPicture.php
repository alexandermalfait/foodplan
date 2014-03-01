<?php

/**
 * @Entity
 */
class DishPicture extends BaseEntity {

    /**
     * @var Dish
     * @ManyToOne(targetEntity="Dish")
     * @JoinColumn(nullable=false)
     */
    private $dish;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $filename;

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
     * @param string $filename
     */
    public function setFilename($filename) {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilename() {
        return $this->filename;
    }
}