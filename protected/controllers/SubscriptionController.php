<?php

class SubscriptionController extends Controller
{
    public function actionSubscribe($author_id)
    {
        if(Yii::app()->user->isGuest) {
            // Для гостей - форма с номером телефона
            $this->render('guest_subscribe', [
                'author_id' => $author_id,
            ]);
        } else {
            // Для авторизованных - сразу подписываем
            $subscription = new Subscription;
            $subscription->user_id = Yii::app()->user->id;
            $subscription->author_id = $author_id;
            $subscription->save();
            Yii::app()->user->setFlash('success', 'Вы подписались на автора');
            $this->redirect(['author/view', 'id' => $author_id]);
        }
    }
}