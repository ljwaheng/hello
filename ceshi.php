<?php


namespace kj1;

function getmsg () {
    echo '123';
}

  class Animals {
    public $obj = 'dog';
  }

namespace kj2;
function getmsg () {
    echo '521';
}

   class Animals {
    public $obj = 'pig';

    public function getss () {
        echo '55555';
    }
   }

 $animal = new Animals();
 
echo $animal->getss();
