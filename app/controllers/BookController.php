<?
class BookController extends Controller implements ControllerInterface{
    private BookModel $model;

    public function __construct() {
        $model = $bookModel = $this->model('BookModel');
    }

     public function index() 
     {
          $notFoundView = $this->view('not-found', 'NotFoundView');
          $notFoundView->render();
     }

     // public function details(string $id) {
          
     // }

     // public function search(string $params) {

     // }

     public function add() 
     {
          try {
               switch ($_SERVER['REQUEST_METHOD']) {
                   case 'GET':
                        // show the add book page
                   case 'POST':
                        $fileHandler = new FileHandler();
                        
                        $audioFile = $_FILES['audio']['tmp_name'];
                        $duration = (int) $fileHandler->getAudioDuration($audioFile);

                        $imageFile = $_FILES['cover']['tmp_name'];

                        $uploadedAudio = $fileHandler->saveAudioTo($audioFile, $_POST['title'], AUDIOBOOK_PATH);
                        $uploadedImage = $fileHandler->saveImageTo($imageFile, $_POST['title'], BOOK_COVER_PATH);
                        
                        $title = $_POST['title'];
                        $year = (int)$_POST['year'];
                        $summary = $_POST['summary'];
                        $price = (int)$_POST['price'];
                        $lang = $_POST['lang'];
                        $authors = $_POST['authors'];
                        $genres = $_POST['genres'];

                        
                        $bookId = $this->model->addBook(
                            $title, $year, $summary, $price, $duration, $lang,
                            $uploadedAudio, $uploadedImage, $authors, $genres
                        );
                    
                        header("Location: /public/song/detail/$bookId", true, 301);
                        exit;

                        default:
                            throw new RequestException('Method Not Allowed', 405);
               }
           } catch (Exception $e) {

           }          
     }
}
?>