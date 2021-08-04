<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<500;$i++){
            $new_user = new User();
            $new_user['name']=$this->get('name');
            $new_user['email']='testmail'.($i+1).'@gmail.com';
            $new_user['password']=Hash::make(12345678);
            $new_user['surname']=$this->get('surname');
            $new_user['city']=$this->get('city');
            $new_user['address']='via '.$this->get('city').' '.rand(1,60);
            $new_user['date_of_birth']=$this->get('date');
            $new_user['CF']=$this->get('CF');
            $new_user['phone_number']=$this->get('number');
            $new_user['url_img']=$this->get('img');
            $new_user['visit_types']='Primo soccorso, controllo di emergenza';
            $new_user['url_cv']='https://drive.google.com/file/d/1A2JYavC8iGDy9tEHLs4-JN16GwGGjTVD/view?usp=sharing';
            $new_user->save();
        }
        $new_user = new User();
        $new_user['name']=$this->get('name');
        $new_user['email']='testmail@gmail.com';
        $new_user['password']=Hash::make(12345678);
        $new_user['surname']=$this->get('surname');
        $new_user['city']=$this->get('city');
        $new_user['address']='via '.$this->get('city').' '.rand(1,60);
        $new_user['date_of_birth']=$this->get('date');
        $new_user['CF']=$this->get('CF');
        $new_user['phone_number']=$this->get('number');
        $new_user['url_img']=$this->get('img');
        $new_user['url_cv']='https://drive.google.com/file/d/1A2JYavC8iGDy9tEHLs4-JN16GwGGjTVD/view?usp=sharing';
        $new_user['visit_types']='Primo soccorso, controllo di emergenza';
        $new_user->save();
    }
    public function get($type){
        $names =['Alice','Greta','Giulia','Ginevra','Alessandro','Alessia','Alessio','Martina','Lorenzo','Anna','Mattia','Matteo','Cristian','Leonardo','Rebecca','Elisa','Luca','Antonio'];
        $surnames = ['Rossi','Russo','Ferrari','Bianchi','Romano','Colombo','Bruno','De luca','Mancini','Giordano','Costa','Caruso','Leone','Conte','Monti','Guerra'];
        $cities  =['Roma','Milano','Napoli','Torino','Palermo','Genova','Bologna','Firenze','Bari','Catania','Verona','Venezia','Messina','Padova','Prato','Taranto','Lecce','Terni'];

        if($type=='name'){
            return $names[array_rand($names,1)];
        }
        if($type=='surname'){
            return $surnames[array_rand($surnames,1)];
        }
        if($type=='city'){
            return $cities[array_rand($cities,1)];
        }
        if($type=='date'){
            $min = strtotime('1950-1-1');
            $max = strtotime('2000-1-1');
            $val = rand($min, $max);
            return date('Y-m-d', $val);
        }
        if($type=='CF'){
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 16; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
            return $randomString;
        }
        if($type=='number'){
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
            return $randomString;
        }
        if($type=='img'){
            $gender = ['men','women'];
            return 'https://randomuser.me/api/portraits/'.$gender[array_rand($gender,1)].'/'.rand(1,90).'.jpg';
        }
    }
}
