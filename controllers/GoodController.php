<?php
namespace App\controllers;

use App\models\Good;
use App\models\GoodImage;
use App\models\Review;
use App\models\User;
use App\services\DB;
use App\services\GoodServices;

class GoodController extends Controller
{

    public function indexAction()
    {
        return $this->render(
            'index',
            [
                'title' => 'Название',
                'text' => 'lorem'
            ]
        );
    }
    public function oneAction()
    {
        $id = $this->request->get('id');
        if ($this->request->isGet()){
            return $this->render(
                'good',
                [
                    'good' => (new Good())->getOne($id),
                    'user' => unserialize (serialize ($this->request->getSession('user'))),
                    'reviews' => (new Review())->getReviews($id),
                    'goodImage' => (new GoodImage())->getOne($id)
                ]
            );
        }
        if (empty($review)) {
            $review = new Review();
        }
        $review->good_id = $id;
        $review->author = $this->request->post('author');
        $review->text = $this->request->post('text');
        $review->save();
        $this->setMSG('Отзыв добавлен');
        $this->request->redirect();
    }
    public function allAction()
    {
        return $this->render(
            'goods',
            [
                'goods' => (new Good())->getAll()
            ]
        );
    }
    public function addAction()
    {
        if ($this->request->isGet()){
            return $this->render('good_add');
        }
        $good = new Good();
        $good->name = $this->request->post('name');
        $good->price = $this->request->post('price');
        $good->save();

        $goodImage = new GoodImage();
        $image = $this->request->file('image');
        $goodImage->uploadFile($image, IMG_DIR);
        $goodImage->path = $image['name'];
        $goodImage->addImage($goodImage->path);

        $this->setMSG('Товар добавлен');
        $this->request->redirect('/?c=good&a=all');
    }
    public function editAction()
    {
        $id = $this->request->get('id');
        if ($this->request->isGet()){
            return $this->render('good_edit',
                ['good' => (new Good())->getOne($id)]);
        }
        $good = new Good();
        $good->name = $this->request->post('name');
        $good->price = $this->request->post('price');
        $good->id = $id;

        $good->save();
        $this->setMSG('Товар изменен');
        $this->request->redirect("/?c=good&a=one&id={$id}");
    }
    public function delAction()
    {
        $id = $this->request->get('id');
        $good = new Good();
        $good->id = $id;
        $good->delete();
        $this->setMSG('Товар удален');
        $this->request->redirect("/?c=good&a=all");
    }

}