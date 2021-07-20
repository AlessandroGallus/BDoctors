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

            $limite = rand(1,3);
            for($i=0;$i<$limite;$i++){
            $random_number = rand(0,5);
            $new_review = new Review();
            $new_review['user_id']=$user['id'];
            $new_review['description']=$text[$random_number];
            $new_review['mail']='testmail'. $i . '@aaaaaa.biiiiii';
            $new_review['vote']=rand(1,5);

            $new_review->save();
            }
        }
    }
}
