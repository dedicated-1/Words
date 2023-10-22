<?php


namespace App\Enum;


enum Languages: String {

    
    case English  = 'English';
    case Japanese = 'Japanese';
    case Hebrew   = 'Hebrew';
    case Greek    = 'Greek';
    case German   = 'German';
    case Spanish  = 'Spanish';



    public function code(): string {
        return match($this){
            self::English  => 'EN',
            self::Japanese => 'JA',
            self::Hebrew   => 'HE',
            self::Greek    => 'GR',
            self::German   => 'DE',
            self::Spanish  => 'ES',

        };
    }
    public function getArrayLowercase(): Array {

        return $this->cases();
    }




}







?>