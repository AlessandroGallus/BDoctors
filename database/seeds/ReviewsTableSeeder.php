<?php

use Illuminate\Database\Seeder;
use App\Review;
use App\User;
class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $text = [
            'Peggior dottore della mia vita: mio figlio è morto.',
            'Me la sono cavata perdendo un braccio',
            'Sono contento, la mia gastroscopia è andata bene',
            'Miglior medico della mia vita, è riuscito a guarire mia figlia e magicamente anche me',
            'Ha probabilmente fatto un miracolo.',
            'Se l’arcivescovo di Costantinopoli si disarcivescoviscostantinopolizzasse vi disarcivescoviscostantinopolizzereste come si è disarcivescociscostantinopolizzato l’arcivescovo di Costantinopoli?'
        ];
        foreach($users as $user){

            

            $limite = rand(1,10);
            for($i=0;$i<$limite;$i++){
            $timestamp = rand(strtotime("Jan 01 2020"), strtotime("Sep 01 2021"));
            $random_date = date('Y-m-d H:i:s',$timestamp);
            $random_number = rand(0,5);
            $new_review = new Review();
            $new_review['user_id']=$user['id'];
            $new_review['description']=$text[$random_number];
            $new_review['mail']='testmail'. $i . '@aaaaaa.biiiiii';
            $new_review['vote']=rand(1,5);
            $new_review['created_at'] = $random_date;
            $new_review->save();
            }
        }
    }
}
