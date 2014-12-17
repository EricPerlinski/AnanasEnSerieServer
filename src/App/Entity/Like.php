<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="like")
 */
class Like extends QRCode
{
    const prefix = "like";

    /**
     * Set path
     *
     * @param string $path
     * @return Like
     */
    public function setPath($path)
    {
        parent::setPath($path);
        $this->path = self::prefix . $this->path;

        return $this;
    }

    /**
     * Set pathAdmin
     *
     * @param string $pathAdmin
     * @return Like
     */
    public function setPathAdmin($pathAdmin)
    {
        parent::setPathAdmin($path);
        $this->path = self::prefix . $this->pathAdmin;

        return $this;
    }

}
