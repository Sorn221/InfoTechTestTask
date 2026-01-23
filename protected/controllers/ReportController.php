<?php

class ReportController extends Controller
{
    public function actionTopAuthors($year = null)
    {
        $year = $year ?: date('Y');
        
        $authors = Yii::app()->db->createCommand()
            ->select('a.id, a.name, COUNT(ba.book_id) as book_count')
            ->from('author a')
            ->join('book_author ba', 'a.id = ba.author_id')
            ->join('book b', 'ba.book_id = b.id')
            ->where('b.year = :year', [':year' => $year])
            ->group('a.id')
            ->order('book_count DESC')
            ->limit(10)
            ->queryAll();
        
        $this->render('topAuthors', [
            'authors' => $authors,
            'year' => $year,
        ]);
    }
}