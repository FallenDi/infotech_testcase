<?
namespace app\controllers;

use yii\web\Controller;
use app\models\Authors;
use app\models\Books;
use Yii;
Use yii\web\Response;

class ReportController extends Controller
{
    public function actionTopAuthors()
    {
        $currentYear = date('Y');
        $years = Books::find()->select('year')->distinct()->orderBy(['year' => SORT_DESC])->column();
        $authors = Authors::topTen($currentYear);

        return $this->render('top-authors', [
            'authors' => $authors,
            'years' => $years,
            'currentYear' => $currentYear
        ]);
    }

    public function actionTopAuthorsAjax($year)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $authors = Authors::topTen($year);
        
        return [
            'authors' => array_map(function($author) {
                return [
                    'name' => $author->name,
                    'book_count' => $author->book_count, // Передаем book_count в JSON
                ];
            }, $authors),
        ];
    }
}