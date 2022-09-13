<?php

namespace MyProject\Services;

use MyProject\Containers\CarOwnerContainer;

/** Reads cars & owners from .json file */
class InputReader {

    public function readInput($path) {
        $content = file_get_contents($path);
        $json = json_decode($content, true);

        $converter = new AssocArrayConverter();

        return new CarOwnerContainer(
            $converter->toCars($json['cars']),
            $converter->toOwners($json['owners']),
        );
    }

}

