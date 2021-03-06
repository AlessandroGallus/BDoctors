<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Message;
class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $messages = [
            'Un ambulanza per favore',
            'Li vuoi quei kiwi? E se non vuoi quei kiwi che kiwi vuoi?',
            'Se l’arcivescovo di Costantinopoli si disarcivescoviscostantinopolizzasse vi disarcivescoviscostantinopolizzereste come si è disarcivescociscostantinopolizzato l’arcivescovo di Costantinopoli?',
            'Sopra il palazzo c’è un cane pazzo, date un pezzo di pane a quel povero pazzo cane.',
            ' Scopo la casa, la scopa si sciupa; ma, se non scopo sciupando la scopa, la mia casetta con cosa la scopo?'
        ];
        function generatePhoneNumber(){
            $numeri=['0','1','2','3','4','5','6','7','8','9'];
            $numero = '';
            for($j=0;$j<10;$j++){
                $numero=$numero . $numeri[rand(0,9)];
            };


            return $numero;
        }
        foreach($users as $user){

        $limite = rand(6,10);
            for($i=0;$i<$limite;$i++){
                $timestamp = rand(strtotime("Jan 01 2020"), strtotime("Sep 01 2021"));
                $random_date = date('Y-m-d H:i:s',$timestamp);
                $random_number = rand(0,4);
                $new_message = new Message();
                $new_message['user_id']=$user['id'];
                $new_message['message_text']=$messages[$random_number];
                $new_message['mail']='testmail'. $i . '@gmail.com';
                $new_message['phone_number']=generatePhoneNumber();
                $new_message['created_at'] = $random_date;
                $new_message->save();
            }
        }
    }
}
