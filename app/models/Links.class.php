<?php

class Links extends BaseSql {
    protected $link;

    /**
     * @return mixed
     */

    public function getLink() {
        return $this->link;
    }

    public function setLink( $link ) {
        $this->link = $link;
    }

}