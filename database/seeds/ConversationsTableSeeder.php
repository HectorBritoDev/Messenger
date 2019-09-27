<?php

use App\Conversation;
use App\Message;
use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conversation::truncate();
        Message::truncate();

        Conversation::flushEventListeners();
        Message::flushEventListeners();

        factory(Conversation::class, 10)->create(['user_id' => 1])->each(function (Conversation $conversation) {
            //$users = array($conversation->user_id, $conversation->contact_id);
            factory(Conversation::class, 1)->create(['user_id' => $conversation->contact_id, 'contact_id' => $conversation->user_id]);
            factory(Message::class, 3)->create(['from_id' => $conversation->user_id, 'to_id' => $conversation->contact_id]);
            factory(Message::class, 3)->create(['from_id' => $conversation->contact_id, 'to_id' => $conversation->user_id]);
            factory(Message::class, 2)->create(['from_id' => $conversation->user_id, 'to_id' => $conversation->contact_id]);
            factory(Message::class, 1)->create(['from_id' => $conversation->contact_id, 'to_id' => $conversation->user_id]);
        });

        factory(Conversation::class, 50)->create()->each(function (Conversation $conversation) {
            //$users = array($conversation->user_id, $conversation->contact_id);
            factory(Conversation::class, 1)->create(['user_id' => $conversation->contact_id, 'contact_id' => $conversation->user_id]);
            factory(Message::class, 3)->create(['from_id' => $conversation->user_id, 'to_id' => $conversation->contact_id]);
            factory(Message::class, 3)->create(['from_id' => $conversation->contact_id, 'to_id' => $conversation->user_id]);
            factory(Message::class, 2)->create(['from_id' => $conversation->user_id, 'to_id' => $conversation->contact_id]);
            factory(Message::class, 1)->create(['from_id' => $conversation->contact_id, 'to_id' => $conversation->user_id]);
        });
    }
}
