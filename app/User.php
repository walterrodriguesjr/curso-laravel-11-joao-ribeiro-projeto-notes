<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    //função que relaciona 1 User com muitos Notes
    public function notes()
    {
        //User pode ter muito em Note, usando a coluna user_id de Note
        return $this->hasMany(Note::class);
    }
}
