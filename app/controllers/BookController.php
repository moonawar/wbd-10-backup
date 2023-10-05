<?
class BookController extends Controller implements ControllerInterface{
    private BookModel $model;

    public function __construct(Db $db) {
        $model  = $this->model('BookModel', $db);
    }

     public function index() 
     {
          $notFoundView = $this->view('not-found', 'NotFoundView');
          $notFoundView->render();
     }

    public function details(string $id) {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // show the add book page
                    echo "Book Details with id: $id";
                    break;
                default:
                    throw new RequestException('Method Not Allowed', 405);
            }
        } catch (Exception $e) {
             http_response_code($e->getCode());
             exit;
        }          
    }

     // public function search(string $params) {

     // }

    public function add() 
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // show the add book page
                    echo "Add Book Page <br> <br>";
                    break;
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
            http_response_code($e->getCode());
            exit;
        }          
    }
}
?>