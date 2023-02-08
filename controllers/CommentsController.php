<?php

namespace app\controllers;

use app\exceptions\CommentException;
use app\models\Comments;
use Exception;
use Yii;
use yii\web\Controller;

class CommentsController extends Controller
{
    /**
     * @return \yii\web\Response
     *
     * @throws CommentException
     */
    public function actionSave(): \yii\web\Response
    {
        $commentData = Yii::$app->request->post();
        if (!empty($commentData)) {
            $newComment = new Comments();
            $newComment->content = $commentData['content'];
            $newComment->username = $commentData['username'];
            $newComment->news_id = $commentData['news_id'];
            try {
                $result = $newComment->save();
            } catch (Exception $e) {
                throw new CommentException('Unable to save comment');
            }

            if ($result) {
                Yii::$app->session->setFlash('success', 'Comment saved');
                return $this->redirect("/news/view/$newComment->news_id");
            }
        }

        return $this->redirect('/');
    }
}